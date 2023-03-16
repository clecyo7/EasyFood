<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\TenantService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        $request->validate([
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'confirmed', Rules\Password::defaults()],
             'cnpj' => ['required','unique:tenants'],
             'empresa' => ['required','unique:tenants,name'],
        ],
        [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'Campo nome só permite 255 caracteres',
            'name.unique' => 'Plano já cadastrado.',
            'password' => 'O campo senha é obrigatório',
            'cnpj' => 'O campo CNPJ é Obrigatório.',
            'empresa.required' => 'O campo empresa é obrigatório',
            'email.unique' => 'Email já foi cadastrado',
            'password.confirmed' => 'A confirmação da senha não corresponde',
            'cnpj.required' => 'O campo CNPJ é obrigatório',
        ]
    );

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        if (!$plan = session('plan')){
            return redirect()->back('site.home');
        }

        $tenant = $plan->tenants()->create([
            'cnpj'  => $request->cnpj,
            'name'  => $request->empresa,
           // 'url'   => Str::kebab($request->empresa),
            'email' => $request->email,

            'subscription' => now(),
            'expires_at' =>now()->addDays(7),
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
