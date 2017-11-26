@extends('layouts.main')

@section('content')
    <section>
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <div class="content">
                        <h2>Whoops!</h2>
                        <p>{{ $message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop