<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Eliminar el trigger si ya existe
        DB::unprepared('DROP TRIGGER IF EXISTS producto_stock_bajo');

        // Crear el nuevo trigger
        DB::unprepared('
            CREATE TRIGGER producto_stock_bajo
            AFTER UPDATE ON productos
            FOR EACH ROW
            BEGIN
                -- Verificar si el stock del producto ha bajado a menos de 10
                IF NEW.stock < 10 AND OLD.stock >= 10 THEN
                    -- Insertar una notificación para todos los administradores
                    INSERT INTO notificaciones (motivo, mensaje, user_id)
                    SELECT "Stock Bajo", CONCAT("El producto ", NEW.nombre, " está por agotarse. Stock actual: ", NEW.stock), mr.model_id
                    FROM model_has_roles mr
                    INNER JOIN users u ON u.id = mr.model_id
                    WHERE mr.role_id = 5;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar el trigger si existe
        DB::unprepared('DROP TRIGGER IF EXISTS producto_stock_bajo');
    }
};
