<?php


namespace App\Transformers\API\Product;


use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductsTransformer extends TransformerAbstract
{
    /**
     * @param Product $product
     * @return array
     */
    public function transform(Product $product): array
    {
        return [
            'id' => (int) $product->id,
            'name' => (string) $product->name,
            'price' => (float) $product->price,
            'quantity' => (int) $product->quantity,
            'last_modify' => (string) $product->updated_at->diffForhumans()
        ];
    }
}
