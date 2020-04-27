@extends('Admin.master')
@include('Admin.libraries._library')
@section('content')
    <div class="col-lg-12">
        <div class="page-header head-section">
            <h4>ویرایش کتابخانه</h4>
        </div>
        <div class="dropdown-divider bg-dark mb-5"></div>
        <form class="form-horizontal" action="{{ route('libraries.update', ['library' => $library->id ]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            @include('Admin.section.errors')
            <div class="form-group col-12">
                <div class="col-lg-6">
                    <label for="title" class="control-label">عنوان کتابخانه</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="عنوان کتابخانه را وارد کنید" value="{{ $library->title }}">
                </div>
            </div>
            <div class="form-group col-12">
                <div class="col-lg-6">
                    <label for="librarytype_id" class="control-label">نوع کتابخانه</label>
                    <select name="librarytype_id" id="librarytype_id" class="select2 form-control">
                        <option value="">انتخاب کنید</option>
                        @foreach(\App\Librarytype::whereStatus(1)->get() as $librarytype)
                            <option value="{{$librarytype->id}}" {{$library->librarytype_id == $librarytype->id ? 'selected' : ''}}>{{$librarytype->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-12">
                <div class="col-lg-6 mb-3">
                    <label for="mainservice_id" class="control-label">موضوع اصلی</label>
                    <select onchange="getPartialServices()" name="mainservice_id" id="mainservice_id" class="select2 form-control">
                        <option value="">انتخاب کنید</option>
                        @foreach(\App\Service::whereStatus(1)->whereNull('parent_id')->get() as $mainservice)
                            <option value="{{$mainservice->id}}" {{$library->mainservice_id == $mainservice->id ? 'selected' : ''}}>{{$mainservice->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="partialServiceDiv" class="col-lg-12">
                    <div id="mainDiv" class="col-lg-6 pr-0 mb-3">
                        <label for="partialservice_id" class="control-label">موضوع جزئی</label>
                        <select onchange="getServices()" name="partialservice_id" id="partialservice_id" class="select2 form-control">
                            <option value="">انتخاب کنید</option>
                            @foreach(\App\Service::whereParentId($library->mainservice_id)->whereStatus(1)->with('service')->get() as $partialservice)
                                <option value="{{$partialservice->id}}" {{$partialservice->id = $library->partialservice_id ? 'selected' : ''}}>
                                    {{$partialservice->title}} {{ '- '.$partialservice->service->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="mainServiceDiv" class="col-lg-6 pr-0">
                        <label for="service_id" class="control-label">موضوع دقیق</label>
                        <select name="service_id" id="service_id" class="select2 form-control">
                            <option value="">انتخاب کنید</option>
                            @foreach(\App\Service::whereParentId($library->partialservice_id)->whereStatus(1)->with('service')->get() as $service)
                                <option value="{{$service->id}}" {{$service->id = $library->service_id ? 'selected' : ''}}>
                                    @if($library->partialservice)
                                        {{$service->title}} {{ '- '.$service->service->title }} {{ '- '.$service->service->service->title }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-lg-10">
                    <label for="description" class="control-label">توضیحات</label>
                    <textarea rows="5" class="form-control" name="description" id="description" placeholder="توضیحات را وارد کنید">{{ $library->description }}</textarea>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="form-group col-lg-10 p-3 border">
                    <label class="w-100">مقاله های کتابخانه</label>
                    <select name="article_id[]" id="article_id" class="select2 form-control" multiple>
                        <option value="">انتخاب کنید</option>
                        @foreach(\App\Article::whereIsPublish(1)->get() as $article)
                            <option value="{{$article->id}}"
                                {{ in_array(trim($article->id),$library->articles->pluck('id')->toArray()) ? 'selected' : ''  }}
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
                                {{ in_array(trim($video->id),$library->videos->pluck('id')->toArray()) ? 'selected' : ''  }}
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
                            <input type="radio" name="isPublish" value="1" {{$library->isPublish == 1 ? 'checked' : ''}}>
                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>
                        </label>
                        <label style="vertical-align:top;text-align: center">انتشار</label>
                        <span class="clearfix"></span>
                    </div>
                    <div class="col-lg-12">
                        <label class="custom-toggle">
                            <input type="radio" name="isPublish" value="0" {{$library->isPublish == 0 ? 'checked' : ''}}>
                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>
                        </label>
                        <label style="vertical-align:top;text-align: center">پیش نویس</label>
                        <span class="clearfix"></span>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-10">
                <div class="col-lg-2 float-left">
                    <button onclick="submitLibraryForm()" type="button" class="btn btn-primary float-left">ویرایش</button>
                </div>
            </div>
        </form>
    </div>
@endsection

