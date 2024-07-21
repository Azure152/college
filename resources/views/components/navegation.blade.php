<nav class="navegation">
    <x-navegation.nav-item title="pagina de inicio" value="Inicio" :href="route('home')" :active="Route::is('home')" />
    <x-navegation.nav-item title="asignaturas" value="Asignaturas" :href="route('asignatures.list')" :active="Route::is('asignatures.*')" />
    <x-navegation.nav-item title="actividades" value="Actividades" href="#" :active="Route::is('activities.*')" />
</nav>