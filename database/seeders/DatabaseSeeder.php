<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\AssignOp\Mod;

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
        $this->call(UsersSeeder::class);
        $this->call(AcademiaSeeder::class);
        $this->call(Admin::class);
        $this->call(ProductosSeeder::class);
        $this->call(ServicioSeeder::class); // Seeder se servicios y categorias del salon
        $this->call(VentaSeeder::class); // Seeder para crear ventas
        $this->call(ComprasSeeder::class); // Seeder para crear compras
    }
}
