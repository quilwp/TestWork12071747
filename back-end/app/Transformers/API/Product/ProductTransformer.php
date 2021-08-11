<?php


namespace App\Transformers\API\Product;


use App\Models\Category;
use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'categories'
    ];

    /**
     * @param Product $product
     * @return array
     */
    public function transform(Product $product): array
    {
        return [
            'id' => (int) $product->id,
            'name' => (string) $product->name,
            'slug' => (string) $product->slug,
            'price' => (float) $product->price,
            'quantity' => (int) $product->quantity,
            'description' => (string) $product->description
        ];
    }

    /**
     * @param Product $product
     * @return \League\Fractal\Resource\Collection
     */
    public function includeCategories(Product $product)
    {
        return $this->collection($product->categories, function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name
            ];
        });
    }
}
