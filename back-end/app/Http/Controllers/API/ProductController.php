<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Product\StoreRequest;
use App\Http\Requests\API\Product\UpdateRequest;
use App\Models\Product;
use App\Transformers\API\Product\ProductsTransformer;
use App\Transformers\API\Product\ProductTransformer;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return responder()->success(Product::paginate(20), ProductsTransformer::class)->respond();
    }

    public function store(StoreRequest $request)
    {
        $product = Product::create($request->except('category_ids'));
        $product->categories()->sync($request->category_ids);

        return responder()->success($product)->respond();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::with('categories')->find($id);

        if ($product) {
            return responder()->success($product, ProductTransformer::class)->respond();
        }

        return responder()->error()->respond(404);
    }
    
    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            Product::where('id', $id)->update($request->except('category_ids'));

            $product->categories()->sync($request->category_ids);

            return responder()->success()->respond();
        }

        return responder()->error()->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return responder()->success()->respond();
    }
}
