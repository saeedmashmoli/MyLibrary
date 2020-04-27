@extends('Admin.master')
@section('content')
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="page-header head-section">
            <h4 class="float-right">سرویس ها</h4>
            <div class="btn-group float-left">
                <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">ایجاد موضوع</a>
            </div>
        </div>
        <div class="table-responsive">
            <form style="height: 50px;" class="form-control" action="{{route('services.index')}}">
                <div  class="form-group col-md-6 col-sm-6 col-lg-6 col-xs-6 float-right">
                    <input name="title"  id="title" class="form-control" placeholder="موضوع مورد نظر را وارد نمائید" autocomplete="off">
                </div>
{{--                <div  class="form-group col-md-3 col-sm-3 col-lg-3-xs-3 float-right">--}}
{{--                    <div class="d-inline-block w-25">--}}
{{--                        <label class="custom-toggle">--}}
{{--                            <input type="radio" name="status" value="1" {{request('status') == 1 ? 'checked' : ''}}>--}}
{{--                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>--}}
{{--                        </label>--}}
{{--                        <label style="vertical-align:middle; width: 50%;text-align: center">فعال</label>--}}
{{--                        <span class="clearfix"></span>--}}
{{--                    </div>--}}
{{--                    <div class="d-inline-block w-25">--}}
{{--                        <label class="custom-toggle">--}}
{{--                            <input type="radio" name="status" value="0" {{request('status') == 0 ? 'checked' : ''}}>--}}
{{--                            <span class="custom-toggle-slider" style="border-radius: 10% !important;"></span>--}}
{{--                        </label>--}}
{{--                        <label style="vertical-align:middle; width: 30%;text-align: center">غیرفعال</label>--}}
{{--                        <span class="clearfix"></span>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group  col-md-2 col-sm-2 col-lg-2 col-xs-2 float-right">
                    <button class="btn btn-dark col-md-7 col-lg-7 col-sx-7 col-xs-7" type="submit">جستجو</button>
                </div>
            </form>
        </div>
        @if($services->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شناسه سرویس</th>
                        <th>موضوع</th>
                        <th>موضوع جزئی</th>
                        <th>موضوع اصلی</th>
                        <th>وضعیت سرویس</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آخرین تغییرات</th>
                        <th>تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{convertToPersianNumber($row++)}}</td>
                            <td>{{convertToPersianNumber($service->id)}}</td>
                            <td>{{$service->title}}</td>
                            <td>{{ $service->service ? $service->service->title : '-' }}</td>
                            <td>{{ $service->service->service ? $service->service->service->title : '-' }}</td>
                            <td>{{$service->status == 1 ? 'فعال' : 'غیرفعال'}}</td>
                            <td>{{ convertToPersianNumber(jdate($service->created_at)->format('H:i:s y/m/d')) }}</td>
                            <td>{{ convertToPersianNumber(jdate($service->updated_at)->format('H:i:s y/m/d')) }}</td>
                            <td>
                                <form action="{{ route('services.destroy'  , ['service' => $service->id ]) }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="btn-group btn-group-sm btn-group-lg">
                                        <a href="{{ route('services.edit' , ['service' => $service->id ]) }}"  class="btn btn-info btn-icon"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-key"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {!! $services->render() !!}
            </div>
        @else
            <div class="table-responsive mt-5 bg-warning p-3">
                <h6 class="text-danger">موضوعی یافت نشد!!!</h6>
            </div>
        @endif
    </div>
@endsection
