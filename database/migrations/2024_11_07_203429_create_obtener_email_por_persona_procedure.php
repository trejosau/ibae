<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateObtenerEmailPorPersonaProcedure extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('DROP PROCEDURE IF EXISTS ObtenerEmailPorPersona');
        DB::unprepared('
            CREATE PROCEDURE ObtenerEmailPorPersona(IN persona_id BIGINT)
            BEGIN
                SELECT u.email
                FROM users u
                JOIN personas p ON p.usuario = u.id
                WHERE p.id = persona_id;
            END
        ');
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ObtenerEmailPorPersona');
    }
}
