<x-layouts.app title="Creacion de actividad">
    <div class="container box">
        <div class="title">
            <span>Crear una actividad</span>
        </div>
        <form action="{{ route('activities.store') }}" method="post">
            @csrf

            <div class="input__row">
                <label class="input__field span-8">
                    <span class="input__label">Nombre</span>
                    <input type="text" name="name" class="input" placeholder="nombre de la actividad" value="{{ old('name') }}" required>
                    <x-forms.field-errors for="name" />
                </label>
                <label class="input__field span-4">
                    <span class="input__label">Puntaje</span>
                    <input type="number" name="score" step="0.01" class="input" placeholder="Puntaje/Calificacion" value="{{ old('score') }}">
                    <x-forms.field-errors for="score" />
                </label>
                <label class="input__field span-12">
                    <span class="input__label">Asignatura</span>
                    <select name="asignature_id" class="input" required>
                        @foreach (\App\Models\Asignature::all() as $item)
                            <option value="{{ $item->id }}" @selected(old('asignature_id') === $item->id)>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-forms.field-errors for="asignature_id" />
                </label>
                <label class="input__field span-12">
                    <span class="input__label">Contenido</span>
                    <textarea name="content" rows="4" class="input" placeholder="Contenido/descripcion de la actividad">{{ old('content') }}</textarea>
                    <x-forms.field-errors for="content" />
                </label>
            </div>
            <div class="buttons--container">
                <button type="submit" class="btn btn--safe">Crear actividad</button>
                <a href="{{ route('activities.list') }}" class="btn btn--secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts.app>