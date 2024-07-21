<x-layouts.app title="Asignaturas">
    <div class="container box">
        <div class="title">
            <span>Asignaturas</span>
        </div>
        <form action="" class="asignatures__search">
            <input type="text" name="search" placeholder="Buscar asignatura por nombre" class="input search__input">
            <button type="submit" class="btn btn--safe">Buscar</button>
        </form>
        <div style="margin-top: 20px">
            <a href="{{ route('asignatures.create') }}" class="btn btn--safe" style="width:100%">+ Crear un nueva asignatura</a>
        </div>
    </div>
    <div class="container asignatures--wrapper">
        <div class="title">
            <span>Resultados</span>
        </div>
        
        @if ($asignatures->isNotEmpty())
            @foreach ($asignatures as $item)
                <a class="asignatures__item" href="{{ route('asignatures.edit', $item->id) }}">
                    <span>{{ $item->name }}</span>
                    <span class="asignatures__item__status">{{ $item->status }}</span>
                </a>
            @endforeach

            <div>
                {{ $asignatures->links('components.pagination') }}
            </div>
        @else
            <div class="search-notfound-message">
                <span>No se han encontrado asignaturas</span>
            </div>
        @endif
    </div>
</x-layouts.app>