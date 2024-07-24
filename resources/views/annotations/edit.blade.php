<x-layouts.app title="Crear anotacion">
    <div class="container box">
        <div class="title">
            <span>Editar una anotacion</span>
        </div>
        <div class="sub-title">
            <span>Informacion general</span>
        </div>
        <form action="" method="post">
            <div class="input__row">
                <label class="input__field span-12">
                    <span class="input__label">Titulo</span>
                    <input type="text" name="title" class="input" placeholder="Titulo para la anotacion" value="{{ old('title', $annotation->title) }}">
                    <x-forms.field-errors for="title" />
                </label>
                <label class="input__field span-12">
                    <span class="input__label">Contenido</span>
                    <textarea name="content" rows="4" placeholder="Contenido de la anotacion" class="input">{{ old('content', $annotation->content) }}</textarea>
                    <x-forms.field-errors for="title" />
                </label>
            </div>
            <div class="buttons--container">
                <button type="submit" class="btn btn--safe">Guardar </button>
                <a href="{{ route('activities.edit', $annotation->activity_id) }}" class="btn btn--secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="container box">
        <div class="sub-title">
            <span>Archivos adjuntos</span>
        </div>

        <div class="buttons--container">
            <a href="{{ route('annotations.file.create', $annotation) }}" class="btn btn--safe" style="width: 100%">+ Añadir archivo adjunto</a>
        </div>

        @if (($attachments = $annotation->attachments)->isNotEmpty())
            <table class="table" style="margin-top: 2rem">
                <thead>
                    <tr>
                        <th>NOMRE</th>
                        <th>SUBIDA</th>
                        <th width="15%">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attachments as $item)
                        <tr>
                            <td>{{ basename($item->path) }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <form action="{{ route('annotations.file.delete', $item->id) }}" method="post" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="link--simple txt-danger">eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else 
            <div class="search-notfound-message" style="margin-top:2rem">
                <span>No se han encontrado archivos adjuntos</span>
            </div>
        @endif

        {{-- <div class="attach-item">
            <input type="file" name="attachments[]">
            <input type="text" readonly class="input" placeholder="ningun archivo seleccionado">
            <button type="button" class="btn btn--safe" rel="action-button">Seleccionar</button>
            <button type="button" class="btn btn--danger" rel="delete-button">Eliminar</button>
        </div> --}}
    </div>
</x-layouts.app>