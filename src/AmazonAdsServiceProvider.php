<?php

namespace AmazonAdsApi;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class AmazonAdvServiceProvider
 * @package AmazonAdsApi
 * @author Misolai <lai3221@163.com>
 * @date Date 2022/2/24   15:21
 */
class AmazonAdsServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/config/amazon_ads_api.php';
        $this->mergeConfigFrom($configPath, 'amazon_ads_api');
    }

    public function boot()
    {
        $this->app->singleton('AmazonAdsApi', function() {
            return new Client(config('amazon_ads_api'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }
}
