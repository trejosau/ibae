<?php

namespace App\Http\Controllers;

use App\Mail\EnvioCredenciales;
use App\Models\Administrador;
use App\Models\Comprador;
use App\Models\Estilista;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    function generarContrasenaAleatoria($longitud = 8) {
        // Caracteres permitidos en cada categoría
        $minusculas = 'abcdefghijklmnopqrstuvwxyz';
        $mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numeros = '0123456789';
        $simbolos = '!@#$()_+-={}:?';

        // Aseguramos que cada tipo de carácter esté presente al menos una vez
        $contrasena = $minusculas[random_int(0, strlen($minusculas) - 1)] .
            $mayusculas[random_int(0, strlen($mayusculas) - 1)] .
            $numeros[random_int(0, strlen($numeros) - 1)] .
            $simbolos[random_int(0, strlen($simbolos) - 1)];

        // Llenamos el resto de la contraseña hasta la longitud deseada
        $todos = $minusculas . $mayusculas . $numeros . $simbolos;
        for ($i = strlen($contrasena); $i < $longitud; $i++) {
            $contrasena .= $todos[random_int(0, strlen($todos) - 1)];
        }

        // Mezclamos los caracteres para mayor aleatoriedad
        return str_shuffle($contrasena);
    }

    public function agregarAdmin(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'ap_paterno' => 'required|string|max:255',
            'ap_materno' => 'required|string|max:255',
            'phone' => ['required', 'string', 'min:13', 'max:13', 'regex:/^\+52\d{10}$/'],
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'ap_paterno.required' => 'El apellido paterno es obligatorio.',
            'ap_paterno.string' => 'El apellido paterno debe ser una cadena de texto.',
            'ap_paterno.max' => 'El apellido paterno no puede tener más de 255 caracteres.',

            'ap_materno.required' => 'El apellido materno es obligatorio.',
            'ap_materno.string' => 'El apellido materno debe ser una cadena de texto.',
            'ap_materno.max' => 'El apellido materno no puede tener más de 255 caracteres.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone.min' => 'El número de teléfono debe tener exactamente 13 caracteres.',
            'phone.max' => 'El número de teléfono debe tener exactamente 13 caracteres.',
            'phone.regex' => 'El número de teléfono debe tener el formato correcto (+52 seguido de 10 dígitos).',

            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'username.max' => 'El nombre de usuario no puede tener más de 255 caracteres.',
            'username.unique' => 'El nombre de usuario ya está en uso.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
        ]);



        // Generar contraseña aleatoria
        $password = $this->generarContrasenaAleatoria();

        $emailExiste = User::where('email', $request->email)->first();

        if ($emailExiste) {
            // Si el email ya existe, actualizamos los datos
            $user = User::where('email', $request->email)->first();
            $user->assignRole('admin');
            $persona = $user->persona;

            $persona->update([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->telefono,
            ]);

            Administrador::create([
                'id_persona' => $persona->id,
                'created_at' => now(),
                'updated_at' => null,
            ]);



            $user->save();

            return redirect()->route('dashboard.usuarios')->with('success', 'Usuario con este correo ya existe, datos actualizados y correo enviado.');
        }
        \DB::beginTransaction();

        try {
            // Crear el usuario
            $usuario = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($password),
                'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
            ]);

            // Crear la persona
            $persona = Persona::create([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->phone,
                'usuario' => $usuario->id,
            ]);

            // Crear el comprador
            $cliente = Comprador::create([
                'id_persona' => $persona->id,
                'razon_social' => null,
                'created_at' => now(),
                'updated_at' => null,
            ]);

            // Crear el administrador
            $admin = Administrador::create([
                'id_persona' => $persona->id,
            ]);

            // Asignar roles
            $usuario->assignRole('cliente');
            $usuario->assignRole('admin');

            \DB::commit();

            if ($admin) {
                Mail::to($request->email)->send(new EnvioCredenciales($usuario, $password));
            }


            return redirect()->route('dashboard.usuarios')->with('success', 'Usuario creado con éxito. Se ha enviado un correo con las credenciales.');

        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            \DB::rollback();

            // Pasar el mensaje de error detallado a la sesión
            return redirect()->route('dashboard.usuarios')->with('error', 'Error al crear usuario: ' . $e->getMessage());
        }
    }


    public function agregarEstilista(Request $request)
    {
        // Validación de datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ap_paterno' => 'required|string|max:255',
            'ap_materno' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'min:15',
                'max:15',
                'regex:/^\+52\d{10}$/'
            ],
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'ap_paterno.required' => 'El apellido paterno es obligatorio.',
            'ap_paterno.string' => 'El apellido paterno debe ser una cadena de texto.',
            'ap_paterno.max' => 'El apellido paterno no puede tener más de 255 caracteres.',

            'ap_materno.required' => 'El apellido materno es obligatorio.',
            'ap_materno.string' => 'El apellido materno debe ser una cadena de texto.',
            'ap_materno.max' => 'El apellido materno no puede tener más de 255 caracteres.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone.min' => 'El número de teléfono debe tener exactamente 15 caracteres.',
            'phone.max' => 'El número de teléfono debe tener exactamente 15 caracteres.',
            'phone.regex' => 'El número de teléfono debe estar en el formato: +52 seguido de 10 dígitos.',

            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'username.max' => 'El nombre de usuario no puede tener más de 255 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
        ]);


        $emailExiste = User::where('email', $request->email)->first();
        if ($emailExiste) {
            $user = User::where('email', $request->email)->first();
            $user->assignRole('estilista');

            $persona = $user->persona;

            $persona->update([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->phone,
            ]);

            Estilista::create([
                'estado' => 'activo',
                'id_persona' => $persona->id,
            ]);

            return redirect()->route('dashboard.usuarios')->with('success', 'Usuario con este correo ya existe, datos actualizados y correo enviado.');
        }



        // Generar contraseña aleatoria
        $password = $this->generarContrasenaAleatoria();


        // Iniciar una transacción
        \DB::beginTransaction();

        try {
            // Crear el usuario
            $usuario = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($password),
                'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
            ]);

            // Crear la persona
            $persona = Persona::create([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->phone,
                'usuario' => $usuario->id,
            ]);

            $cliente = Comprador::create([
                'id_persona' => $persona->id,
                'razon_social' => null,
                'created_at' => now(),
                'updated_at' => null,
            ]);

            // Crear el estilista
            $estilista = Estilista::create([
                'estado' => 'activo',
                'id_persona' => $persona->id,
                'created_at' => now(),
                'updated_at' => null,
            ]);


            // Asignar roles
            $usuario->assignRole('cliente');
            $usuario->assignRole('estilista');

            \DB::commit();

            if ($estilista) {
                Mail::to($request->email)->send(new EnvioCredenciales($usuario, $password));
            }

            return redirect()->route('dashboard.usuarios')->with('success', 'Usuario creado con éxito. Se ha enviado un correo con las credenciales.');

        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            \DB::rollback();
            return redirect()->route('dashboard.usuarios')->with('error', 'Error al crear usuario.');
        }
    }


        public function agregarProfesor(Request $request)
    {
        // Validation rules
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ap_paterno' => 'required|string|max:255',
            'ap_materno' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:13',
                'min:13',
                'regex:/^\+52\d{10}$/',
            ],
            'RFC' => 'nullable|string|max:20',
            'CURP' => 'nullable|string|max:20',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255',
            'especialidad' => 'required|string|in:estilismo,barbería,maquillaje,uñas',
            'zipcode' => 'required|string|size:5',
            'ciudad' => 'required|string|max:100',
            'colonia' => 'required|string|max:100',
            'calle' => 'required|string|max:100',
            'n_ext' => 'required|string|max:10',
            'n_int' => 'nullable|string|max:10',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'ap_paterno.required' => 'El apellido paterno es obligatorio.',
            'ap_paterno.string' => 'El apellido paterno debe ser una cadena de texto.',
            'ap_paterno.max' => 'El apellido paterno no puede tener más de 255 caracteres.',

            'ap_materno.required' => 'El apellido materno es obligatorio.',
            'ap_materno.string' => 'El apellido materno debe ser una cadena de texto.',
            'ap_materno.max' => 'El apellido materno no puede tener más de 255 caracteres.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone.max' => 'El número de teléfono no puede tener más de 13 caracteres.',
            'phone.min' => 'El número de teléfono debe tener exactamente 13 caracteres.',
            'phone.regex' => 'El número de teléfono debe estar en el formato: +52 seguido de 10 dígitos.',

            'RFC.max' => 'El RFC no puede tener más de 20 caracteres.',

            'CURP.max' => 'La CURP no puede tener más de 20 caracteres.',

            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'username.max' => 'El nombre de usuario no puede tener más de 255 caracteres.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',

            'especialidad.required' => 'La especialidad es obligatoria.',
            'especialidad.string' => 'La especialidad debe ser una cadena de texto.',
            'especialidad.in' => 'La especialidad debe ser una de las siguientes opciones: estilismo, barbería, maquillaje, uñas.',

            'zipcode.required' => 'El código postal es obligatorio.',
            'zipcode.string' => 'El código postal debe ser una cadena de texto.',
            'zipcode.size' => 'El código postal debe tener exactamente 5 caracteres.',

            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.string' => 'La ciudad debe ser una cadena de texto.',
            'ciudad.max' => 'La ciudad no puede tener más de 100 caracteres.',

            'colonia.required' => 'La colonia es obligatoria.',
            'colonia.string' => 'La colonia debe ser una cadena de texto.',
            'colonia.max' => 'La colonia no puede tener más de 100 caracteres.',

            'calle.required' => 'La calle es obligatoria.',
            'calle.string' => 'La calle debe ser una cadena de texto.',
            'calle.max' => 'La calle no puede tener más de 100 caracteres.',

            'n_ext.required' => 'El número exterior es obligatorio.',
            'n_ext.string' => 'El número exterior debe ser una cadena de texto.',
            'n_ext.max' => 'El número exterior no puede tener más de 10 caracteres.',

            'n_int.max' => 'El número interior no puede tener más de 10 caracteres.',
        ]);

        $emailExiste = User::where('email', $request->email)->first();

        if ($emailExiste) {
            // Si el email ya existe, actualizamos los datos
            $user = User::where('email', $request->email)->first();

            $persona = $user->persona;
            $persona->update([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->phone,
            ]);
            Profesor::create([
                'especialidad' => $request->especialidad,
                'fecha_contratacion' => now(),
                'RFC' => $request->RFC,
                'CURP' => $request->CURP,
                'estado' => 'activo',
                'id_persona' => $persona->id,
                'zipcode' => $request->zipcode,
                'ciudad' => $request->ciudad,
                'colonia' => $request->colonia,
                'calle' => $request->calle,
                'n_ext' => $request->n_ext,
                'n_int' => $request->n_int,
                'created_at' => now(),
                'updated_at' => null,
            ]);
            $user->assignRole('profesor');
        }

        // Generate a random password
        $password = $this->generarContrasenaAleatoria();

        \DB::beginTransaction();

        try {
            // Crear el usuario
            $usuario = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($password),
                'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
            ]);

            // Crear la persona
            $persona = Persona::create([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->phone,
                'usuario' => $usuario->id,
            ]);

            // Crear el comprador
            $cliente = Comprador::create([
                'id_persona' => $persona->id,
                'razon_social' => null,
                'created_at' => now(),
                'updated_at' => null,
            ]);



        // Create the professor
        $profesor = Profesor::create([
            'especialidad' => $request->especialidad,
            'fecha_contratacion' => now(),
            'RFC' => $request->RFC,
            'CURP' => $request->CURP,
            'estado' => 'activo',
            'id_persona' => $persona->id,
            'zipcode' => $request->zipcode,
            'ciudad' => $request->ciudad,
            'colonia' => $request->colonia,
            'calle' => $request->calle,
            'n_ext' => $request->n_ext,
            'n_int' => $request->n_int,
            'created_at' => now(),
            'updated_at' => null,
        ]);



            // Asignar roles
            $usuario->assignRole('cliente');
            $usuario->assignRole('profesor');

            \DB::commit();

            if ($profesor) {
                Mail::to($request->email)->send(new EnvioCredenciales($usuario, $password));
            }

            return redirect()->route('dashboard.usuarios')->with('success', 'Usuario creado con éxito. Se ha enviado un correo con las credenciales.');

        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            \DB::rollback();

            // Pasar el mensaje de error detallado a la sesión
            return redirect()->route('dashboard.usuarios')->with('error', 'Error al crear usuario: ' . $e->getMessage());
        }
    }

    public function bloquear($id)
    {
        $usuario = User::find($id);
        $usuario->estado = 'inactivo';
        $usuario->save();
        return redirect()->route('dashboard.usuarios')->with('success', 'Usuario bloqueado con éxito.');
    }

    public function desbloquear($id)
    {
        $usuario = User::find($id);
        $usuario->estado = 'activo';
        $usuario->save();
        return redirect()->route('dashboard.usuarios')->with('success', 'Usuario desbloqueado con éxito.');
    }

}
