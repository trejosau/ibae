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
        DB::unprepared('DROP TRIGGER IF EXISTS actualizar_estado_producto_despues_de_venta');
        DB::unprepared('DROP TRIGGER IF EXISTS actualizar_estado_producto_despues_de_compra');
        DB::unprepared('
            CREATE TRIGGER actualizar_estado_producto_despues_de_venta
            AFTER UPDATE ON productos
            FOR EACH ROW
            BEGIN
                IF NEW.stock = 0 THEN
                    UPDATE productos
                    SET estado = "agotado"
                    WHERE id = NEW.id;
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER actualizar_estado_producto_despues_de_compra
            AFTER UPDATE ON productos
            FOR EACH ROW
            BEGIN
                IF NEW.stock > 0 AND OLD.estado = "agotado" THEN
                    UPDATE productos
                    SET estado = "activo"
                    WHERE id = NEW.id;
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS actualizar_estado_producto_despues_de_venta');
        DB::unprepared('DROP TRIGGER IF EXISTS actualizar_estado_producto_despues_de_compra');
    }
};
