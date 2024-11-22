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
    public $busqueda = null;

    public function mount()
    {
        $this->categorias = Categorias::all();
    }

    public function actualizarProductos()
    {
        $query = Productos::query();

        // Aplicar filtros según la categoría seleccionada
        if ($this->categoriaSeleccionada) {
            $query->where('id_categoria', $this->categoriaSeleccionada);
        }

        // Aplicar filtro de búsqueda dentro de la categoría seleccionada
        if ($this->busqueda) {
            $query->where(function ($q) {
                $q->where('nombre', 'like', '%' . $this->busqueda . '%')
                  ->orWhere('descripcion', 'like', '%' . $this->busqueda . '%');
            });
        }

        // Aplicar filtros por rango de precios
        if ($this->precioMin) {
            $query->where('precio_venta', '>=', $this->precioMin);
        }

        if ($this->precioMax) {
            $query->where('precio_venta', '<=', $this->precioMax);
        }

        // Aplicar filtro de disponibilidad
        if (!is_null($this->disponibilidad)) {
            $query->where('stock', $this->disponibilidad ? '>' : '=', 0);
        }

        // Ordenar los productos
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

        return $query->paginate(16);
    }

    public function agregarAlCarrito($productoId)
    {
        // Lógica para agregar al carrito
        session()->flash('message', 'Producto agregado al carrito.');
    }

    public function render()
    {
        // Llamar a la función de actualización y pasar los productos a la vista
        $productos = $this->actualizarProductos();

        return view('livewire.catalogo-tienda', [
            'productos' => $productos,
            'categorias' => $this->categorias
        ]);
    }
}
