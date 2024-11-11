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

        DB::unprepared('
    CREATE TRIGGER actualizar_stock_y_estado_producto
    AFTER UPDATE ON compras
    FOR EACH ROW
    BEGIN
        IF NEW.estado = "entregado" AND OLD.estado != "entregado" THEN
            UPDATE productos p
            JOIN detalle_compra dc ON p.id = dc.id_producto
            SET p.stock = p.stock + dc.cantidad,
                p.estado = CASE
                             WHEN p.estado = "agotado" AND p.stock + dc.cantidad > 0 THEN "activo"
                             ELSE p.estado
                           END
            WHERE dc.id_compra = NEW.id AND p.id = dc.id_producto;
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
