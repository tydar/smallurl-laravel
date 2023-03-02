<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RegistrationCode;
use App\Providers\RouteServiceProvider;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'code' => [
                'required',
                'exists:registration_codes',
                function (string $attribute, mixed $value, \Closure $fail) {
                    // Below statement should always be non-null because of the
                    // validation of `required` above.
                    $code = RegistrationCode::where('code', $value)->first();

                    if(!$code || $code->redemption_count >= $code->max_redemptions) {
                        $fail("The selected ${attribute} is invalid.");
                    }
                },
            ],
        ]);

        $code = RegistrationCode::where('code', $request->code)->first();
        $code->redemption_count++;
        $code->save();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
