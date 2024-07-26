@php
    $annFiles = $annotation->attachments;
    // $files = $annFiles->map(fn ($file) => Storage::disk('annFiles')->path($file->path));
    $images = $annFiles->filter(function ($file) {
        return preg_match(
            '/image\/.+/',
            File::mimeType(Storage::disk('annFiles')->path($file->path))
        );
    });

    $files = $annFiles->filter(function ($file) {
        return ! preg_match(
            '/image\/.+/',
            File::mimeType(Storage::disk('annFiles')->path($file->path))
        );
    });
@endphp

<x-layouts.app title="Anotacion: {{ $annotation->title }}">
    <div class="container box">
        <div class="section-title">
            <span>{{ $annotation->title }}</span>
            <div class="section-subtitle">
                <span>{{ "{$annotation->activity} [{$annotation->asignature}]" }}</span>
            </div>
        </div>
        <p>{{ $annotation->content }}</p>
    </div>

    @if ($images->isNotEmpty())
        <div class="container box">
            <div class="sub-title">
                <span>Imagenes adjuntas</span>
            </div>

            <div class="image-gallery">
                @foreach ($images as $item)
                    @php $url = Storage::disk('annFiles')->url($item->path) @endphp
                    <a class="image-gallery-item" href="{{ $url }}" target="_blank">
                        <img src="{{ Storage::disk('annFiles')->url($item->path) }}" loading="lazy">
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if ($files->isNotEmpty())
        <div class="container box">
            <div class="sub-title">
                <span>Otros archivos adjuntos</span>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th width="300px">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $item)
                        <tr>
                            <td>{{ basename($item->path) }}</td>
                            <td>
                                <a href="{{ Storage::disk('annFiles')->url($item->path) }}" class="link--simple txt-primary">Mostrar (navegador)</a>
                                <span>|</span>
                                <a href="{{ route('annotations.file.download', $item) }}" class="link--simple txt-primary">Descargar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layouts.app>