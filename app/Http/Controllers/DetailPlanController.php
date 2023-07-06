<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DetailPlanController extends Controller
{
    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;

        $this->middleware(['can:plans']);
    }



    public function index($urlPlan)
    {
        $plan =  $this->plan->where('url', $urlPlan)->first();

        if (!$plan)
            return redirect()->back()
                             ->with('warning', 'Plano não encontrado');;

        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
    }


    public function create($urlPlan)
    {
        $plan =  $this->plan->where('url', $urlPlan)->first();

        if (!$plan)
            return redirect()->back()
                             ->with('warning', 'Plano não encontrado');;

        return view('admin.pages.plans.details.create', [
            'plan' => $plan
        ]);
    }


    public function store(Request $request, $urlPlan)
    {
        $plan =  $this->plan->where('url', $urlPlan)->first();

        if (!$plan)
            return redirect()->back()
            ->with('warning', 'Plano não encontrado');

        // $data = $request->all();
        // $data['plan_id'] = $plan->id;
        // $this->repository->create($data);

        $plan->details()->create($request->all());


        return redirect()->route('details.plan.index', $plan->url)
                         ->with('success', 'Detalhe criado com sucesso');
    }


    public function edit($urlPlan, $idDetail)
    {
        $plan =  $this->plan->where('url', $urlPlan)->first();
        $detail =  $this->repository->find($idDetail);

        if (!$plan || !$detail)
            return redirect()->back()
                             ->with('warning', 'Plano não encontrado');

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }

    public function show($urlPlan, $idDetail)
    {
        $plan =  $this->plan->where('url', $urlPlan)->first();
        $detail =  $this->repository->find($idDetail);

        if (!$plan || !$detail)
            return redirect()->back()
            ->with('warning', 'Plano ou detalhe não encontrado');

        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }


    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
        $plan =  $this->plan->where('url', $urlPlan)->first();
        $detail =  $this->repository->find($idDetail);

        if (!$plan || !$detail)
            return redirect()->back()
                             ->with('warning', 'Plano não encontrado');

        $detail->update($request->all());


        return redirect()->route('details.plan.index', $plan->url)
                        ->with('success', 'Detalhe alterado com sucesso');
    }



    public function destroy($urlPlan, $idDetail)
    {
        $plan =  $this->plan->where('url', $urlPlan)->first();
        $detail =  $this->repository->find($idDetail);

        if (!$plan || !$detail)
            return redirect()->back();

        $detail->delete();


        return redirect()
       ->route('details.plan.index', $plan->url)
       ->with('success', 'Registro detelado com sucesso');
    }
}
