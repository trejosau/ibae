<?php

namespace App\Livewire;

use Livewire\Component;

class ResumenVenta extends Component
{
    public $nombreComprador = '';
    public $esEstudiante = false;
    public $matricula = '';
    public $items = [];
    public $productos = [];
    public $total = 0;

    public function mount()
    {
        // Simulación de catálogo de productos
        $this->productos = [
            ['id' => 1, 'nombre' => 'Producto A', 'precio_lista' => 100, 'precio_venta' => 90],
            ['id' => 2, 'nombre' => 'Producto B', 'precio_lista' => 200, 'precio_venta' => 180],
        ];
    }

    public function agregarProducto($id)
    {
        $producto = collect($this->productos)->firstWhere('id', $id);

        if ($producto) {
            $this->items[] = [
                'nombre' => $producto['nombre'],
                'precio_lista' => $producto['precio_lista'],
                'precio_venta' => $producto['precio_venta'],
                'cantidad' => 1,
            ];
            $this->calcularTotal();
        }
    }

    public function eliminarProducto($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindexar el array
        $this->calcularTotal();
    }

    public function limpiarCarrito()
    {
        $this->items = [];
        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        $this->total = array_sum(array_map(function ($item) {
            $precio = $this->esEstudiante ? $item['precio_lista'] : $item['precio_venta'];
            return $precio * $item['cantidad'];
        }, $this->items));
    }

    public function realizarVenta()
    {
        // Lógica para procesar la venta
        session()->flash('message', 'Venta realizada con éxito.');
        $this->limpiarCarrito();
    }

    public function updatedEsEstudiante()
    {
        $this->calcularTotal(); // Recalcula el total cuando cambia el estado del checkbox
    }

    public function render()
    {
        return view('livewire.resumen-venta');
    }
}
