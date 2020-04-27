@extends('Admin.master')
@include('Admin.libraries._library')
@section('content')
    <div class="col-lg-12">
        <div class="page-header head-section">
            <h4>ایجاد کتابخانه</h4>
        </div>
        <div class="dropdown-divider bg-dark mb-5"></div>
        <form class="form-horizontal" action="{{ route('libraries.store') }}" method="post">
            {{ csrf_field() }}
            @include('Admin.section.errors')
            <div class="form-group col-12">
                <div class="col-lg-6">
                    <label for="title" class="control-label">عنوان کتابخانه</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان کتابخانه را وارد کنید" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group col-12">
                <div class="col-lg-6">
                    <label for="librarytype_id" class="control-label">نوع کتابخانه</label>
                    <select name="librarytype_id" id="librarytype_id" class="selectpicker">
                        <option value="">انتخاب کنید</option>
                        @foreach(\App\Librarytype::whereStatus(1)->get() as $librarytype)
                            <option value="{{$librarytype->id}}" {{old('librarytype_id') == $librarytype->id ? 'selected' : ''}}>{{$librarytype->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-12">
                <div class="col-lg-6 mb-3">
                    <label for="mainservice_id" class="control-label">موضوع اصلی</label>
                    <select onchange="getPartialServices()" name="mainservice_id" id="mainservice_id" class="selectpicker">
                        <option value="">انتخاب کنید</option>
                        @foreach(\App\Service::whereStatus(1)->whereNull('parent_id')->get() as $mainservice)
                            <option value="{{$mainservice->id}}" {{old('mainservice_id') == $mainservice->id ? 'selected' : ''}}>{{$mainservice->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="partialServiceDiv" class="col-lg-12">
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-lg-10">
                    <label for="description" class="control-label">توضیحات</label>
                    <textarea rows="5" class="form-control" name="description" id="description" placeholder="توضیحات را وارد کنید">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="form-group col-lg-10 p-3 border">
                    <label class="w-100">مقاله های کتابخانه</label>
                    <select name="article_id[]" id="article_id" class="select2 form-control" multiple>
                        <option value="">انتخاب کنید</option>
                        @foreach(\App\Article::whereIsPublish(1)->get() as $article)
                            <option value="{{$article->id}}"

                            >{{$article->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="form-group col-lg-10 p-3 border">
                    <label class="w-100">مقاله های کتابخانه</label>
                    <select name="video_id[]" id="video_id" class="select2 form-control" multiple>
                        <option value="">انتخاب کنید</option>
                        @foreach(\App\Video::whereIsPublish(1)->get() as $video)
                            <option value="{{$video->id}}"

                            >{{$video->title}}</option>
                        @endforeach
                    </select>
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

