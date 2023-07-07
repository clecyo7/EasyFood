<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private $repository;

    public function __construct(Role $role)
    {
        $this->repository = $role;

        $this->middleware(['can:roles']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->paginate();

        return view('admin.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRole $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('roles.index')
            ->with('success', 'Cargo criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Cargo não encontrado');
        }

        return view('admin.pages.roles.show', [
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Cargo não encontrado');
        }

        return view('admin.pages.roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRole $request, $id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'não encontrado');
        }

        $role->update($request->all());
        return redirect()->route('roles.index')
            ->with('success', 'Cargo alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()
                ->with('warning', 'Cargo não encontrado');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Cargo deletado com sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('token');

        $roles = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->where('name', 'LIKE', "%{$request->filter}%")
                        ->orWhere('description', 'LIKE', "%{$request->filter}%");
                }
            })
            ->paginate();


        return view('admin.pages.roles.index', [
            'roles' => $roles,
            'filters' => $filters
        ]);
    }
}

