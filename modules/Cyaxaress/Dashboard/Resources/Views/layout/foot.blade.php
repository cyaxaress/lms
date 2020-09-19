<script src="/panel/js/jquery-3.4.1.min.js"></script>
<script src="/js/jquery.toast.min.js"></script>
<script src="/panel/js/js.js?v={{ uniqid() }}"></script>
@section('js')
    <script>
        @include('Common::layouts.feedbacks')
    </script>
@endsection
@yield('js')
