@extends('Admin.master')
@section('content')
    <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10 main">
        <div class="page-header head-section">
            <h4>ویرایش موضوع</h4>
        </div>
        <form class="form-horizontal" action="{{ route('services.update' , ['service' => $service->id ]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            @include('Admin.section.errors')
            <div class="form-group">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <label for="title" class="control-label">عنوان موضوع</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان موضوع را وارد کنید" value="{{ $service->title }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label for="parent_id" class="control-label">موضوع پدر</label>
                    <select name="parent_id" id="parent_id" class="selectpicker">
                        <option value="">انتخاب کنید</option>
                        @foreach(\App\Service::whereStatus(1)->get() as $parent)
                            <option value="{{$parent->id}}" {{$service->parent_id == $parent->id ? 'selected' : ''}}>{{$parent->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="d-inline-block w-25">
                        <label class="custom-toggle">
                            <input type="radio" name="status" value="1" {{$service->status == 1 ? 'checked' : ''}}>
                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>
                        </label>
                        <label style="vertical-align:top; width: 30%;text-align: center">فعال</label>
                        <span class="clearfix"></span>
                    </div>
                    <div class="d-inline-block w-25">
                        <label class="custom-toggle">
                            <input type="radio" name="status" value="0" {{$service->status == 0 ? 'checked' : ''}}>
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
