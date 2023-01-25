<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePlan;
use Illuminate\Support\Str;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }
    public function index()
    {
        $plans = $this->repository->latest()->paginate(15);
        return view('admin.pages.plans.index', [
            'plans'  => $plans
        ]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('plans.index')
            ->with('success', 'Plano criado com sucesso');
    }


    public function show($url)
    {
        $plan =  $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back()
                ->with('warning', 'Plano não encontrado');
        return view('admin.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    public function edit($url)
    {
        $plan =  $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back()
                ->with('warning', 'Plano não encontrado');

        return view('admin.pages.plans.edit', [
            'plan' => $plan
        ]);
    }

    public function update(StoreUpdatePlan $request, $url)
    {
        $plan =  $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back()
                ->with('warning', 'Plano não encontrado');

        $plan->update($request->all());
        return redirect()->route('plans.index')
            ->with('success', 'Plano alterado com sucesso');
    }

    public function destroy($url)
    {
        $plan =  $this->repository
                            ->with('details')
                            ->where('url', $url)
                            ->first();

        if (!$plan)
            return redirect()->back()
                ->with('warning', 'Plano não encontrado');


        if($plan->details->count() > 0 ){
            return redirect()->back()
            ->with('error', 'Existem detalhes vinculados a esse plano, portanto não pode ser deletado');
        }       
        $plan->delete();

        return redirect()->route('plans.index')
            ->with('success', 'Plano deletado com sucesso');
    }

    public function search(Request $request)
    {

        $filters = $request->except('token');
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters
        ]);
    }
}
