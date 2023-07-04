<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCategory;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();
        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }
        $this->repository->create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Categoria não encontrada');;
        }
        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function update1(StoreUpdateProduct $request, $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Produto não encontrado');
        }

        $tenant = auth()->user()->tenant;

        // Obtém os dados do request
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Deleta a imagem anterior, se existir
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            // Define o caminho de armazenamento da nova imagem
            $data['image'] = $request->file('image')->store("tenants/{$tenant->uuid}/products");
        }

        // Atualiza o produto com os novos dados
        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produto atualizado com sucesso');
    }

    public function update(StoreUpdateProduct $request, $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Produto não encontrado');;
        }

        $data = $request->except(['_token', '_method']);
        $tenant = auth()->user()->tenant;


        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('sucess', 'Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Produto não encontrada');;
        }

        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        //deleta a imagem antiga ao excluir o produto
        $product->delete();

        return redirect()->route('products.index')
            ->with('sucess', 'Produto atualizado com sucesso');
    }


    public function search(Request $request)
    {
        $filters = $request->except('token');

        $categories = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->where('title', 'LIKE', "%{$request->filter}%")
                        ->orWhere('description', 'LIKE', "%{$request->filter}%");
                }
            })
            ->paginate();


        return view('admin.pages.products.index', [
            'categories' => $categories,
            'filters' => $filters
        ]);
    }
}
