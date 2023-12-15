@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $movie->title }}</h1>

        <div style="padding: 5px;">
            {{ $movie->overview }}
        </div>

        [<a class="btn" href="{{ route('index') }}">Retour</a>]
    </div>
@endsection
