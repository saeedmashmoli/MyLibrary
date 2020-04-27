@extends('Admin.master')
@section('content')
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-10 main">
        <div class="page-header head-section">
            <h4>ویرایش سمت</h4>
        </div>

        <form class="form-horizontal" action="{{ route('roles.update' , ['role' => $role->id ]) }}" method="post"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            @include('Admin.section.errors')
            <div class="form-group">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                    <label for="title" class="control-label">عنوان سمت</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را وارد کنید"
                           value="{{ $role->title }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                    <label for="permission_id" class="control-label">دسترسی ها</label>
                    <select class="form-control selectpicker" name="permission_id[]" id="permission_id" multiple>
                        @foreach(\App\Permission::all() as $permission)
                            <option value="{{ $permission->id }}" {{ in_array(trim($permission->id) ,
                            $role->permissions->pluck('id')->toArray()) ? 'selected' : ''  }}>{{ $permission->title }} -
                                {{ $permission->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <label for="label" class="control-label">توضیحات کوتاه</label>
                    <textarea rows="5" class="form-control" name="label" id="label" placeholder="توضیحات را وارد کنید">{{ $role->label  }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <button type="submit" class="btn btn-danger">ذخیره تغییرات</button>
                </div>
            </div>
        </form>
    </div>
@endsection
