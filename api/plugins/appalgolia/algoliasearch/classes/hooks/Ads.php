<?php namespace AppAlgolia\AlgoliaSearch\Classes\Hooks;

use AppAd\Ad\Models\Ad;
use AppAd\Ad\Http\Resources\AdResource;
use AppAlgolia\AlgoliaSearch\Classes\Services\AlgoliaSearchService;

class Ads
{
    public static function handle()
    {
		Ad::extend(function ($model) {
			$model->bindEvent('model.afterCreate', function () use ($model) {
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->save(self::object($model));
            });
            $model->bindEvent('model.afterUpdate', function () use ($model) {
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->save(self::object($model));
            });
            $model->bindEvent('model.afterRestore', function () use ($model) {
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->save(self::object($model));
            });
            $model->bindEvent('model.afterDelete', function () use ($model) {
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->delete($model->id);
            });
        });
    }

	public static function object($object)
	{
		$object = AdResource::make($object);

		return response()
			->json($object)
			->getData(true);
	}
}
