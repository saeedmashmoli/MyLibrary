@extends('Admin.master')
@section('content')
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="page-header head-section">
            <h4 class="float-right">سطح سوال ها</h4>
            <div class="btn-group float-left">
                <a href="{{ route('questiontypes.create') }}" class="btn btn-sm btn-primary">ایجاد سطح سوال</a>
            </div>
        </div>
        @if($questiontypes->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شناسه سطح سوال</th>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>تاریخ ایجاد</th>
                        <th>تاریخ آخرین تغییرات</th>
                        <th>تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($questiontypes as $questiontype)
                        <tr>
                            <td>{{convertToPersianNumber($i++)}}</td>
                            <td>{{convertToPersianNumber($questiontype->id)}}</td>
                            <td>{{$questiontype->title}}</td>
                            <td>{{$questiontype->status == 1 ? 'فعال' : 'غیرفعال'}}</td>
                            <td>{{ convertToPersianNumber(jdate($questiontype->created_at)->format('H:i:s y/m/d')) }}</td>
                            <td>{{ convertToPersianNumber(jdate($questiontype->updated_at)->format('H:i:s y/m/d')) }}</td>
                            <td>
                                <form action="{{ route('questiontypes.destroy'  , ['service' => $questiontype->id ]) }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="btn-group btn-group-sm btn-group-lg">
                                        <a href="{{ route('questiontypes.edit' , ['service' => $questiontype->id ]) }}"  class="btn btn-info btn-icon"><i class="fa fa-edit"></i></a>
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
                <h6 class="text-danger">سطح سوالی یافت نشد!!!</h6>
            </div>
        @endif
    </div>
@endsection
