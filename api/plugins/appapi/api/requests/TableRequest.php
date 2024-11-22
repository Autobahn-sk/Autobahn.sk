<?php namespace AppApi\Api\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

abstract class TableRequest extends FormRequest
{
    public array $filterFieldOptions;

    public array $filterFieldOperators;

    public array $orderFieldOptions;

    public array $orderFieldOperators;


    public function rules()
    {
        $filters = $this->filters;
        $orders = $this->orders;

        $this->merge(['filters' => json_decode($filters, true)]);
        $this->merge(['orders' => json_decode($orders, true)]);

        return [
            'per_page' => ['integer', 'nullable'],
            'page' => ['integer', 'nullable'],
            'search' => ['string', 'nullable'],
            'filters' => ['array', 'nullable'],
            'filters.*.field' => ['string', 'required', Rule::in($this->filterFieldOptions)],
            'filters.*.operator' => ['string', 'required', Rule::in($this->filterFieldOperators)],
            'filters.*.value' => ['string', 'required'],
            'orders' => ['array', 'nullable'],
            'orders.*.field' => ['string', 'required', Rule::in($this->orderFieldOptions)],
            'orders.*.direction' => ['string', 'required', Rule::in($this->orderFieldOperators)],
            'metadata' => ['nullable', 'boolean']
        ];
    }
}
