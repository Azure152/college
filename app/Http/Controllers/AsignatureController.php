<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsignatureStoreRequest;
use App\Http\Requests\AsignatureUpdateRequest;
use App\Models\Asignature;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AsignatureController extends Controller
{
    public function list(Request $request): View
    {
        $query = Asignature::query();

        $query->when($request->search, function (Builder $query, string $s) {
            $query->where('name', 'like', "%{$s}%");
        });

        return view('asignatures.list', [
            'asignatures' => $query->select('id', 'name', 'status')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('asignatures.create');
    }

    public function store(AsignatureStoreRequest $request): RedirectResponse
    {
        $asig = Asignature::create($request->validated());

        if ($asig) {
            return redirect()->route('asignatures.list');
        }

        return back()->with('noti', 'no se pudo crear la asignatura');
    }

    public function edit(Asignature $asignature): View
    {
        return view('asignatures.edit', compact('asignature'));
    }

    public function update(Asignature $asignature, AsignatureUpdateRequest $request): RedirectResponse
    {
        if ($request->name !== $asignature->name) {
            $request->validate(['name' => 'unique:App\Models\Asignature']);
        }

        $perform = $asignature->update($request->only('name', 'status'));

        if ($perform) {
            return redirect()->route('asignatures.list');
        }

        return back()->with('noti', 'no se pudo actualizar la asignatura');
    }

    public function delete(Asignature $asignature): RedirectResponse
    {
        if ($asignature->delete()) {
            return redirect()->route('asignatures.list');
        }

        return back()->with('noti', 'no ha podido eliminar la asignatura');
    }
}