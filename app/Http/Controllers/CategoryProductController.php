<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{

    public function __construct(
        protected Product $product,
        protected Category $category

        
    ) {
        $this->middleware(['can:products']);
    }

    public function categories($idProfile)
    {
      //  $product = $this->product->with('categories')->find($idProfile);
        $product = $this->product->find($idProfile);

        if (!$product) {
            return redirect()->back()
                ->with('warning', 'Pefil não encontrado');
        }

        $categories = $product->categories()->paginate();
        return view('admin.pages.products.categories.categories', compact('product', 'categories'));
    }

    public function products($idCategory)
    {
        // verifica se existe a permissão
        if (!$category = $this->category->find($idCategory)) {
            return redirect()->back()
                ->with('warning', 'Categoria não encontrada');
        }
        // devolve todas as permissões
        $products = $category->products()->paginate();
        return view('admin.pages.categories.products.products', compact('category', 'products'));
    }

    public function categoriesAvailable(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct)) {
            return redirect()->back()
                ->with('warning', 'Pefil não encontrado');
        }

        // recebe o filter no request
        $filters = $request->except('_token');

        // lista apenas as permissões que não estão vinculadas ao perfil, envia o filter
        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));
    }

    public function attchCategoriesProduct(Request $request, $idProduct)
    {
        // verifica se existe o perfil
        if (!$product = $this->product->find($idProduct)) {
            return redirect()->back()
                ->with('warning', 'Produto não encontrado');
        }

        // verifica se existe categorias e se é igual a zero
        if (!$request->categories || count($request->categories) == 0) {
            return redirect()->back()
                ->with('warning', 'Necessário escolher pelo menos uma categoria');
        }

        // vincula a permissão ao perfil
        $product->categories()->attach($request->categories);
        return redirect()->route('products.categories', $product->id);
    }

    public function detachCategoryProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        // verifica se existe o perfil e a permissão
        if (!$product || !$category) {
            return redirect()->back()
                ->with('warning', 'Pefil não encontrado ou Permissão não encotrada');
        }

        // desvincula a permissão do perfil
        $product->categories()->detach($category);
        return redirect()->route('products.categories', $product->id);
    }
}
