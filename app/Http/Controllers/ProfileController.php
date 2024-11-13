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
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
        ]);

        $username = $validatedData['username'];


        dd($validatedData['razon_social']);
            $persona->nombre = $validatedData['nombre'];
            $persona->ap_paterno = $validatedData['ap_paterno'];
            $persona->ap_materno = $validatedData['ap_materno'];
            $persona->telefono = $validatedData['telefono'];

            $comprador->razon_social = $validatedData['razon_social'];

        $email = $validatedData['email'];



        // Verificar si el username o el email han cambiado y no están duplicados
        if ($user->username !== $username && !User::where('username', $username)->exists()) {
            $user->username = $username;
        }

        if ($user->email !== $email && !User::where('email', $email)->exists()) {
            $user->email = $email;
        }


        $persona->save();
        $comprador->save();
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }


    public function imageUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'crop_x' => 'required|numeric',
            'crop_y' => 'required|numeric',
            'crop_width' => 'required|numeric',
            'crop_height' => 'required|numeric',
            'main_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
