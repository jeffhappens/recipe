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
                    <h2>Search results found for <i>{{ $query }}</i></h2>
                    <p>We could not find any listings that matched your search.</p>
                    <p>Suggestions:</p>
                    <ul>
                        <li>Make sure all words are spelled correctly</li>
                        <li>Try different keywords</li>
                        <li>Try more general keywords</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Try another search</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-noresults">
                        <form class="form" style="padding-top:15px;">
                            <div class="form-group">
                                <input required type="text" name="query" placeholder="Search Query" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">SEARCH</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.footer')
    @include('includes.scripts')
</body>
</html>
