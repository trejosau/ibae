<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(ProveedoresSeeder::class);
        $this->call(CategoriaSubcategoriaSeeder::class);
        $this->call(Inscripciones::class);
        $this->call(Admin::class);
        $this->call([
            UsersSeeder::class,
<<<<<<< HEAD
            PersonasSeeder::class,
            ProfesoresSeeder::class,
            ModulosCursosSeeder::class,
            ModulosTemasSeeder::class,
            CursoAperturaSeeder::class,
            EstudiantesTableSeeder::class,
            EstudianteCursosTableSeeder::class,
            CertificadosSeeder::class,
            ColegiaturasSeeder::class,
            ModelHasRolesSeeder::class,    
=======
>>>>>>> 7eee1629749f51227a3744eb96429c3cd32f61aa
        ]);
    }
}
