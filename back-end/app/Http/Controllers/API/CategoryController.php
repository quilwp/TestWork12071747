<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Category\StoreRequest;
use App\Http\Requests\API\Category\UpdateRequest;
use App\Models\Category;
use App\Transformers\API\Category\CategoriesTransformer;
use App\Transformers\API\Category\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if ($request->get('page') == 'all') {
            return responder()->success(Category::all(), CategoriesTransformer::class)->respond();
        }

        return responder()->success(Category::paginate(10), CategoriesTransformer::class)->respond();
    }

    /**
     * @param StoreRequest $request
     */
    public function store(StoreRequest $request)
    {
        $category = Category::create($request->all());

        return responder()->success($category)->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if ($category) {
            return responder()->success($category, CategoryTransformer::class)->respond();
        }

        return responder()->error()->respond(404);
    }

    public function update(UpdateRequest $request, $id)
    {
        $category = Category::find($id);

        if($category) {
            Category::where('id', $id)->update($request->all());

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
        Category::destroy($id);

        return responder()->success()->respond();
    }
}
