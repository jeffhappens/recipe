<html>
    @include('includes.head')
    <body>
        @include('includes.header')

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @foreach($user as $u)
                            <h2>Hey there {{ $u->email }}!</h2>
                            <p>A friend of yours thinks that you might like to share some recipes on this site. You can use the form below to finish setting up your account.</p>
                            <form class="form" role="form" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="username">
                                        Username<br/>
                                        <small>(You can use a different email address if want)</small>
                                    </label>
                                    <input type="text" name="username" class="form-control" value="{{ $u->email }}" />
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="setup_invite" class="btn btn-default">SETUP ACCOUNT</button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @include('includes.footer')
        @include('includes.scripts')
    </body>
</html>
