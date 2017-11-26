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
            <h2>Search results for <i>{{ \Request::segment(2) }}</i></h2>
            <br/>
            @foreach($recipes as $recipe)
            <div class="result">
                @if($media->getMainImageById($recipe->id))
                <div class="image" style="background-image: url(/uploads/md/{{ $media->getMainImageById($recipe->id) }})">
                </div>
                @endif
                <div class="info">
                    <h2>{{ $recipe->recipe_title }}</h2>
                    <p class="result-meta">
                        <span>Shared by:</span> {{ $recipe->display_name }}<br/>
                        <span>Posted on:</span> {{ $recipe->created_at }}
                    </p>
                    <p>{{ str_limit($recipe->recipe_description, 250) }}</p>
                    <p><a href="{{ route('single', ['id' => $recipe->id, 'slug' => $recipe->recipe_slug ]) }}" class="btn btn-default" href="">View Recipe</a></p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @include('includes.footer')
    @include('includes.scripts')
</body>
</html>
