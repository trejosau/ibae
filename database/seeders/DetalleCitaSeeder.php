<?php

namespace Database\Seeders;

use App\Models\DetalleCita;
use App\Models\DetalleCabello;
use App\Models\DetalleUnas;
use App\Models\Citas;
use App\Models\Servicios;
use Illuminate\Database\Seeder;

class DetalleCitaSeeder extends Seeder
{
    public function run()
    {
        $citas = Citas::all();
        $servicios = Servicios::whereIn('categoria', ['color', 'manicura'])->get(); // Filtramos solo servicios de color o manicura

        if ($citas->isEmpty() || $servicios->isEmpty()) {
            return; // No hay citas o servicios de color/manicura
        }

        foreach ($citas as $cita) {
            $numServicios = rand(1, 3);
            $serviciosSeleccionados = $servicios->random($numServicios);

            foreach ($serviciosSeleccionados as $servicio) {
                $detalleCita = DetalleCita::create([
                    'id_cita' => $cita->id,
                    'id_servicio' => $servicio->id,
                ]);

                // Solo añadir detalles para servicios de color o manicura
                if ($servicio->categoria === 'color') {
                    DetalleCabello::create([
                        'id_detalle_cita' => $detalleCita->id,
                        'largo' => $this->randomLargo(),
                        'volumen' => $this->randomVolumen(),
                        'estado' => $this->randomEstado(),
                    ]);
                } elseif ($servicio->categoria === 'manicura') {
                    DetalleUnas::create([
                        'id_detalle_cita' => $detalleCita->id,
                        'largo' => rand(1, 5), // Largo de uñas
                        'cantidad_piedras' => rand(0, 10),
                        'cantidad_cristales' => rand(0, 10),
                        'cantidad_stickers' => rand(0, 10),
                        'cantidad_efecto_foil' => rand(0, 5),
                        'cantidad_efecto_espejo' => rand(0, 5),
                        'cantidad_efecto_azucar' => rand(0, 5),
                        'cantidad_efecto_mano_alzada' => rand(0, 5),
                        'cantidad_efecto_3d' => rand(0, 5),
                    ]);
                }
            }
        }
    }

    private function randomLargo()
    {
        return ['corto', 'medio', 'largo', 'extra-largo'][array_rand(['corto', 'medio', 'largo', 'extra-largo'])];
    }

    private function randomVolumen()
    {
        return ['bajo', 'medio', 'alto'][array_rand(['bajo', 'medio', 'alto'])];
    }

    private function randomEstado()
    {
        return ['natural', 'teñido', 'decolorado/procesado', 'teñido oscuro o rojizo'][array_rand(['natural', 'teñido', 'decolorado/procesado', 'teñido oscuro o rojizo'])];
    }
}
