@include('includes.head')
<body>
    @include('includes.header')

    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @if(Session::has('newuser'))
                    <h2>{{ Session::get('newuser') }}</h2>
                    <br/>
                    @endif
                    <h3>Please Log In To Continue</h3>
                    <br/>
                    <form class="form" role="form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" name="username" type="text" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" name="password" type="password" required />
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </section>



    @include('includes.footer')
    @include('includes.scripts')
</body>
</html>
