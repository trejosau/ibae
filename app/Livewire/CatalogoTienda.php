<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Productos;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogoTienda extends Component
{
    use WithPagination;

    public $categorias;
    public $categoriaSeleccionada = null;
    public $precioMin = null;
    public $precioMax = null;
    public $disponibilidad = null;
    public $ordenarPor = null; // Nueva variable para ordenar productos

    public function mount()
    {
        $this->categorias = Categorias::all();
    }

    public function actualizarProductos()
    {
        $query = Productos::query();

        // Filtro por categoría
        if ($this->categoriaSeleccionada) {
            $query->where('id_categoria', $this->categoriaSeleccionada);
        }

        // Filtro por precio
        if ($this->precioMin) {
            $query->where('precio_venta', '>=', $this->precioMin);
        }
        if ($this->precioMax) {
            $query->where('precio_venta', '<=', $this->precioMax);
        }

        // Filtro por disponibilidad (stock)
        if ($this->disponibilidad !== null) {
            if ($this->disponibilidad == 1) {
                $query->where('stock', '>', 0);  // Productos con stock disponible
            } elseif ($this->disponibilidad == 0) {
                $query->where('stock', '=', 0);  // Productos agotados (sin stock)
            }
        }

        // Filtro de orden (nuevo, más vendido, precio)
        if ($this->ordenarPor) {
            switch ($this->ordenarPor) {
                case 'mas_nuevo':
                    $query->orderBy('fecha_agregado', 'desc');
                    break;
                case 'mas_vendido':
                    // Asumimos que tienes una tabla de ventas que registra la cantidad de ventas por producto
                    // Si no tienes esta tabla, necesitarás agregar una o llevar un conteo en el producto mismo.
                    $query->orderBy('cantidad', 'desc'); // Ordenamos por cantidad (ventas)
                    break;
                case 'precio_mas_alto':
                    $query->orderBy('precio_venta', 'desc');
                    break;
                case 'precio_mas_bajo':
                    $query->orderBy('precio_venta', 'asc');
                    break;
            }
        }

        // Paginar los productos
        $this->productos = $query->paginate(16);
    }

    public function render()
    {
        $categorias = $this->categorias;
        $productos = $this->productos ?? Productos::paginate(16);

        return view('livewire.catalogo-tienda', compact('productos', 'categorias'));
    }
}
