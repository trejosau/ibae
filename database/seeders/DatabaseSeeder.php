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
        $this->call(ProductosSeeder::class);
        $this->call(Inscripciones::class);
        $this->call(Admin::class);
        $this->call([
            UsersTableSeeder::class,
            PersonasTableSeeder::class,
            ProfesoresTableSeeder::class,
            ModulosCursosTableSeeder::class,
            ModulosTemasTableSeeder::class,
            CursoAperturaTableSeeder::class,
            EstudiantesTableSeeder::class,
            EstudianteCursosTableSeeder::class,
            CertificadosTableSeeder::class,
            ColegiaturasTableSeeder::class,
            ModelHasRolesTableSeeder::class,    
        ]);
    }
}
