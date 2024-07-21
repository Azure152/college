{{-- @props(['active' => false]) --}}

<a href="{{ $href }}" {{ $attributes->except('href') }} @class(['navegation__item', 'active' => $active])>
    {{ $value }}
</a>