<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER disminuir_stock
            AFTER INSERT ON detalle_pedido
            FOR EACH ROW
            BEGIN
                UPDATE productos
                SET stock = stock - NEW.cantidad
                WHERE id = NEW.id_producto;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS disminuir_stock');
    }

};
