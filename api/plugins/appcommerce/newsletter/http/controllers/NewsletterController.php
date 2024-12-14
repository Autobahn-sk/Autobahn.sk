<?php namespace AppCommerce\Newsletter\Http\Controllers;

use Illuminate\Routing\Controller;
use AppApi\ApiResponse\Resources\ApiResource;
use AppCommerce\Newsletter\Classes\Services\NewsletterService;

class NewsletterController extends Controller
{
    public function store()
    {
        request()->validate([
            'email' => 'email|required'
        ]);

        NewsletterService::subscribe(post('email'));

		return ApiResource::success('Subscribed successfully.');
	}

    public function destroy()
    {
        request()->validate([
            'email' => 'email|required'
        ]);

        NewsletterService::unsubscribe(post('email'));

		return ApiResource::success('Unsubscribed successfully.');
	}
}
