<x-layouts.app title="Asignaturas">
    <div class="container box">
        <div class="title">
            <span>Editar asignatura</span>
        </div>
        <form id="delete-form" action="{{ route('asignatures.delete', $asignature) }}" method="post" style="display: none">
            @csrf
            @method('delete')
        </form>

        <form method="post" action="{{ route('asignatures.update', $asignature->id) }}">
            @csrf
            @method('put')
            <div class="input__row">
                <label class="input__field span-12">
                    <span class="input__label">Nombre</span>
                    <input type="text" name="name" class="input" placeholder="nombre del la asignatura" value="{{ old('name', $asignature->name) }}" required>
                    <x-forms.field-errors for="name" />
                </label>
                <label class="input__field span-12">
                    <span class="input__label">Estado</span>
                    <select name="status" class="input">
                        <option value="studying" @selected($asignature->status === "studying")>En curso</option>
                        <option value="passed" @selected($asignature->status === "passed")>Aprovada</option>
                        <option value="failed" @selected($asignature->status === "failed")>Fallida</option>
                    </select>
                    <x-forms.field-errors for="status" />
                </label>
            </div>

            <div class="buttons--container">
                <button type="submit" class="btn btn--safe">Guardar cambios</button>
                <button type="submit" class="btn btn--danger" form="delete-form">Eliminar</button>
                <a href="{{ route('asignatures.list') }}" class="btn btn--secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts.app>