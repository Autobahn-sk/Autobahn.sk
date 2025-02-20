<?php namespace AppAlgolia\AlgoliaSearch\Classes\Hooks;

use AppAd\Ad\Models\Ad;
use AppAd\Ad\Http\Resources\AdResource;
use AppAlgolia\AlgoliaSearch\Classes\Services\AlgoliaSearchService;

class Ads
{
    public static function handle()
    {
		Ad::extend(function ($model) {
			$model->bindEvent('model.afterCreate', function () {
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->sync(self::objects());
            });
            $model->bindEvent('model.afterUpdate', function () {
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->sync(self::objects());
            });
            $model->bindEvent('model.afterRestore', function () {
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->sync(self::objects());
            });
            $model->bindEvent('model.afterDelete', function () {
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->sync(self::objects());
            });
        });
    }

    public static function objects()
    {
        $objects = AdResource::collection(
            Ad::withTrashed()->get()
        );

        return response()
            ->json($objects)
            ->getData(true);
    }
}
