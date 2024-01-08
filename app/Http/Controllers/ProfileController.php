<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit() {
        if(Auth::guest()) {
            return abort(401);
        }
        if(Auth::user()->profile == null) {
            Profile::create([
                'user_id' => Auth::id()
            ]);
        }
        return view('profile.edit', [
            'profile' => Auth::user()->profile
        ]);
    }

    public function update(Request $request) {
        if(Auth::check() && Auth::user()->profile != null ) {
            Auth::user()->profile->update($request->all());
            return $this->edit();
        }
        return abort(401);
    }
}
