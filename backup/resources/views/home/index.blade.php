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
            <div class="row">
                <div class="col-md-12">
                    <h2>Recently Shared Recipes</h2>
                    <br/>
                </div>
            </div>
            @foreach($recipes as $recipe)

            <div class="result">
                @if($recipe->media)
                    <div class="image" style="background-image: url(/uploads/md/{{ $recipe->media->media_filename }})"></div>
                @endif

                
                <div class="info">
                    <h2>{{ $recipe->recipe_title }}</h2>
                    <p class="result-meta">
                        {{-- <span>Shared by:</span> {{ $recipe->owner->display_name }}<br/> --}}
                        <span>Posted:</span> {{ $recipe->created_at->diffForHumans() }}<br/>
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
