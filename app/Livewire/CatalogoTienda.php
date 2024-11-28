<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Productos;
use App\Models\ProductoSubcategoria;
use App\Models\Subcategoria;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogoTienda extends Component
{
    use WithPagination;

    public $categorias;
    public $subcategorias = [];
    public $categoriaSeleccionada = null;
    public $subcategoriaSeleccionada = null;
    public $precioMin = null;
    public $precioMax = null;
    public $disponibilidad = null;
    public $ordenarPor = null;
    public $busqueda = null;

    public function mount()
    {
        // Cargar todas las categorías al inicio
        $this->categorias = Categorias::all();
    }

    public function updatedCategoriaSeleccionada()
    {
        // Actualizar subcategorías y limpiar selección de subcategoría al cambiar la categoría
        $this->subcategorias = Subcategoria::where('categoria_id', $this->categoriaSeleccionada)->get();
        $this->subcategoriaSeleccionada = null; // Limpiar selección de subcategoría
    }

    public function updatedSubcategoriaSeleccionada()
    {
        // Validar si la subcategoría pertenece a la categoría seleccionada
        if ($this->subcategoriaSeleccionada) {
            $subcategoria = Subcategoria::find($this->subcategoriaSeleccionada);
            if (!$subcategoria || $subcategoria->categoria_id != $this->categoriaSeleccionada) {
                $this->subcategoriaSeleccionada = null; // Limpiar si no pertenece
            }
        }
    }

    public function actualizarProductos()
    {
        $query = Productos::query();

        if ($this->busqueda) {
            $query->where('nombre', 'like', '%' . $this->busqueda . '%');
        }

        if ($this->categoriaSeleccionada) {
            $query->where('id_categoria', $this->categoriaSeleccionada);
        }

        if ($this->subcategoriaSeleccionada) {
            // Filtrar productos relacionados con la subcategoría seleccionada
            $query->whereHas('productoSubcategorias', function ($q) {
                $q->where('id_subcategoria', $this->subcategoriaSeleccionada);
            });
        }

        if ($this->precioMin) {
            $query->where('precio_venta', '>=', $this->precioMin);
        }

        if ($this->precioMax) {
            $query->where('precio_venta', '<=', $this->precioMax);
        }

        if (!is_null($this->disponibilidad)) {
            $query->where('stock', $this->disponibilidad ? '>' : '=', 0);
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

        return $query->paginate(21);
    }

    public function render()
    {
        $productos = $this->actualizarProductos();

        return view('livewire.catalogo-tienda', [
            'productos' => $productos,
            'categorias' => $this->categorias,
            'subcategorias' => $this->subcategorias,
        ]);
    }
}
