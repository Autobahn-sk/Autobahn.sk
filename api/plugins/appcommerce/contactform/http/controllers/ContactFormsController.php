<?php namespace AppCommerce\ContactForm\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use AppApi\ApiResponse\Resources\ApiResource;
use AppCommerce\ContactForm\Models\ContactForm;
use AppCommerce\ContactForm\Http\Resources\ContactFormResource;

class ContactFormsController extends Controller
{
    public function __invoke()
    {
        $response = new ContactFormResource(ContactForm::create(Request::all()));

		return ApiResource::success(data: $response);
	}
}