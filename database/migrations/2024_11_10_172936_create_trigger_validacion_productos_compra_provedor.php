<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS validar_proveedor_producto');
        DB::unprepared('
            CREATE TRIGGER validar_proveedor_producto
            BEFORE INSERT ON detalle_compra
            FOR EACH ROW
            BEGIN
                DECLARE proveedor_producto_id BIGINT;

                -- Obtener el ID del proveedor del producto
                SELECT id_proveedor INTO proveedor_producto_id
                FROM productos
                WHERE id = NEW.id_producto;

                -- Comparar el ID del proveedor del producto con el seleccionado en la compra
                IF proveedor_producto_id != (SELECT id_proveedor FROM compras WHERE id = NEW.id_compra) THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "El producto pertenece a un proveedor diferente al de la compra";
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS validar_proveedor_producto');
    }
};
