@if ($errors->has($for))
    <div class="field__errors">
        @foreach ($errors->get($for) as $item)
            <p class="field__errors__item">{{ $item }}</p>
        @endforeach
    </div>
@endif