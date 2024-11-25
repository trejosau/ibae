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
    }
}
