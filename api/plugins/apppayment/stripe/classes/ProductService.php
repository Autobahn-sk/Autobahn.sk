<?php namespace AppPayment\Stripe\Classes;

use Stripe\Product;
use Stripe\Collection;
use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;

class ProductService
{
	protected static function client(): StripeClient
	{
		return new StripeClient(env('STRIPE_API_KEY'));
	}

	/**
	 * @throws ApiErrorException
	 */
	public static function createProduct(string $id, string $name, string $description): Product
	{
		if (self::checkIfProductExists($id)) {
			return self::client()->products->retrieve($id);
		}

		return self::client()->products->create([
			'id' => $id,
			'name' => $name,
			'description' => $description
		]);
	}

	/**
	 * @throws ApiErrorException
	 */
	public static function getAllProducts(): Collection
	{
		return self::client()->products->all();
	}

	public static function checkIfProductExists(string $id): bool
	{
		try {
			self::client()->products->retrieve($id);
			return true;
		} catch (ApiErrorException $e) {
			return false;
		}
	}
}