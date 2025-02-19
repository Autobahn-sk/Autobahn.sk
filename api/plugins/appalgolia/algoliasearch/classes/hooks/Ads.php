<?php namespace AppAlgolia\AlgoAlgoliaSearchliaIndex\Classes\Hooks;

use AppAd\Ad\Models\Ad;
use AppAd\Ad\Http\Resources\AdResource;
use AppAlgolia\AlgoliaSearch\Classes\Services\AlgoliaIndexService;

class Ads
{
    public static function handle()
    {
        Ad::extend(function ($model) {
            $model->bindEvent('model.afterCreate', function () {
                (new AlgoliaIndexService(env('ALGOLIA_INDEX')))->sync(self::objects());
            });
            $model->bindEvent('model.afterUpdate', function () {
                (new AlgoliaIndexService(env('ALGOLIA_INDEX')))->sync(self::objects());
            });
            $model->bindEvent('model.afterRestore', function () {
                (new AlgoliaIndexService(env('ALGOLIA_INDEX')))->sync(self::objects());
            });
            $model->bindEvent('model.afterDelete', function () {
                (new AlgoliaIndexService(env('ALGOLIA_INDEX')))->sync(self::objects());
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
