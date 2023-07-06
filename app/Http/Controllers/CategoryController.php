<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCategory;
use App\Models\Category;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(Category $category)
    {
        $this->repository = $category;

        $this->middleware(['can:categories']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->latest()->paginate();
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategory $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(!$category = $this->repository->find($id)) {
            return redirect()->back();
        }
        return view('admin.pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$category = $this->repository->find($id)) {
            redirect()->back()
            ->with('warning', 'Categoria não encontrada');
        }

        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategory $request, $id)
    {
        if(!$category = $this->repository->find($id)) {
            redirect()->back()
            ->with('warning', 'Categoria não encontrada');
        }

        $category->update($request->all());
        return redirect()->route('categories.index')
        ->with('sucess', 'Categoria alterada com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Categoria não encontrada');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoria deletada com sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('token');

        $categories = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->where('name', 'LIKE', "%{$request->filter}%")
                        ->orWhere('description', 'LIKE', "%{$request->filter}%");
                }
            })
            ->paginate();


        return view('admin.pages.categories.index', [
            'categories' => $categories,
            'filters' => $filters
        ]);
    }
}
