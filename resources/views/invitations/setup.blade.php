@extends('layouts.main')


@section('content')
    <section>
        <div class="container">
            <div class="columns">

                <div class="column is-half is-offset-one-quarter">
                    @foreach($user as $u)
                        <div class="content">
                        <h2>Hey there {{ $u->email }}!</h2>
                        <p>A friend of yours thinks that you might like to share some recipes on this site. You can use the form below to finish setting up your account.</p>
                        </div>
                        <form class="form" role="form" method="post">
                            {{ csrf_field() }}
                            <div class="field">
                                <label for="username">
                                    Username<br/>
                                    <small>(You can use a different email address if want)</small>
                                </label>
                                <input type="text" name="username" class="input" value="{{ $u->email }}" />
                            </div>
                            <div class="field">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="input" />
                            </div>
                            <div class="field">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="input" />
                            </div>
                            <div class="field">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="input" />
                            </div>
                            <div class="field">
                                <button type="submit" name="setup_invite" class="button is-primary">SETUP ACCOUNT</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@stop