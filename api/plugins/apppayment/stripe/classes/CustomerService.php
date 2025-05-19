<?php namespace AppPayment\Stripe\Classes;

use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;

class CustomerService
{
	protected static function client(): StripeClient
	{
		return new StripeClient(env('STRIPE_API_KEY'));
	}

	/**
	 * @throws ApiErrorException
	 */
	public static function checkForCustomerIdOrAssign($user): void
	{
		if (!$user->stripe_id) {
			$customer = self::client()->customers->create([
				'email' => $user->email
			]);

			$user->stripe_id = $customer->id;
			$user->save();
		}
	}
}