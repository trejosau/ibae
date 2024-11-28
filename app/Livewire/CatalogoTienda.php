<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Productos;
use App\Models\Subcategoria;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogoTienda extends Component
{
    use WithPagination;

    public $productos;
    public $categorias;
    public $subcategorias;
    public $categoriaSeleccionada = null;
    public $subcategoriaSeleccionada = null;
    public $precioMin = null;
    public $precioMax = null;
    public $disponibilidad = null;
    public $ordenarPor = null;
    public $busqueda = null;

    public function mount()
    {
        // Cargar todas las categorías y sus subcategorías
        $this->categorias = Categorias::with('subcategorias')->get();

        // Establecer subcategorías iniciales si hay una categoría seleccionada
        if ($this->categorias->isNotEmpty()) {
            $this->subcategorias = Subcategoria::where('categoria_id', $this->categorias->first()->id)->get();
        }
    }

    public function updatedCategoriaSeleccionada()
    {
        // Actualizar subcategorías al cambiar categoría
        $this->subcategorias = Subcategoria::where('categoria_id', $this->categoriaSeleccionada)->get();
        $this->subcategoriaSeleccionada = null; // Limpiar selección de subcategoría
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
        return view('livewire.catalogo-tienda', [
            'productos' => $this->actualizarProductos(),
            'categorias' => $this->categorias,
            'subcategorias' => $this->subcategorias,
        ]);
    }
}
