@extends('Admin.master')
@section('content')
    <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10 main">
        <div class="page-header head-section">
            <h4>ایجاد سطح سوال</h4>
        </div>
        <form class="form-horizontal" action="{{ route('questiontypes.store') }}" method="post">
            {{ csrf_field() }}
            @include('Admin.section.errors')
            <div class="form-group">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <label for="title" class="control-label">عنوان سطح سوال</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان سطح سوال را وارد کنید" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="d-inline-block w-25">
                        <label class="custom-toggle">
                            <input type="radio" name="status" value="1" {{old('status') == 1 ? 'checked' : ''}}>
                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>
                        </label>
                        <label style="vertical-align:top; width: 30%;text-align: center">فعال</label>
                        <span class="clearfix"></span>
                    </div>
                    <div class="d-inline-block w-25">
                        <label class="custom-toggle">
                            <input type="radio" name="status" value="0" {{old('status') == 0 ? 'checked' : ''}}>
                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>
                        </label>
                        <label style="vertical-align:top; width: 30%;text-align: center">غیرفعال</label>
                        <span class="clearfix"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <button type="submit" class="btn btn-success">ذخیره</button>
                </div>
            </div>
        </form>
    </div>
@endsection
