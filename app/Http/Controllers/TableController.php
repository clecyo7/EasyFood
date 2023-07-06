<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTable;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $repository;

    public function __construct(Table $repository)
    {
        $this->repository = $repository;

        $this->middleware(['can:tables']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->latest()->paginate();

        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$table = $this->repository->find($id)) {
            return redirect()->back()
             ->with('warning', 'Mesa não encontrada');
        }

        return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back()
             ->with('warning', 'Mesa não encontrada');
        }
        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTable $request, $id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back()
             ->with('warning', 'Mesa não encontrada');
        }

        $table->update($request->all());
        return redirect()->route('tables.index')
        ->with('sucess', 'Mesa alterada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back()
             ->with('warning', 'Mesa não encontrada');
        }

        $table->delete($id);
        return redirect()->route('tables.index')
        ->with('warning', 'Mesa excluida com sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('token');

        $tables = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->where('description', 'LIKE', "%{$request->filter}%")
                        ->orWhere('identify', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate();


        return view('admin.pages.tables.index',compact('tables', 'filters'));
    }
}
