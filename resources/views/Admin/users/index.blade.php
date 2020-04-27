@extends('Admin.master')
@section('style')
    <style>
        table thead tr{
            background: rgb(149, 199, 222);

        }
        table thead tr th{
            vertical-align: middle !important;
        }
    </style>
@endsection
@section('content')
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="page-header head-section">
            <h4 class="float-right">دسترسی ها</h4>
            <div class="btn-group float-left">
                <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-danger">ایجاد دسترسی</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>شرح دسترسی</th>
                    <th>توضیحات</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->title }}</td>
                        <td>{{ $permission->label }}</td>
                        <td>
                            <form action="{{ route('permissions.destroy'  , ['permission' => $permission->id ]) }}" method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="btn-group btn-group-sm btn-group-lg">
                                    <a href="{{ route('permissions.edit' , ['permission' => $permission->id ]) }}"  class="btn btn-info btn-icon"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align: center">
            {!! $permissions->render() !!}
        </div>
    </div>
@endsection
