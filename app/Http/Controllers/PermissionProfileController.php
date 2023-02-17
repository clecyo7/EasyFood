<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{

    public function __construct(
        protected Profile $profile,
        protected Permission $permission
    ) {
    }



    public function permissions($idProfile)
    {
        //busca o perfil com relacionamento de permissões
        $profile = $this->profile->with('permissions')->find($idProfile);

        //verifica se existe o perfil
        if (!$profile) {
            return redirect()->back()
                ->with('warning', 'Pefil não encontrado');
        }
        // devolve todas as permissões
        $permissions = $profile->permissions()->paginate();
        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }

    public function permissionsAvailable(Request $request, $id)
    {
        // verifica se o perfil existe
        if (!$profile = $this->profile->find($id)) {
            return redirect()->back()
                ->with('warning', 'Pefil não encontrado');
        }

        // recebe o filter no request
        $filters = $request->except('_token');

        // lista apenas as permissões que não estão vinculadas ao perfil, envia o filter
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }

    public function attchPermissionsProfile(Request $request, $id)
    {
        // verifica se existe o perfil
        if (!$profile = $this->profile->find($id)) {
            return redirect()->back()
                ->with('warning', 'Pefil não encontrado');
        }

        // verifica se existe permissões e se é igual a zero
        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()
                ->with('warning', 'Necessário escolher pelo menos uma permissão');
        }

        // vincula a permissão ao perfil
        $profile->permissions()->attach($request->permissions);
        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {

        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        // verifica se existe o perfil e a permissão
        if (!$profile || !$permission) {
            return redirect()->back()
                ->with('warning', 'Pefil não encontrado ou Permissão não encotrada');
        }

        // desvincula a permissão do perfil
        $profile->permissions()->detach($permission);
        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function profiles($idPermission)
    {
        // verifica se existe a permissão
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()
                ->with('warning', 'Permissão não encontrado');
        }
        // devolve todas as permissões
        $profiles = $permission->profiles()->paginate();
        return view('admin.pages.permission.profiles.profiles', compact('permission', 'profiles'));
    }
}
