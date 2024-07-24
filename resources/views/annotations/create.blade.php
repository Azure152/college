<x-layouts.app title="Crear anotacion">
    <div class="container box">
        <div class="title">
            <span>Crear una anotacion [{{ $activity->name }}]</span>
        </div>
        <div class="sub-title">
            <span>Informacion general</span>
        </div>
        <form action="" method="post">
            @csrf
            <div class="input__row">
                <label class="input__field span-12">
                    <span class="input__label">Titulo</span>
                    <input type="text" name="title" class="input" placeholder="Titulo para la anotacion" value="{{ old('title') }}">
                    <x-forms.field-errors for="title" />
                </label>
                <label class="input__field span-12">
                    <span class="input__label">Contenido</span>
                    <textarea name="content" rows="4" placeholder="Contenido de la anotacion" class="input">{{ old('content') }}</textarea>
                    <x-forms.field-errors for="title" />
                </label>
            </div>
            {{-- <div class="sub-title">
                <span>Archivos adjuntos</span>
            </div>
            <div class="multiple-file">
                <div class="multiple-file__item">
                    <input type="file" name="attachments[]">
                    <input type="text" readonly class="input" placeholder="ningun archivo seleccionado">
                    <button type="button" class="btn btn--safe" rel="action-button">Seleccionar</button>
                    <button type="button" class="btn btn--danger" rel="delete-button">Eliminar</button>
                </div>
            </div>
            <div class="multiple"></div> --}}

            <div class="buttons--container">
                <button type="submit" class="btn btn--safe">Crear anotacion</button>
                <a href="{{ route('activities.edit', $activity) }}" class="btn btn--secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts.app>