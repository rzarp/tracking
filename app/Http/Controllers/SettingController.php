<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function editProfile()
    {
        return view('dashboard.setting', [
            'user' => User::findOrFail(auth()->user()->id)
        ]);
    }

    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;

        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ];

        if ($request->get('password')) {
            $data['password'] = Hash::make($request->get('password'));
        }

        User::where('id', $id)->update($data);

        
        return redirect()->route('profile');
    }
}
