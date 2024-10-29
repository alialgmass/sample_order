<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CreateOrderRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return array_merge(
            $this->baseRules(),
            $this->itemRules()
        );
    }

    /**
     * Get the base validation rules for the request.
     */
    private function baseRules(): array
    {
        return [
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|int|min:1',
            'coupon_code' => 'nullable|string',
        ];
    }

    /**
     * Get the validation rules for each item in the items array.
     */
    private function itemRules(): array
    {
        $rules = [];
        foreach ($this->input('items', []) as $key => $item) {
            $rules = array_merge($rules, $this->getItemValidationRules($key, $item));
        }

        return $rules;
    }

    /**
     * Get the validation rules for a specific item.
     *
     * @param  string  $key  The key of the item in the array.
     * @param  array  $item  The item data.
     */
    private function getItemValidationRules(string $key, array $item): array
    {
        return [
            "items.$key.color_id" => $this->colorRule($item['id'] ?? null),
            "items.$key.size_id" => $this->sizeRule($item['id'] ?? null),
        ];
    }

    /**
     * Get the validation rules for the color ID.
     *
     * @param  int|null  $productId  The product ID to validate against.
     */
    private function colorRule(?int $productId): array
    {
        return [
            'required',
            Rule::exists('product_colors', 'id')->where('product_id', $productId),
        ];
    }

    /**
     * Get the validation rules for the size ID.
     *
     * @param  int|null  $productId  The product ID to validate against.
     */
    private function sizeRule(?int $productId): array
    {
        return [
            'required',
            Rule::exists('product_sizes', 'id')->where('product_id', $productId),
        ];
    }
}
