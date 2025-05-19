<?php namespace AppPayment\Subscription\Http\Resources;

use October\Rain\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;
use AppPayment\Plan\Http\Resources\PlanResource;
use AppUser\UserApi\Http\Resources\UserSimpleResource;

class SubscriptionResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
			'plan' => new PlanResource($this->plan),
			'user' => new UserSimpleResource($this->user),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        Event::fire('apppayment.subscription.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
