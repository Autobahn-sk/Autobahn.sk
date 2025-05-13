<?php namespace AppAd\Ad\Controllers;

use Response;
use Exception;
use BackendMenu;
use AppAd\Ad\Models\Ad;
use Backend\Classes\Controller;
use October\Rain\Support\Facades\Flash;
use AppAd\Ad\Http\Resources\AdResource;
use AppOpenAI\OpenAIChat\Classes\Services\OpenAIChatService;
use AppAlgolia\AlgoliaSearch\Classes\Services\AlgoliaSearchService;

/**
 * Ads Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Ads extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
		\Backend\Behaviors\RelationController::class
	];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

	/**
	 * @var string relationConfig file
	 */
	public $relationConfig = 'config_relation.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['appad.ad.ads'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AppAd.Ad', 'ad', 'ads');
    }

	public function onGenerateDescription()
	{
		$model = $this->formGetModel();

		$adData = $model->load(['vehicle', 'vehicle.manufacturer', 'vehicle.features'])->toArray();

		$description = (new OpenAIChatService)->generateAdDescription($adData);

		$model->description = $description;

		$model->save();

		Flash::success('Description was generated successfully.');

		return Response::make('<script>window.location.reload();</script>');
	}

	public function onAlgoliaSync(): void
	{
		try {
			(new AlgoliaSearchService(env('ALGOLIA_INDEX')))->sync($this->objects());

			Flash::success('Successfully synced with Algolia');
		} catch (Exception $e) {
			Flash::error($e->getMessage());
		}
	}

	public static function objects()
	{
		$objects = AdResource::collection(Ad::all());

		return response()
			->json($objects)
			->getData(true);
	}
}
