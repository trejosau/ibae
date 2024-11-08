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
        // Eliminar triggers existentes si los hay
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_personas');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_administradores');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_compradores');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_estilistas');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_estudiantes');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_profesores');

        // Crear el trigger para la tabla 'personas'
        DB::unprepared('
            CREATE TRIGGER before_insert_personas
            BEFORE INSERT ON personas
            FOR EACH ROW
            BEGIN
                DECLARE user_exists INT;
                SELECT COUNT(*) INTO user_exists
                FROM personas
                WHERE usuario = NEW.usuario;

                IF user_exists > 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Error: El usuario ya está asociado con otra persona.";
                END IF;
            END
        ');

        // Crear el trigger para 'administradores'
        DB::unprepared('
            CREATE TRIGGER before_insert_administradores
            BEFORE INSERT ON administradores
            FOR EACH ROW
            BEGIN
                DECLARE admin_exists INT;
                SELECT COUNT(*) INTO admin_exists
                FROM administradores
                WHERE id_persona = NEW.id_persona;

                IF admin_exists > 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Error: La persona ya está asociada con otro administrador.";
                END IF;
            END
        ');

        // Crear el trigger para 'compradores'
        DB::unprepared('
            CREATE TRIGGER before_insert_compradores
            BEFORE INSERT ON compradores
            FOR EACH ROW
            BEGIN
                DECLARE buyer_exists INT;
                SELECT COUNT(*) INTO buyer_exists
                FROM compradores
                WHERE id_persona = NEW.id_persona;

                IF buyer_exists > 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Error: La persona ya está asociada con otro comprador.";
                END IF;
            END
        ');

        // Crear el trigger para 'estilistas'
        DB::unprepared('
            CREATE TRIGGER before_insert_estilistas
            BEFORE INSERT ON estilistas
            FOR EACH ROW
            BEGIN
                DECLARE stylist_exists INT;
                SELECT COUNT(*) INTO stylist_exists
                FROM estilistas
                WHERE id_persona = NEW.id_persona;

                IF stylist_exists > 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Error: La persona ya está asociada con otro estilista.";
                END IF;
            END
        ');

        // Crear el trigger para 'estudiantes'
        DB::unprepared('
            CREATE TRIGGER before_insert_estudiantes
            BEFORE INSERT ON estudiantes
            FOR EACH ROW
            BEGIN
                DECLARE student_exists INT;
                SELECT COUNT(*) INTO student_exists
                FROM estudiantes
                WHERE id_persona = NEW.id_persona;

                IF student_exists > 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Error: La persona ya está asociada con otro estudiante.";
                END IF;
            END
        ');

        // Crear el trigger para 'profesores'
        DB::unprepared('
            CREATE TRIGGER before_insert_profesores
            BEFORE INSERT ON profesores
            FOR EACH ROW
            BEGIN
                DECLARE teacher_exists INT;
                SELECT COUNT(*) INTO teacher_exists
                FROM profesores
                WHERE id_persona = NEW.id_persona;

                IF teacher_exists > 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Error: La persona ya está asociada con otro profesor.";
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar los triggers
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_personas');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_administradores');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_compradores');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_estilistas');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_estudiantes');
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_profesores');
    }
};
