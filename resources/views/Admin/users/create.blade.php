@extends('Admin.master')

@section('script')
    <script>
        $(document).ready(function () {
            $('#permission_id').selectpicker();
        })
    </script>
@endsection


@section('content')
    <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10 main">
        <div class="page-header head-section">
            <h4>ایجاد دسترسی</h4>
        </div>
        <form class="form-horizontal" action="{{ route('permissions.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('Admin.section.errors')
            <div class="form-group">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <label for="title" class="control-label">عنوان دسترسی</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را وارد کنید" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <label for="label" class="control-label">توضیحات کوتاه</label>
                    <textarea rows="5" class="form-control" name="label" id="label" placeholder="توضیحات را وارد کنید">{{ old('label') }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <button type="submit" class="btn btn-success">ارسال</button>
                </div>
            </div>
        </form>
    </div>
@endsection
