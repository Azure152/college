<x-layouts.app title="Asignaturas">
    <div class="container box">
        <div class="title">
            <span>Crear asignatura</span>
        </div>

        <form method="post">
            @csrf
            <div class="input__row">
                <label class="input__field span-12">
                    <span class="input__label">Nombre</span>
                    <input type="text" name="name" class="input" placeholder="nombre del la asignatura" value="{{ old('name') }}" required>

                    @if ($errors->has('name'))
                        <div class="field__errors">
                            @foreach ($errors->get('name') as $item)
                                <p class="field__errors__item">{{ $item }}</p>
                            @endforeach
                        </div>
                    @endif
                </label>
                <label class="input__field span-12">
                    <span class="input__label">Estado</span>
                    <select name="status" class="input">
                        <option value="studying">En curso</option>
                        <option value="passed">Aprovada</option>
                        <option value="failed">Fallida</option>
                    </select>
                    <x-forms.field-errors for="status" />
                </label>
            </div>

            <div class="buttons--container">
                <button class="btn btn--safe">Registrar nueva asignatura</button>
                <a href="{{ route('asignatures.list') }}" class="btn btn--secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts.app>