<?php namespace AppAlgolia\AlgoliaSearch\Classes\Hooks;

use AppAd\Ad\Models\Ad;
use AppAd\Ad\Http\Resources\AdResource;
use AppAd\Ad\Classes\Enums\AdStatusEnum;
use AppAlgolia\AlgoliaSearch\Classes\Services\AlgoliaSearchService;

class Ads
{
	/**
	 * Handles the binding of model events to AlgoliaSearchService operations.
	 *
	 * @return void
	 */
    public static function handle(): void
	{
		Ad::extend(function ($model) {
			$model->bindEvent('model.afterCreate', function () use ($model) {
				if ($model->status !== AdStatusEnum::PUBLISHED->value) return;
                (new AlgoliaSearchService(env('ALGOLIA_INDEX')))->save(self::object($model));
            });
            $model->bindEvent('model.afterUpdate', function () use ($model) {
				if ($model->status !== AdStatusEnum::PUBLISHED->value) return;
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

	/**
	 * Converts the given Ad object to an array format suitable for Algolia.
	 *
	 * @param Ad $object The Ad object to be converted.
	 * @return array The converted array representation of the Ad object.
	 */
	public static function object(Ad $object): array
	{
		$object = AdResource::make($object);

		return response()
			->json($object)
			->getData(true);
	}
}
