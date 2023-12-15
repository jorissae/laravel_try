<?php

namespace App\Dto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class Movie
{
    public ?int $id = null;

    public ?string $title = null;

    public bool $adult = false;

    #[SerializedName("original_title")]
    public ?string $originalTitle = null;

    #[SerializedName("original_language")]
    public ?string $originalLanguage = null;

    public ?string $overview = null;

    #[SerializedName("vote_average")]
    public ?int $voteAverage = null;

    #[SerializedName("vote_count")]
    public ?int $voteCount = null;

    #[SerializedName("movie_type")]
    public ?string $type = null;

    #[SerializedName("poster_path")]
    public ?string $posterPath = null;

    #[SerializedName("backdrop_path")]
    public ?string $backdropPath = null;
}
