<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermission;
use App\Http\Requests\UpdatePermission;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    private $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;

        $this->middleware(['can:permissions']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->repository->paginate();

        return view('admin.pages.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermission $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('permissions.index')
            ->with('success', 'Permissão criada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Permissão não encotrada');
        }

        return view('admin.pages.permission.show', [
            'permission' => $permission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Permissão não encotrada');
        }

        return view('admin.pages.permission.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermission $request, $id)
    {
        if (!$permissions = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Permissão não encontrada');
        }

        $permissions->update($request->all());
        return redirect()->route('permissions.index')
            ->with('sucess', 'Permissão alterada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$permissions = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Permissão não encontrada');
        }

        $permissions->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permissão deletada com sucesso');
    }

    public function search(Request $request)
    {

        $filters = $request->except('token');
        $permissions = $this->repository->search($request->filter);

        return view('admin.pages.permission.index', [
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }
}
