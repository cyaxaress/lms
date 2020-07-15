@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('role-permissions.index') }}" title="نقشهای کاربری">نقشهای کاربری</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">نقش های کاربری</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نقش کاربری</th>
                        <th>مجوزها</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                    <tr role="row" class="">
                        <td><a href="">{{ $role->id }}</a></td>
                        <td><a href="">{{ $role->name }}</a></td>
                        <td>
                            <ul>
                                @foreach($role->permissions as $permission)
                                    <li>@lang($permission->name)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="" onclick="deleteItem(event, '{{ route('role-permissions.destroy', $role->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                            <a href="{{ route('role-permissions.edit',  $role->id) }}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('RolePermissions::create')
        </div>
    </div>
@endsection
