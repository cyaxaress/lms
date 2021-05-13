@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('tickets.index') }}" title="تیکت ها">تیکت ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">تیکت ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام ارسال کننده</th>
                        <th>ایمیل ارسال کننده</th>
                        <th>آخرین بروزرسانی</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr role="row" class="">
                            <td><a href="">{{ $ticket->id }}</a></td>
                            <td>{{ $ticket->user->name }}</td>
                            <td>{{ $ticket->user->email }}</td>
                            <td>{{ $ticket->updated_at }}</td>
                            <td>{{ $ticket->status }}</td>

                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('tickets.destroy', $ticket->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="item-edit mlg-15" title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layouts.feedbacks')
    </script>
@endsection
