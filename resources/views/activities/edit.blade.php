<x-layouts.app title="Editar actividad">
    <div class="container box">
        <div class="title">
            <span>Editar actividad</span>
        </div>
        <form action="{{ route('activities.update', $activity) }}" method="post">
            @method('put')
            @csrf

            <div class="input__row">
                <label class="input__field span-8">
                    <span class="input__label">Nombre</span>
                    <input type="text" name="name" class="input" placeholder="nombre de la actividad" value="{{ old('name', $activity->name) }}" required>
                    <x-forms.field-errors for="name" />
                </label>
                <label class="input__field span-4">
                    <span class="input__label">Puntaje</span>
                    <input type="number" name="score" step="0.01" class="input" placeholder="Puntaje/Calificacion" value="{{ old('score', $activity->score) }}">
                    <x-forms.field-errors for="score" />
                </label>
                <label class="input__field span-12">
                    <span class="input__label">Asignatura</span>
                    <select name="asignature_id" class="input" required>
                        @foreach (\App\Models\Asignature::all() as $item)
                            <option value="{{ $item->id }}" @selected(old('asignature_id', $activity->asignature_id) === $item->id)>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-forms.field-errors for="asignature_id" />
                </label>
                <label class="input__field span-12">
                    <span class="input__label">Contenido</span>
                    <textarea name="content" rows="4" class="input" placeholder="Contenido/descripcion de la actividad">{{ old('content', $activity->content) }}</textarea>
                    <x-forms.field-errors for="content" />
                </label>
            </div>
            <div class="buttons--container">
                <button type="submit" class="btn btn--safe">Guardar cambios</button>
                <a href="{{ route('activities.list') }}" class="btn btn--secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="title">
            <span>Anotaciones</span>
        </div>

        <div class="buttons--container">
            <a href="{{ route('annotations.create', $activity) }}" class="btn btn--safe" style="width: 100%">+ Crear una anotacion</a>
        </div>
    </div>

    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITULO</th>
                    <th>CREACION</th>
                    <th width="20%">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($annotations as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('annotations.edit', $item->id) }}" class="link--simple txt-primary">editar</a>
                            <span>|</span>
                            <form action="{{ route('annotations.delete', $item->id) }}" method="post" style="display:inline-block">
                                @csrf
                                @method('delete')
                                <button class="link--simple txt-danger">eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                {{ $annotations->links('components.pagination') }}
            </tbody>
        </table>
    </div>
</x-layouts.app>