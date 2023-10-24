@extends('statamic::layout')
@section('title', 'Purge DigitalOcean CDN Cache')

@section('content')
    <header class="mb-3">
        @include('statamic::partials.breadcrumb', [
            'url' => cp_route('utilities.index'),
            'title' => __('Utilities'),
        ])

        <h1>Purge DigitalOcean CDN Cache</h1>
    </header>

    <div class="mt-3 card">
        <purge-do-cdn-cache :endpoints=@json(config('purge-do-cdn-cache.endpoints')) />
    </div>
@stop
