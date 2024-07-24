<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnotationStoreRequest;
use App\Models\Activity;
use App\Models\Annotation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnnotationController extends Controller
{
    public function create(Activity $activity): View
    {
        return view('annotations.create', compact('activity'));
    }

    public function edit(Annotation $annotation)
    {
        return view('annotations.edit', compact('annotation'));
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

    public function update()
    {

    }

    public function delete()
    {

    }
}