<x-layouts.app title="Adjuntar archivo - {{ $annotation->title }}">
    <div class="container box">
        <div class="title">
            <span>Adjuntar archivo [{{ $annotation->title }}]</span>
        </div>

        <form action="{{ route('annotations.file.store', $annotation) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input__row">
                <div class="input__field span-12">
                    <span class="input__label">Archivo</span>
                    <div class="custom-input-file" aria-placeholder="No hay archivos seleccionados">
                        <input type="file" name="attachment">
                        <span class="input input-file-text"></span>
                        <div class="input-file-buttons">
                            <button type="button" class="btn btn-small btn--safe" rel="btn-select-file">Seleccionar</button>
                        </div>
                    </div>
                    <x-forms.field-errors for="attachment" />
                </div>
            </div>
            <div class="buttons--container">
                <button type="submit" class="btn btn--safe">Agregar archivo</button>
                <a href="{{ route('annotations.edit', $annotation) }}" class="btn btn--secondary">Volver a la anotacion</a>
            </div>
        </form>
    </div>

    <x-slot:js>
        <script>
            const initCustomInputFile = (element) => {
                const input = element.querySelector('input[type="file"]');
                const inputText = element.querySelector('.input-file-text');
                const btnSelectFile = element.querySelector('[rel="btn-select-file"]');
                const placeholder = element.getAttribute('aria-placeholder');

                input.addEventListener('change', function () {
                    if (this.files[0]) {
                        inputText.textContent = this.files[0].name;
                        element.classList.add('attached');
                    } else {
                        inputText.textContent = placeholder;
                        element.classList.remove('attached');
                    }
                });

                btnSelectFile.onclick = () => input.click();

                input.dispatchEvent(new Event('change'));
            };

            const cInputFiles = document.querySelectorAll('.custom-input-file');

            cInputFiles.forEach(initCustomInputFile);
        </script>
    </x-slot:js>
</x-layouts.app>