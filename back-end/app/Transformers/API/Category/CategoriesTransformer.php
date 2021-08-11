<?php


namespace App\Transformers\API\Category;


use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoriesTransformer extends TransformerAbstract
{
    /**
     * @param Category $category
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'last_modify' => $category->updated_at->diffForhumans()
        ];
    }
}
