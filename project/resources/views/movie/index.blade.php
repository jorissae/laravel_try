@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 10px;">
        <h1>Liste de films</h1>

        <hr>
        @if(min($pages) !== 1)<a href="{{ route('index', ['page' => 1]) }}">1</a>@endif
        &nbsp;
        @foreach($pages as $page)
            <a href="{{ route('index', ['page' => $page]) }}">@if($page === $movieList->page)<b>{{ $page }}</b>@else{{ $page }}@endif</a>
        @endforeach
        &nbsp;
        @if(max($pages) !== $movieList->totalPages)<a href="{{ route('index', ['page' => $maxPage]) }}">{{ $maxPage  }}</a>@endif
        <hr>

        <ul class="list-group">
            @forelse ($movieList->movies as $movie)
                <li style="
                    float:left; display:inline-block; border:1px solid black; margin:2px; width:20%; height: 150px; padding:2px; background-color:lightblue;
                    " class="list-group-item">
                    <h3><a href="{{ route('show', ['id' => $movie->id]) }}">{{ $movie->title }}</a></h3>
                    <p><strong>Vote:</strong> <strong>{{ $movie->voteAverage }}</strong></p>
                    <p><strong>Resume:</strong> {{  Str::limit($movie->overview,100, '...') }}</p>
                </li>
            @empty
                <li class="list-group-item">Aucun film disponible pour le moment.</li>
            @endforelse
        </ul>
    </div>
@endsection
