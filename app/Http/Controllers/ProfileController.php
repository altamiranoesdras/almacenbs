<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profile = Auth::user();
        return view('admin.users.profile',compact('profile'));
    }

    public function update(User $user,Request $request)
    {

        if ($request->password){

            $request->merge([
                'password' => bcrypt($request->password)
            ]);

        }

        $user->fill($request->all());
        $user->save();

        flash(__('Updated profile!'))->success()->important();

        return redirect(route('profile'));
    }

    public function updatePassword(User $user,Request $request)
    {


        $request->validate([
            'nueva_contrasena' => "min:6"
        ]);


        if (!Hash::check($request->contrasena_actual,$user->password)){

            $msj = "La contraseña actual no coincide!";
            flash($msj)->error();

            return redirect(route('profile')."?tab=2")->withErrors([$msj]);

        }else{

            $user->password = bcrypt($request->nueva_contrasena);
            $user->save();
        }


        flash(__('Updated profile!'))->success()->important();

        return redirect(route('profile'));
    }

    public function editAvatar(User $user,Request $request)
    {

        try {
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');


        } catch (\Exception $exception) {

            return response()->json($exception->getMessage(),500);
        }

        flash("Imagen Actualizada")->success();
        return response()->json($user->toArray());

    }

    public function removeAvatar(User $user)
    {
        $user->clearMediaCollection('avatars');

        flash('Listo.')->success();

        return redirect(route('profile'));
    }
}
