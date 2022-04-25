@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('tags.index') }}" title="برچسب‌ها">برچسب‌ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">برچسب‌ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>جزئیات</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr role="row" class="">
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->title }}</td>
                            <td><a href="">مشاهده</a></td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('tags.destroy', $tag->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('tags.edit',  $tag->id) }}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @includeIf('tag::dashboard.create')
        </div>
    </div>
@endsection
