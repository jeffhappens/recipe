@inject('media','App\Http\Controllers\SiteController')
@include('includes.head')
<body>
    @include('includes.header')
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
    <section class="results">
        <div class="container">
            @if(!count($recipes))
                <div class="row">
                    <div class="col-md-12">
                        <h2>It's kinda quiet in there.</h2>
                        <p>Looks like you havent shared anything yet.</p>
                    </div>
                </div>
            @else
            @foreach($recipes as $recipe)
            <div class="result">
                @if($media->getMainImageById($recipe->id))
                <div class="image" style="background-image: url(/uploads/md/{{ $media->getMainImageById($recipe->id) }})">
                </div>
                @endif
                <div class="info">
                    <h2>{{ $recipe->recipe_title }}</h2>
                    <p class="result-meta">
                        <i><span>Posted on:</span> {{ $recipe->created_at }}</i>
                    </p>
                    <p>{{ $recipe->recipe_description }}</p>
                    <p>
                        <a href="{{ route('single', ['id' => $recipe->id, 'slug' => $recipe->recipe_slug ]) }}" class="btn btn-default" href="">View Recipe</a>
                        <a href="/todo" class="btn btn-default" href="">Edit Recipe</a>
                    </p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </section>




    @include('includes.footer')
    @include('includes.scripts')
</body>
</html>
