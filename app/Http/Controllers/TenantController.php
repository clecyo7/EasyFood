<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTenant;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    private $repository;

    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;

        //    $this->middleware(['can:tenants']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tenants.create');
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
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/tenants");
        }
        $this->repository->create($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenants
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Categoria não encontrada');;
        }
        return view('admin.pages.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenant $request, $id)
    {

        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Empresa não encontrada');;
        }

        $data = $request->except(['_token', '_method']);

        $tenant = auth()->user()->tenant;


        if ($request->hasFile('logo') && $request->logo->isValid()) {

            if (Storage::exists($tenant->logo)) {
                Storage::delete($tenant->logo);
            }
            $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}/tenants");
        }

        $tenant->update($data);

        return redirect()->route('tenants.index')
            ->with('sucess', 'Empresa atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenants
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Empresa não encontrada');;
        }

        if ($tenant->logo && Storage::exists($tenant->image)) {
            Storage::delete($tenant->image);
        }

        //deleta a imagem antiga ao excluir o produto
        $tenant->delete();

        return redirect()->route('tenants.index')
            ->with('sucess', 'Empresa atualizada com sucesso');
    }


    public function search(Request $request)
    {

        $filters = $request->except('token');

        $tenants = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->where('name', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate();


        return view('admin.pages.tenants.index', compact('tenants', 'filters'));
    }
}
