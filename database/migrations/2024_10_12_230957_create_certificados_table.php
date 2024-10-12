use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::create('certificados', function (Blueprint $table) {
$table->id(); // ID del certificado
$table->string('nombre', 255)->notNullable(); // Nombre del certificado
$table->text('descripcion')->nullable(); // Descripción del certificado
$table->integer('horas')->notNullable(); // Número de horas del certificado
$table->enum('institucion', ['SEP', 'Otra'])->notNullable(); // Institución que otorga el certificado
$table->timestamps(); // Timestamps por defecto
});
}

public function down(): void
{
Schema::dropIfExists('certificados');
}
};
