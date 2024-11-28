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
            CREATE TRIGGER validar_stock
            BEFORE INSERT ON detalle_pedido
            FOR EACH ROW
            BEGIN
                DECLARE stock_disponible INT;

                SELECT stock INTO stock_disponible
                FROM productos
                WHERE id = NEW.id_producto;

                IF NEW.cantidad > stock_disponible THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Error: Stock insuficiente para el producto solicitado.";
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS validar_stock');
    }
};
