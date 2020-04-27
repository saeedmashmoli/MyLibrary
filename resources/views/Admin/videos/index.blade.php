@extends('Admin.master')
@section('content')
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="page-header head-section">
            <h4 class="float-right">مقاله ها</h4>
            <div class="btn-group float-left">
                <a href="{{ route('articles.create') }}" class="btn btn-sm btn-primary">ایجاد مقاله</a>
            </div>
        </div>
        <div class="table-responsive">
            <form style="height: 50px;" class="form-control" action="{{route('articles.index')}}">
                <div  class="form-group col-md-6 col-sm-6 col-lg-6 col-xs-6 float-right">
                    <input name="title"  id="title" class="form-control" placeholder="عنوان مقاله مورد نظر را وارد نمائید" autocomplete="off">
                </div>
                <div class="form-group  col-md-2 col-sm-2 col-lg-2 col-xs-2 float-right">
                    <button class="btn btn-dark col-md-7 col-lg-7 col-sx-7 col-xs-7" type="submit">جستجو</button>
                </div>
            </form>
        </div>
        @if($articles->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>پوستر</th>
                        <th>وضعیت</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آخرین تغییرات</th>
                        <th>تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{convertToPersianNumber($row++)}}</td>
                            <td>{{convertToPersianNumber($article->id)}}</td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->isPublish == 1 ? 'منتشر شده' : 'پیش نویس'}}</td>
                            <td>{{ convertToPersianNumber(jdate($article->created_at)) }}</td>
                            <td>{{ convertToPersianNumber(jdate($article->updated_at)->format('H:i:s y/m/d')) }}</td>
                            <td>
                                <form action="{{ route('articles.destroy'  , ['library' => $article->id ]) }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs btn-group-xs">
                                        <a href="{{ route('articles.edit' , ['library' => $article->id ]) }}"  class="btn btn-info btn-icon"><i class="fa fa-edit"></i></a>
                                        <button title="پیش نویس/انتشار" type="submit" class="btn btn-sm {{$article->isPublish == 0 ? 'btn-danger' : 'btn-success'}}">
                                            @if($article->isPublish == 0)
                                                <i class="fa fa-exclamation-triangle"></i>
                                            @else
                                                <i class="fa fa-check-square"></i>
                                            @endif
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {!! $articles->appends(request()->all())->render() !!}
            </div>
        @else
            <div class="table-responsive mt-5 bg-warning p-3">
                <h6 class="text-danger">مقاله ای یافت نشد!!!</h6>
            </div>
        @endif
    </div>
@endsection
