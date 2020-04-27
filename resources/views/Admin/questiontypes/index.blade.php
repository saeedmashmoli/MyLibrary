@extends('Admin.master')
@section('content')
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="page-header head-section">
            <h4 class="float-right">نوع مشاور ها</h4>
            <div class="btn-group float-left">
                <a href="{{ route('moshavertypes.create') }}" class="btn btn-sm btn-primary">ایجاد نوع مشاور</a>
            </div>
        </div>
        @if($moshavertypes->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شناسه نوع مشاور</th>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آخرین تغییرات</th>
                        <th>تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($moshavertypes as $moshavertype)
                        <tr>
                            <td>{{convertToPersianNumber($i++)}}</td>
                            <td>{{convertToPersianNumber($moshavertype->id)}}</td>
                            <td>{{$moshavertype->title}}</td>
                            <td>{{$moshavertype->status == 1 ? 'فعال' : 'غیرفعال'}}</td>
                            <td>{{ convertToPersianNumber(jdate($moshavertype->created_at)->format('H:i:s y/m/d')) }}</td>
                            <td>{{ convertToPersianNumber(jdate($moshavertype->updated_at)->format('H:i:s y/m/d')) }}</td>
                            <td>
                                <form action="{{ route('moshavertypes.destroy'  , ['service' => $moshavertype->id ]) }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="btn-group btn-group-sm btn-group-lg">
                                        <a href="{{ route('moshavertypes.edit' , ['service' => $moshavertype->id ]) }}"  class="btn btn-info btn-icon"><i class="fa fa-edit"></i></a>
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
                <h6 class="text-danger">نوع مشاوری یافت نشد!!!</h6>
            </div>
        @endif
    </div>
@endsection
