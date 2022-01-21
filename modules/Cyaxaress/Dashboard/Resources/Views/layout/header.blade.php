<div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
    <div class="header__right d-flex flex-grow-1 item-center">
        <span class="bars"></span>
        <a class="header__logo" href="/"></a>
    </div>
    <div class="header__left d-flex flex-end item-center margin-top-2">
        <span class="account-balance font-size-12">موجودی : {{ number_format(auth()->user()->balance) }} تومان</span>
        <div class="notification margin-15">
            <a class="notification__icon {{ count($notifications) ? "text-error" : "" }}"></a>
            <div class="dropdown__notification">
                <div class="content__notification">
                    @if(count($notifications))
                        <ul class="notification">
                            @foreach($notifications as $notification)
                                <li>
                                    <a href="{{ $notification->data["url"] }}">
                                        <span class="font-size-13">{{ $notification->data["message"] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route("notifications.markAllAsRead") }}" class="btn btn-webamooz_net font-size-11 " style="color: white !important;">علامت زدن همه به عنوان خوانده شده</a>
                    @else
                        <span class="font-size-13">موردی برای نمایش وجود ندارد</span>
                    @endif
                </div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="post" id="logout">
            @csrf
            <a href="" onclick="event.preventDefault(); document.getElementById('logout').submit()" class="logout"
               title="خروج"></a>
        </form>
    </div>
</div>
