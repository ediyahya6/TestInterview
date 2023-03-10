<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.svg')">

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill" routeName="dashboard">
    </x-maz-sidebar-item>
    <!-- Add Sidebar Menu Items Here -->
    <li class="sidebar-title">{{ __('Management') }}</li>
    <x-maz-sidebar-submenu name="User Management" icon="bi bi-grid-fill">
        <x-maz-sidebar-submenu-item name="Users" :link="route('users.index')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Teams" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Roles" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Permissions" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
    </x-maz-sidebar-submenu>

    <li class="sidebar-title">{{ __('Settings') }}</li>
    <x-maz-sidebar-submenu name="General" icon="bi bi-grid-fill">
        <x-maz-sidebar-submenu-item name="General" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Appearance" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Localization" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Customization" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Email" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Backup" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
    </x-maz-sidebar-submenu>
    <li class="sidebar-title">{{ __('Tes Interview') }}</li>
    <x-maz-sidebar-submenu name="CRUD User" icon="bi bi-grid-fill">
        @if ( Auth::user()->role == "admin" )
        <x-maz-sidebar-submenu-item name="Users" :link="route('user.index')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Trash" :link="route('user.trash')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Password Api" :link="route('password.api')"></x-maz-sidebar-submenu-item>
        @else
        <x-maz-sidebar-submenu-item name="Users" :link="route('user.index')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Trash" :link="route('user.trash')"></x-maz-sidebar-submenu-item>
        @endif
    </x-maz-sidebar-submenu>
</x-maz-sidebar>