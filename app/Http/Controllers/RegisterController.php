<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'fullname' => 'required|regex:/^[\pL\s\-]+$/u',
            'username' => 'required',
            'password' => 'required|confirmed',
            'rol' => 'required',
        ]);
        User::create(request(['fullname','username','password','rol']))->assignRole(request(['rol']));
        return redirect()->route('login.index');
    }

    public function edit(){
        $id = auth()->user()->id;
        $user = User::find($id);
        return view('auth.useredit', compact('user'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'fullname' => 'required|regex:/^[\pL\s\-]+$/u',
            'username' => 'required',
            'user_image' => 'image',
        ]);
        //dd($request->all()); die();
        $user = User::findOrFail($id);
        if ($request->hasFile('user_image')) {
            if ($user->image != null) {
                Storage::disk('photos')->delete($user->image);
                $user->image = null;
            }
            $user->image = $request->file('user_image')->store('profile','photos');
        }
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->save();
        return redirect()->route('main.index');
    }

    public function updatepassword(Request $request, $id){
        $validated = $request->validate([
            'password' => 'required|confirmed',
        ]);
        $user = User::findOrFail($id);
        $user->password = $request->password;
        $user->save();
        return redirect()->route('login.destroy');
    }

}
