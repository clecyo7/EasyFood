<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    public function __construct(
        protected Profile $profile,
        protected Plan $plan
    ) {
    }

    public function profiles($idPlan)
    {
        //verifica se existe o plano
        if (! $plan = $this->plan->find($idPlan)) {
            return redirect()->back()
                ->with('warning', 'Plano não encontrado');
        }
        // devolve todas os planos
        $profiles = $plan->profiles()->paginate();
        return view('admin.pages.plans.profiles.profiles', compact('profiles', 'plan'));
    }

    public function profilesAvailable(Request $request, $idPlan)
    {
        // verifica se o perfil existe
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()
                ->with('warning', 'Plano não encontrado');
        }

        // recebe o filter no request
        $filters = $request->except('_token');

        // lista apenas as permissões que não estão vinculadas ao perfil, envia o filter
        $profiles = $plan->permissionsAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', compact('profiles', 'plan', 'filters'));
    }

    public function attchPlansProfile(Request $request, $idPlan)
    {
        // verifica se existe o perfil
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()
                ->with('warning', 'Plano não encontrado');
        }

        // verifica se existe permissões e se é igual a zero
        if (!$request->profiles || count($request->profiles) == 0) {
            return redirect()->back()
                ->with('warning', 'Necessário escolher pelo menos um Perfil');
        }

        // vincula a permissão ao perfil
        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles', $plan->id);
    }

    public function detachPlanProfile($idPlan, $idProfile)
    {

        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        // verifica se existe o perfil e a permissão
        if (!$plan || !$profile) {
            return redirect()->back()
                ->with('warning', 'Pefil não encontrado ou Plano não encotrada');
        }

        // desvincula a permissão do perfil
        $plan->profiles()->detach($profile);
        return redirect()->route('plans.profiles', $plan->id);
    }

    public function plans($idProfile)
    {
        // verifica se existe a permissão
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()
                ->with('warning', 'Permissão não encontrado');
        }
        // devolve todas as permissões
        $plans = $profile->plan()->paginate();
        return view('admin.pages.profiles.plans.plans', compact('plans', 'profile'));
    }
}
