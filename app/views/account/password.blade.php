@extends("layout.main")

@section('content')

    <form action="{{URL::route('account-change-password-post')}}" method="post">
        <input type="password" id="password" name="current_password" placeholder="Current Password">
        @if($errors->has('current_password'))

                {{$errors->first('current_password')}}

        @endif
        <input type="password" id="password" name="password" placeholder="New Password">
        @if($errors->has('password'))

                {{$errors->first('password')}}

        @endif
        <input type="password" id="password_again" name="password_again" placeholder="New Password Again">
        @if($errors->has('password_again'))

                {{$errors->first('password_again')}}

        @endif
        <input type="submit" value="change password">
        {{Form::Token();}}

    </form>

@stop