@if(\Auth::check())

    @if(\Auth::user()->sharecount < 1)
        <div class="dialog">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 content">
                        <h4>You must share at least one recipe before you can invite friends.</h4>
                        <br/>
                        <a class="btn btn-primary" href="{{ route('share') }}">Share Recipe</a>
                        <a class="dismiss btn btn-default" href="#">Maybe Later</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endif
