<?php namespace AppPayment\Stripe\Classes;

use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;

class PaymentIntentService
{
	protected static function client(): StripeClient
	{
		return new StripeClient(env('STRIPE_API_KEY'));
	}

	/**
	 * @throws ApiErrorException
	 */
	public static function getIntent(string $id): PaymentIntent
	{
		return self::client()->paymentIntents->retrieve($id);
	}
}
