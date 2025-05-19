<?php namespace AppPayment\Stripe\Classes;

use Stripe\Plan;
use Stripe\Collection;
use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;

class PlansService
{
	protected static function client(): StripeClient
	{
		return new StripeClient(env('STRIPE_API_KEY'));
	}

	/**
	 * @throws ApiErrorException
	 */
	public static function createPlan(string $id, float $amount, string $interval, string $productId, string $name): Plan
	{
		if (self::checkIfPlanExists($id)) {
			return self::client()->plans->retrieve($id);
		}

		return self::client()->plans->create([
			'id' => $id,
			'amount' => $amount,
			'currency' => 'EUR',
			'interval' => $interval,
			'product' => $productId,
			'nickname' => $name
		]);
	}

	/**
	 * @throws ApiErrorException
	 */
	public static function updatePlan(string $id, float $amount, string $interval, string $productId, string $name): Plan
	{
		if (!self::checkIfPlanExists($id)) {
			return self::createPlan($id, $amount, $interval, $productId, $name);
		}

		return self::client()->plans->update($id, [
			'product' => $productId,
			'nickname' => $name
		]);
	}

	/**
	 * @throws ApiErrorException
	 */
	public static function deletePlan(string $id): ?Plan
	{
		if (self::checkIfPlanExists($id)) {
			return self::client()->plans->delete($id);
		}
	}

	/**
	 * @throws ApiErrorException
	 */
	public static function getAllPlans(): Collection
	{
		return self::client()->plans->all();
	}

	public static function checkIfPlanExists(string $id): bool
	{
		try {
			self::client()->plans->retrieve($id);
			return true;
		} catch (ApiErrorException $e) {
			return false;
		}
	}
}