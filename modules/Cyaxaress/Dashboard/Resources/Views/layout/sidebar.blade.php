<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="{{ url('/') }}"></a>
    <x-user-photo />

    <ul>
        @foreach(config('sidebar.items') as $sidebarItem)
            @if(!array_key_exists('permission', $sidebarItem) ||
                    auth()->user()->hasAnyPermission($sidebarItem['permission']) ||
                    auth()->user()->hasPermissionTo(\Cyaxaress\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN)
                    )
            <li class="item-li {{ $sidebarItem['icon'] }} @if(str_starts_with(request()->url(), route($sidebarItem['route_name']) )) is-active  @endif">
                <a href="{{ route($sidebarItem['route_name']) }}">{{ $sidebarItem['title'] }}</a></li>
            @endif
        @endforeach
    </ul>
</div>
