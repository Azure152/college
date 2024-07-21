<a
    {{ $attributes->class(['navegation__link']) }}
    {{ $attributes->except('class') }}
    {{ request()->routeIs($route) ? 'active' : '' }}
>
    {{ $slot }}
</a>