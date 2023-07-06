<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
              //  'cnpj'     => ['required', 'numeric', 'cnpj', 'unique:tenants'],
                'empresa'  => ['required', 'string', 'min:3', 'max:255', 'unique:tenants,name'],
            ],
            [
                'name.required'      => 'O campo nome é obrigatório.',
                'name.max'           => 'Campo só permite 255 caracteres',
                'name.unique'        => 'Plano já cadastrado.',
                'password.required'  => 'O campo senha é obrigatório',
                'password.confirmed' => 'A confirmação da senha não corresponde',
                'cnpj.unique'        => 'CNPJ já cadastrado.',
                'cnpj.min'           => 'Campo precisa ter 14 caracteres',
                'cnpj.max'           => 'Campo precisa ter 15 caracteres',
                'cnpj.required'      => 'O campo CNPJ é obrigatório',
                'cnpj.numeric'       => 'O cnpj deve ser um número',
                'empresa.required'   => 'O campo empresa é obrigatório',
                'empresa.unique'     => 'Empresa já cadastrada',
                'empresa.min'        => 'A empresa deve ter pelo menos 3 caracteres',
                'empresa.max'        => 'Campo só permite 255 caracteres',
                'email.unique'       => 'Email já foi cadastrado',
                'email.required'     => 'o campo Email é obrigatório',
            ]
        );


        if (!$plan = session('plan')) {
            return redirect()->back('site.home');
        }

        $tenant = $plan->tenants()->create([
            'cnpj'  => $request->cnpj,
            'name'  => $request->empresa,
            'email' => $request->email,
           // 'url'   => Str::kebab($request->empresa), criado observer uui
            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);

        $user = $tenant->users()->create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //  $tenantService = app(TenantService::class);

        //  $user = $tenantService->make($plan, $request);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
