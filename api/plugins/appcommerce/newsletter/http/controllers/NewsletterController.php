<?php namespace AppCommerce\Newsletter\Http\Controllers;

use Illuminate\Routing\Controller;
use AppApi\ApiResponse\Resources\ApiResource;
use AppCommerce\Newsletter\Classes\Services\NewsletterService;

class NewsletterController extends Controller
{
    public function store(): ApiResource
    {
        request()->validate([
            'email' => 'email|required'
        ]);

        NewsletterService::subscribe(post('email'));

		return ApiResource::successToast('Úspešne prihlásený na odber noviniek.');
	}

    public function destroy(): ApiResource
    {
        request()->validate([
            'email' => 'email|required'
        ]);

        NewsletterService::unsubscribe(post('email'));

		return ApiResource::successToast('Úspešne odhlásený z odberu noviniek.');
	}
}
