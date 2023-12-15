<?php

namespace App\Dto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class MovieList
{
    /** @var Movie[]  */
    #[SerializedName("results")]
    public array $movies = [];

    public int $page = 1;
    #[SerializedName("total_pages")]
    public int $totalPages = 0;
    #[SerializedName("total_results")]
    public int $totalResults = 0;
}
