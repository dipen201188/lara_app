@extends('layout.main')

@section('content')
    <div class="demo-headline">
        <h1 class="demo-logo">
            <div class="logo"></div>
            Katerr App
            <small>all the dishes in one plate.</small>
        </h1>
    </div>

                    <form action="{{URL::route('login-post')}}" method="post">

                            <input type="text" id="email" name="email"{{(Input::old('email')) ? 'value = "'.e(Input::old('email')) .'"' : '' }} class="form-control" placeholder="email">
                            <label class="login-field-icon fui-user" for="email"></label>
                            @if($errors->has('email'))
                                {{$errors->first('email')}}
                            @endif


                            <input type="password" id="password" name="password" class="form-control" placeholder="password">
                            <label class="login-field-icon fui-lock" for="password"></label>
                            @if($errors->has('password'))
                                {{$errors->first('password')}}
                            @endif



                            <input type="submit" value="Sign in" class="btn btn-primary btn-block btn-large">

                            <a class="login-link" href="#">Lost your password?</a>

                            <a class="login-link" href="{{ URL::route('account-create') }}">Create new account</a>

                        {{Form::Token()}}
                    </form>

@stop
