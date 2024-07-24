<x-layouts.app title="Actividades">
    <div class="container box">
        <div class="title">
            <span>Actividades</span>
        </div>
        <form action="">
            <div class="input__row">
                <label class="input__field span-6">
                    <input type="text" name="search" class="input" placeholder="nombre de la asignatura">
                </label>
                <label class="input__field span-4">
                    <select name="asignature" class="input">
                        <option value="">Todas las asignaturas</option>
                        @foreach ($asignatures as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </label>
                <div class="input__field span-2">
                    <button type="submit" class="btn btn--safe" style="width:100%">Buscar</button>
                </div>
            </div>
        </form>
        <div style="margin-top: 20px">
            <a href="{{ route('activities.create') }}" class="btn btn--safe" style="width:100%">+ Crear un nueva actividad</a>
        </div>
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th width="15%">PUNTUACION</th>
                    <th>ASIGNATURA</th>
                    <th width="20%">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $item)
                    <tr>
                        <td><a href="{{ route('activities.show', $item->id) }}" class="link--simple">{{ $item->id }}</a></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->score, 2) }}</td>
                        <td>{{ $item->asignature }}</td>
                        <td>
                            <a href="{{ route('activities.edit', $item->id) }}" class="link--simple txt-primary">editar</a>
                            <span>|</span>
                            <form action="{{ route('activities.delete', $item->id) }}" method="post" style="display:inline-block">
                                @csrf
                                @method('delete')
                                <button class="link--simple txt-danger">eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container">
        {{ $activities->links('components.pagination') }}
    </div>
</x-layouts.app>