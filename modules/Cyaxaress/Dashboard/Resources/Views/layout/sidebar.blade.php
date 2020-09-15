<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://webamooz.net"></a>
    <x-user-photo />

    <ul>
        @foreach(config('sidebar.items') as $sidebarItem)
            <li class="item-li {{ $sidebarItem['icon'] }} @if(str_starts_with(request()->url(), $sidebarItem['url'] )) is-active  @endif"><a href="{{ $sidebarItem['url'] }}">{{ $sidebarItem['title'] }}</a></li>
        @endforeach
    </ul>
</div>
