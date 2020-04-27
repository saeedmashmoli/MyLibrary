@extends('Admin.master')
@section('content')
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="page-header head-section">
            <h4 class="float-right">نوع کتابخانه ها</h4>
            <div class="btn-group float-left">
                <a href="{{ route('librarytypes.create') }}" class="btn btn-sm btn-primary">ایجاد نوع کتابخانه</a>
            </div>
        </div>
        @if($librarytypes->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شناسه نوع کتابخانه</th>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آخرین تغییرات</th>
                        <th>تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($librarytypes as $librarytype)
                        <tr>
                            <td>{{convertToPersianNumber($i++)}}</td>
                            <td>{{convertToPersianNumber($librarytype->id)}}</td>
                            <td>{{$librarytype->title}}</td>
                            <td>{{$librarytype->status == 1 ? 'فعال' : 'غیرفعال'}}</td>
                            <td>{{ convertToPersianNumber(jdate($librarytype->created_at)->format('H:i:s y/m/d')) }}</td>
                            <td>{{ convertToPersianNumber(jdate($librarytype->updated_at)->format('H:i:s y/m/d')) }}</td>
                            <td>
                                <form action="{{ route('librarytypes.destroy'  , ['service' => $librarytype->id ]) }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="btn-group btn-group-sm btn-group-lg">
                                        <a href="{{ route('librarytypes.edit' , ['service' => $librarytype->id ]) }}"  class="btn btn-info btn-icon"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-key"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-responsive mt-5 bg-warning p-3">
                <h6 class="text-danger">نوع کتابخانه ای یافت نشد!!!</h6>
            </div>
        @endif
    </div>
@endsection
