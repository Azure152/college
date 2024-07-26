<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnotationStoreRequest;
use App\Http\Requests\AnnotationUpdateRequest;
use App\Models\Activity;
use App\Models\Annotation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnnotationController extends Controller
{
    public function create(Activity $activity): View
    {
        return view('annotations.create', compact('activity'));
    }

    public function edit(Annotation $annotation): View
    {
        return view('annotations.edit', compact('annotation'));
    }

    public function show(int $id)
    {
        $annotation = Annotation::join(
            'activities', 'annotations.activity_id', '=', 'activities.id'
        )->join(
            'asignatures', 'activities.asignature_id', '=', 'asignatures.id'
        )->select(
            'activities.name as activity', 'asignatures.name as asignature',
            'annotations.id', 'annotations.title', 'annotations.content' 
        )->where('annotations.id', $id)->first();

        if (! $annotation) {
            throw new NotFoundHttpException();
        }

        return view('annotations.show', compact('annotation'));
    }

    public function store(Activity $activity, AnnotationStoreRequest $request): RedirectResponse
    {
        $ann = Annotation::create([
            ...$request->validated(),
            'activity_id' => $activity->id
        ]);

        if ($ann) {
            return redirect()->route('activities.edit', $activity);
        }

        return back()->with('noti', 'no se pudo crear la anotacion');
    }

    public function update(Annotation $annotation, AnnotationUpdateRequest $request): RedirectResponse
    {
        if ($request->title !== $annotation->title) {
            $request->validate([
                'title' => Rule::unique(Annotation::class)->where(
                    'activity_id', $annotation->activity_id
                )
            ]);
        }

        $perform = $annotation->update($request->only('title', 'content'));

        if ($perform) {
            return redirect()->route('annotations.edit', $annotation)
                ->with('noti', 'informacion actualizada');
        }

        return back()->with('noti', 'no se ha podido actualizar la anotacion');
    }

    public function delete(Annotation $annotation): RedirectResponse
    {
        $activity = $annotation->activity_id;

        if ($annotation->delete()) {
            return redirect()->route('activities.edit', $activity);
        }

        return back()->with('noti', 'no se pudo eliminar la anotacion');
    }
}