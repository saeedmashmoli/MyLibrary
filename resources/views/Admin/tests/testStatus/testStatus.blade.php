@extends('Admin.master')
@section('script')
    <script>
        function getTestUsers() {
            let testId = $('input[name = test_id]').val();
            $.ajax({
                method: 'GET',
                url: '{{route('tests.getTestUsers')}}',
                data: {testId},
                success: function (response) {
                    $('#user_id').html(response);
                }
            })
        }
    </script>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="page-header head-section">
            <h4 class="float-right">مشاهده وضعیت آزمون ها</h4>
        </div>
        <div class="dropdown-divider float-right w-100 bg-dark"></div>
        <div  class="form-group col-lg-12">
            <div class="col-lg-6 float-right">
                <select onchange="getTestUsers()" name="test_id" id="test_id" class="select2 form-control">
                    <option value="">انتخاب کنید</option>
                    @foreach(\App\Test::where('isPublish',1)->get() as $test)
                        <option value="{{$test->id}}" {{request('test_id') == $test->id ? 'selected' : ''}}>{{$test->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 float-right" >
                <select name="user_id" id="user_id" class="select2 form-control">
                </select>
            </div>
        </div>
    </div>
@endsection
