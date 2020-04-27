<option value="">انتخاب کنید</option>
@foreach(\App\User::whereNotNull('moshavertype_id')->get() as $user)
    <option value="{{$user->id}}" {{$user->testtype_id == $user->id ? 'selected' : ''}}>{{$user->fullname}}</option>
@endforeach
