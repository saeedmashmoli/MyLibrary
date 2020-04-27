@extends('Admin.master')
@section('content')
    <div class="col-lg-12">
        <div class="page-header head-section">
            <h4>ایجاد مقاله</h4>
        </div>
        <div class="dropdown-divider bg-dark mb-5"></div>
        <form class="form-horizontal" action="{{ route('articles.store') }}" method="post">
            {{ csrf_field() }}
            @include('Admin.section.errors')
            <div class="form-group col-12">
                <div class="col-lg-6">
                    <label for="title" class="control-label">عنوان</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان مقاله را وارد کنید" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-lg-10">
                    <label for="description" class="control-label">توضیحات</label>
                    <textarea rows="5" class="form-control" name="description" id="description" placeholder="توضیحات مقاله را وارد کنید">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="form-group col-12">
                <div class="col-lg-6">
                    <label for="title" class="control-label">پوستر</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان کتابخانه را وارد کنید" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="form-group col-lg-10 p-3 border">
                    <label class="w-100">فایل های مقاله</label>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="form-group col-lg-6 m-0">
                    <label for="gender">وضعیت</label>
                    <div class="col-lg-12">
                        <label class="custom-toggle">
                            <input type="radio" name="isPublish" value="1" {{old('isPublish') == 1 ? 'checked' : ''}}>
                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>
                        </label>
                        <label style="vertical-align:top;text-align: center">انتشار</label>
                        <span class="clearfix"></span>
                    </div>
                    <div class="col-lg-12">
                        <label class="custom-toggle">
                            <input type="radio" name="isPublish" value="0" {{old('isPublish') == 0 ? 'checked' : ''}}>
                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>
                        </label>
                        <label style="vertical-align:top;text-align: center">پیش نویس</label>
                        <span class="clearfix"></span>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-10">
                <div class="col-lg-2 float-left">
                    <button type="submit" class="btn btn-success float-left">ذخیره</button>
                </div>
            </div>
        </form>
    </div>
@endsection

