<header>
    <div class="container" style="position:relative">
        <div class="row">
            <div class="logo col-md-1 col-sm-4 col-xs-12">
                <a href="{{ route('home') }}"><img src="/img/knife-fork-white.png" /></a>
            </div>
            <div class="nav col-md-11 col-sm-8 col-xs-12">
                <ul class="list-inline" style="padding-top:10px;">
                    <li><a href="#" class="show-search">Search</a></li>
                    @if(!Auth::check())
                        <li><a href="/auth/login">Log In</a></li>
                    @else
                        <li><a href="{{ route('mine') }}">My Recipes</a></li>
                        <li><a href="{{ route('share') }}">Share Recipe</a></li>
                        <li>
                            @if(\Auth::user()->sharecount < 1)
                                <a class="toggle-share-warning" href="#">Invite a Friend</a>
                            @else
                                <a class="show-invite-friend" href="#">Invite a Friend</a>
                            @endif
                        </li>
                        <li><a href="/auth/logout">Log Out</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="search">
            <form class="form-inline" method="post">
                <div class="form-group">
                    <input style="width:300px" required type="text" name="query" placeholder="Search Query" class="form-control"/>
                    <button class="btn btn-primary" type="submit" name="">SEARCH</button>
                </div>
            </form>
        </div>
        @if(Auth::check())
        <div class="invite-friend">
            <form class="form-inline" method="post">
                <input type="hidden" name="sender" value="{{ Auth::user()->id }}"/>
                <div class="form-group">
                    <input type="hidden" name="invitor" value="{{ \Auth::user()->id }}"/>
                    <input style="width:300px" type="text" name="friend_email" placeholder="Email Address" class="form-control" required/>
                    <button class="btn btn-primary" type="submit" name="">INVITE</button>
                </div>

            </form>
        </div>
        @endif
    </div>
</header>
