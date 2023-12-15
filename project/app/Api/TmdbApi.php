<?php

namespace App\Api;

use App\Dto\Movie;
use App\Dto\MovieList;
use App\Exceptions\TmdbApiErrorException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Promise\PromiseInterface;

class TmdbApi
{

    public function __construct(
        private string $token,
        private Serializer $serializer
    )
    {
    }

    private function getBearer(): string
    {
        return sprintf('Bearer %s', $this->token);
    }

    public function get(string $url): Response|PromiseInterface
    {
        $host = env('TMDB_HOST');

        $response = Http::withHeaders([
            'Authorization'=> $this->getBearer(),
            'accept' => 'application/json',
        ])->get($host . $url);

        if ($response->status() >= 400) {
            throw new TmdbApiErrorException();
        }

        return $response;
    }

    public function getMovie(int $id): Movie
    {
        $response = $this->get(sprintf('movie/%d', $id));

        return $this->serializer->deserialize($response->body(), Movie::class, JsonEncoder::FORMAT);
    }

    public function getTrending(int $page = 1): MovieList
    {
        $response = $this->get('trending/all/day?language=fr-FR&page='.$page);

        return $this->serializer->deserialize($response->body(), MovieList::class, JsonEncoder::FORMAT);
    }


}
