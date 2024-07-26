<x-layouts.app title="Actividad: {{ $activity->name }}">
    <div class="container box">
        <div class="section-title">
            <span>{{ $activity->name }}</span>
            <span> </span>
            <span class="txt-primary">[{{ number_format($activity->score, 2) }}]</span>
            <div class="section-subtitle">
                <span>{{ $activity->asignature }}</span>
            </div>
        </div>
        <p>{{ $activity->content }}</p>
    </div>

    <div class="container">
        <details class="details-box" {{ $annotations->count() < 5 ? 'open' : '' }}>
            <summary>Anotaciones</summary>
            <div class="details-box-content">
                @if ($annotations->isNotEmpty())
                    <div class="list">
                        @foreach ($annotations as $item)
                            <a class="list-item link--simple" href="{{ route('annotations.show', $item) }}">
                                {{ $item->title }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="search-notfound-message" style="padding:1rem">
                        <span>No se encontraron anotaciones</span>
                    </div>
                @endif
            </div>
        </details>
    </div>
</x-layouts.app>