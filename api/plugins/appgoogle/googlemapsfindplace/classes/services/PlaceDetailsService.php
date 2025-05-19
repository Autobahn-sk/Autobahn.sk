<?php namespace AppGoogle\GoogleMapsFindPlace\Classes\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PlaceDetailsService
{
	/**
	 * Get place details from Google Maps API using place ID.
	 *
	 * @param string $placeId
	 * @return array|null
	 * @throws GuzzleException
	 */
    public static function getPlaceDetails(string $placeId): ?array
    {
        $client = new Client();

        $key = env('GOOGLE_MAPS_API_KEY');

        $response = $client->get("https://maps.googleapis.com/maps/api/place/details/json?place_id=$placeId&key=$key");

        $response = json_decode($response->getBody()->getContents(), true);

        if (!array_key_exists('result', $response)) {
            return null;
        }

        return $response;
    }
}
