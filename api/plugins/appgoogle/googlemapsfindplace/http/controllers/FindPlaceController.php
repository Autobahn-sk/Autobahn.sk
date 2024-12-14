<?php namespace AppGoogle\GoogleMapsFindPlace\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GuzzleHttp\Exception\GuzzleException;
use AppApi\ApiResponse\Resources\ApiResource;

class FindPlaceController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(Request $request)
    {
        $client = new Client();

        $key = env('GOOGLE_MAPS_API_KEY');
        $queryParams = http_build_query($request->all());

        $response = $client->get("https://maps.googleapis.com/maps/api/place/textsearch/json?key=$key&$queryParams");

		return ApiResource::success(data: json_decode($response->getBody()->getContents(), true));
    }
}
