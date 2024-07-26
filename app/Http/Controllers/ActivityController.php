<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Models\Activity;
use App\Models\Asignature;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ActivityController extends Controller
{
    /**
     * display list of activities
     */
    public function list(Request $request): View
    {
        $query = Activity::join(
            'asignatures',
            'activities.asignature_id',
            '=',
            'asignatures.id'
        )->select(
            'activities.id',
            'activities.name',
            'activities.score',
            'asignatures.name as asignature'
        )->when($request->search, function (Builder $query, string $s) {
            $query->where('activities.name', 'like', "%{$s}%");
        })->when($request->asignature, function (Builder $query, string $a) {
            $query->where('activities.asignature_id', '=', $a);
        });

        return view('activities.list', [
            'activities' => $query->paginate(5),
            'asignatures' => Asignature::select('id', 'name')->get()
        ]);
    }

    /**
     * display the content from a activity
     */
    public function show(int $activity): View
    {
        $model = Activity::join(
            'asignatures',
            'activities.asignature_id',
            '=',
            'asignatures.id'
        )->select(
            'activities.id',
            'activities.name',
            'activities.content',
            'activities.score',
            'asignatures.name as asignature'
        )->where('activities.id', $activity)->first();

        if (! $model) {
            throw new NotFoundHttpException();
        }

        return view('activities.show', [
            'activity' => $model,
            'annotations' => $model->annotations()->select('id', 'title')->get(),
        ]);
    }

    /**
     * display form to create activity
     */
    public function create(): View
    {
        return view('activities.create');
    }

    /**
     * display form to edit a activity
     */
    public function edit(Activity $activity): View
    {
        return view('activities.edit', [
            'activity' => $activity,
            'annotations' => $activity->annotations()->paginate(5),
        ]);
    }

    /**
     * save the information of a activity
     */
    public function store(ActivityStoreRequest $request): RedirectResponse
    {
        $acti = Activity::create($request->validated());

        if ($acti) {
            return redirect()->route('activities.list');
        }

        return back()->with('noti', 'no se pudo crear la actividad');
    }

    /**
     * update a given activity
     */
    public function update(Activity $activity, ActivityUpdateRequest $request): RedirectResponse
    {
        if ($activity->name !== $request->input('name')) {
            $request->validate([
                'name' => Rule::unique(Activity::class)->where('asignature_id', $request->asignature_id),
            ]);
        }

        $perform = $activity->update($request->all());

        if ($perform) {
            return redirect()->route('activities.list');
        }

        return back()->with('noti', 'no se pudo actualizar la actividad');
    }

    /**
     * delete a given activity
     */
    public function delete(Activity $activity): RedirectResponse
    {
        if ($activity->delete()) {
            return redirect()->route('activities.list');
        }

        return back()->with('noti', 'no ha podido eliminar la actividad');
    }
}