@extends('layouts.main')
@section('content')
<section class="section">
    <div class="container">
        <div class="column is-half is-offset-one-quarter">
            <div class="content">
                @if(Session::has('newuser'))
                <h2>{{ Session::get('newuser') }}</h2>
                <br/>
                @endif
                <h2>Log In</h2>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="field">
                        <label class="label">E-Mail Address</label>
                        <div class="control">
                            <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" id="email" type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        @if($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif

                    </div>
                    <div class="field">
                        <label class="label">Password</label>
                        <div class="control">
                            <input class="input" id="password" type="password" name="password" required>
                        </div>
                        @if($errors->has('password'))
                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="field">
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-primary">Submit</button>
                        </div>
                        <div class="control">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</section>
@stop