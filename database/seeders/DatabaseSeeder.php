<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(InscripcionesSeeder::class);
        $this->call(HorarioSalonSeeder::class);
        $this->call(HorarioSalonCerradoSeeder::class);
        $this->call(ProcesoUsuariosSeeder::class);
        $this->call(ProveedoresSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(CertificadosSeeder::class);
        $this->call(CursosSeeder::class);
        $this->call(CursoAperturaSeeder::class);
        $this->call(EstudianteCursoSeeder::class);
        $this->call(ColegiaturasSeeder::class);
        $this->call(CitasSeeder::class);
        $this->call(ComprasSeeder::class);
        $this->call(DetalleCompraSeeder::class);
        $this->call(ServiciosSeeder::class);
        $this->call(DetalleCitaSeeder::class);
        $this->call(HorarioCerradoSeeder::class);
        $this->call(VentasSeeder::class);
        $this->call(DetalleVentasSeeder::class);
        $this->call(TemasSeeder::class);
        $this->call(ModulosSeeder::class);
        $this->call(ModuloTemasSeeder::class);
        $this->call(ModuloCursoSeeder::class);
    }
}
