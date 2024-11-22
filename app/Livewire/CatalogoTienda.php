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
    public $ordenarPor = null;
    public $busqueda = null; // Propiedad para búsqueda

    public function mount()
    {
        $this->categorias = Categorias::all();
        $this->actualizarProductos();
    }


public function actualizarProductos()
{
    $query = Productos::query();

    // Filtro por búsqueda (si está activo)
    if ($this->busqueda) {
        $query->where('nombre', 'like', '%' . $this->busqueda . '%')
              ->orWhere('descripcion', 'like', '%' . $this->busqueda . '%');
    }

    // Otros filtros (categoría, precio, disponibilidad, etc.)
    if ($this->categoriaSeleccionada) {
        $query->where('id_categoria', $this->categoriaSeleccionada);
    }

    if ($this->precioMin) {
        $query->where('precio_venta', '>=', $this->precioMin);
    }
    if ($this->precioMax) {
        $query->where('precio_venta', '<=', $this->precioMax);
    }

    if ($this->disponibilidad !== null) {
        if ($this->disponibilidad == 1) {
            $query->where('stock', '>', 0);  // Productos con stock disponible
        } elseif ($this->disponibilidad == 0) {
            $query->where('stock', '=', 0);  // Productos agotados (sin stock)
        }
    }

    if ($this->ordenarPor) {
        switch ($this->ordenarPor) {
            case 'mas_nuevo':
                $query->orderBy('fecha_agregado', 'desc');
                break;
            case 'mas_vendido':
                $query->orderBy('cantidad', 'desc');
                break;
            case 'precio_mas_alto':
                $query->orderBy('precio_venta', 'desc');
                break;
            case 'precio_mas_bajo':
                $query->orderBy('precio_venta', 'asc');
                break;
        }
    }

    $this->productos = $query->paginate(16);
}


    public function render()
    {
        $categorias = $this->categorias;
        $productos = $this->productos ?? Productos::paginate(16);

        return view('livewire.catalogo-tienda', compact('productos', 'categorias'));
    }
}
