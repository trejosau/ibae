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

    public function mount()
    {
        $this->categorias = Categorias::all();
    }
    public function actualizarProductos()
    {
        $this->resetPage(); // Reinicia la paginación al cambiar de categoría

        // Filtra productos según la categoría seleccionada
        if ($this->categoriaSeleccionada) {
            $this->productos = Productos::where('id_categoria', $this->categoriaSeleccionada)->paginate(10);
        } else {
            $this->productos = Productos::paginate(10);
        }
    }

    public function render()
    {
        $categorias = $this->categorias;
        $productos = $this->productos ?? Productos::paginate(16);

        return view('livewire.catalogo-tienda', compact('productos', 'categorias'));
    }

}

