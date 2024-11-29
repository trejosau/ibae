<?php

namespace App\Http\Controllers;

use App\Models\Comprador;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{



    public function edit()
    {
        $user = Auth::user()->load([
            'persona',
            'persona.estudiante',
            'persona.profesor',
            'persona.estilista',
            'persona.administrador',
            'persona.comprador',
        ]);

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $persona = Persona::where('usuario', $user->id)->first();

        $comprador = Comprador::where('id_persona', $persona->id)->first();
        // Validación de los campos



        $validatedData = $request->validate([
            'nombre' => 'nullable|string|max:255',
            'ap_materno' => 'nullable|string|max:255',
            'ap_paterno' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'razon_social' => 'nullable|string|max:255',
            'username' => 'required|string|max:255',
        ]);


        $username = $validatedData['username'];



            $persona->nombre = $validatedData['nombre'];
            $persona->ap_paterno = $validatedData['ap_paterno'];
            $persona->ap_materno = $validatedData['ap_materno'];
            $persona->telefono = $validatedData['telefono'];

            $comprador->razon_social = $validatedData['razon_social'];




        // Verificar si el username o el email han cambiado y no están duplicados
        if ($user->username !== $username && !User::where('username', $username)->exists()) {
            $user->username = $username;
        }




        $persona->save();
        $comprador->save();
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $user = Auth::user();
        if ($user->password !== Hash::make($validatedData['current_password'])) {
            return redirect()->route('profile.edit')->with('error', 'La contraseña actual no es correcta.');
        }

        if ($validatedData['password'] !== $validatedData['password_confirmation']) {
            return redirect()->route('profile.edit')->with('error', 'Las contraseñas no coinciden.');
        }

        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Contraseña cambiada correctamente.');

    }



    public function imageUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'crop_x' => 'required|numeric',
            'crop_y' => 'required|numeric',
            'crop_width' => 'required|numeric',
            'crop_height' => 'required|numeric',
            'main_photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);


        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('main_photo')->getContent());

        if ($request->has('crop_x') && $request->has('crop_y') && $request->has('crop_width') && $request->has('crop_height')) {
            $image->crop(
                $request->input('crop_width'),
                $request->input('crop_height'),
                $request->input('crop_x'),
                $request->input('crop_y')
            );
        }

        $user = Auth::user();

        if ($user->profile_photo_url) {
            $user->profile_photo_url = null;
        }

        $image = $image->toWebp(90);
        $fileName = "{$user->username}_{$user->id}.webp";
        Storage::disk('s3')->put("images/profiles/{$fileName}", $image);

        $url = Storage::disk('s3')->url("images/profiles/{$fileName}");

        $user->profile_photo_url = $url;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Foto de perfil actualizada correctamente.');
    }
}
