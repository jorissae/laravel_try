<?php

namespace App\Providers;

use App\Api\TmdbApi;
use App\Services\Pager;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Serializer::class, function(){
            $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
            $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer(nameConverter: $metadataAwareNameConverter, propertyTypeExtractor: new PhpDocExtractor()), new ArrayDenormalizer()];

            return new Serializer($normalizers, $encoders);
        });
        $this->app->singleton(Pager::class, fn () => new Pager());
        $this->app->singleton(TmdbApi::class, fn () => new TmdbApi(env('TMDB_BEARER'), $this->app->get(Serializer::class)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
