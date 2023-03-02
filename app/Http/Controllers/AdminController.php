<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RegistrationCode;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(15);
        $codes = RegistrationCode::paginate(15);

        return view('admin.show', [
            'users' => $users,
            'codes' => $codes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Show the admin form for editing a user.
     */
    public function user_edit(string $id)
    {
        $user = User::find($id);

        if(!$user) {
            return view('admin.show')->with('status', 'no-such-user');
        }

        return view('admin.user', [
            'user' => $user,
        ]);
    }

    /**
     * Show the admin form for editing a registration code.
     */
    public function code_edit(string $id)
    {
        $code = RegistrationCode::find($id);

        if(!$code) {
            return view('admin.show')->with('status', 'no-such-registration-code');
        }

        return view('admin.registration_code', [
            'code' => $code,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function code_update(Request $request, string $id)
    {
        $validated = $request->validate([
            'code' => 'required|alpha_num|max:30|min:5',
            'redemption_count' => 'required|integer|min:0',
            'max_redemptions' =>  'required|integer|min:0|max:100',
        ]);

        $code = RegistrationCode::find($id);
        if(!$code) {
            return view('admin.show')->with('status', 'no-such-registration-code');
        }

        if($code->code != $validated['code']) {
            $other_codes = RegistrationCode::where('code', $validated['code'])->get()->isEmpty();
            if(!$other_codes) {
                return Redirect::route('admin.registration_code', ['id' => $code->id])->withErrors([
                    'code' => 'This code is already in use.',
                ]);
            }
        }

        $code->code = $validated['code'];
        $code->redemption_count = $validated['redemption_count'];
        $code->max_redemptions = $validated['max_redemptions'];
        $code->save();

        return Redirect::route('admin.registration_code', ['id' => $code->id])->with('status', 'code-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
