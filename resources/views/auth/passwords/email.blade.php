@extends('layouts.main')
@section('content')

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <div class="content">
                    <h2>Reset Password</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                @if (session('status'))
                    <div class="notification">
                        {{ session('status') }}
                    </div>
                @endif                
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="field">
                        <label class="label">E-Mail Address</label>
                        <div class="control">
                            <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        @if($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif                        
                    </div>

                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-primary">Send Password Reset Link</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection