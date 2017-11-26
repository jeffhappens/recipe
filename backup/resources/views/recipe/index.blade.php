@include('includes.head')
<body class="recipe-view">
    @include('includes.header')

    <div class="black-bg">
        <section class="result-hero" style="background-image: url(/uploads/lg/{{ $recipe->media[0]->media_filename }})"></section>

{{--         @foreach($media as $m)
            @if($loop->index == 0)
                <section class="result-hero" style="background-image: url(/uploads/lg/{{ $m->media_filename }})"></section>
            @endif
        @endforeach
 --}}
    </div>

    <section class="result-thumbnails">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($recipe->media as $m)
                        <img src="/uploads/sm/{{ $m->media_filename }}" />
                    @endforeach                    
                </div>
            </div>
        </div>
    </section>

    <section class="result-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $recipe->recipe_title }}</h2>
                    <p class="result-meta">
                        <i>
                            <span>Shared by:</span> {{ $recipe->display_name }}<br/>
                            <span>Posted on:</span> {{ $recipe->created_at }}
                        </i>
                    </p>
                    <p>
                        @if(count($recipe->tags) > 0)
                        <span class="glyphicon glyphicon-tag"></span> <b>Tags:</b>
                        @foreach($recipe->tags as $tag)
                            <i><a href="/search/{{ $tag->tag_content }}">{{ $tag->tag_content }}</a></i>@if(!$loop->last), @endif
                        @endforeach
                        @endif
                    </p>
                    <p>{{ $recipe->recipe_description }}</p>

                </div>
            </div>
        </div>
    </section>


    <section class="ingredients-instructions">
        <div class="container">
            <div class="row">
                <div class="col-md-5 ingredients">
                    <h3>Ingredients</h3>
                    {!! $recipe->ingredients->ingredient_name !!}

{{--                     @foreach($ingredients as $ing)
                    {!! $ing->ingredient_name !!}
                    @endforeach
 --}}                    
                </div>
                <div class="col-md-7 instructions">
                    <h3>Instructions</h3>
                    {!! $recipe->instructions->instructions_name !!}

{{--                     @foreach($instructions as $inst)
                    {!! $inst->instructions_name !!}
                    @endforeach
 --}}                    
                </div>
            </div>
        </div>
    </section>

    @if($recipe->recipe_additional_information)
    <section class="additional-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Additional Information</h3>
                    <p>{{ $recipe->recipe_additional_information }}</p>
                </div>
            </div>
        </div>
    </section>
    @endif




    @if($recipe->recipe_enable_comments)
    <section class="comments">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('includes.comments')
                </div>
            </div>
        </div>
    </section>
    @endif



    @include('includes.footer')
    @include('includes.scripts')
</body>
</html>
