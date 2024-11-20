<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\DetalleVenta;
use App\Models\Estudiante;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\Ventas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VentasModal extends Component
{
    public $esEstudiante = false;
    public $query = '';
    public $queryProductos = '';
    public $proveedores;
    public $proveedorSeleccionado = '';
    public $categoriaSeleccionada = '';
    public $categorias;
    public $resultados = [];
    public $matricula ;

    public $productos;
    public $productosAgregados = [];
    public $cantidades = [];
    public $comprador;


    public function mount()
    {
        $this->categorias = Categorias::orderBy('nombre', 'asc')->get();
        $this->proveedores = Proveedores::orderBy('nombre_empresa', 'asc')->get();

        // Cargar lista inicial de productos
        $this->productos = Productos::where('estado', 'activo')
            ->orderBy('nombre', 'asc')
            ->get();
    }

    public function updatedCategoriaSeleccionada()
    {
        $this->filtrarProductos();
    }
    public function updatedQueryProductos()
    {
        $this->filtrarProductos();
    }

    public function updatedProveedorSeleccionado()
    {
        $this->filtrarProductos();
    }

    public function filtrarProductos()
    {
        $query = Productos::where('estado', 'activo');

        // Aplicar filtro de nombre si existe
        if (!empty($this->queryProductos)) {
            $query->where('nombre', 'like', '%' . $this->queryProductos . '%');
        }

        // Aplicar filtro de proveedor si se selecciona
        if (!empty($this->proveedorSeleccionado)) {
            $query->where('id_proveedor', $this->proveedorSeleccionado);
        }
        // Filtro por categoría
        if (!empty($this->categoriaSeleccionada)) {
            $query->where('id_categoria', $this->categoriaSeleccionada);
        }

        // Obtener productos filtrados
        $this->productos = $query->orderBy('nombre', 'asc')->get();
    }



    public function limpiarVenta()
        {
            $this->reset(['productosAgregados', 'cantidades', 'comprador', 'esEstudiante', 'matricula']);
        }


    public function validarCantidad($productoId)
    {
        $producto = $this->productos->find($productoId);
        $cantidad = $this->cantidades[$productoId] ?? 1;

        if ($cantidad < 1) {
            $this->cantidades[$productoId] = 1;
        } elseif ($cantidad > $producto->stock) {
            $this->cantidades[$productoId] = $producto->stock;
            $this->dispatch('mostrar-popover', ['productoId' => $productoId, 'mensaje' => "Solo hay {$producto->stock} en stock."]);
        }
    }

    public function eliminarProducto($index)
    {
        if (isset($this->productosAgregados[$index])) {
            unset($this->productosAgregados[$index]);
            $this->productosAgregados = array_values($this->productosAgregados); // Reindexar el array
        }
    }


    public function agregarProducto($productoId)
    {
        $producto = $this->productos->find($productoId);
        if ($producto->stock <= 0) {
            $this->dispatch('alerta-stock', [
                'mensaje' => "El producto {$producto->nombre} está agotado y no se puede agregar."
            ]);
            return;
        }
        $cantidad = $this->cantidades[$productoId] ?? 1;

        // Validar la cantidad contra el stock
        if ($cantidad > $producto->stock) {
            $this->dispatch('alerta-stock', [
                'mensaje' => "Solo hay {$producto->stock} en stock para el producto {$producto->nombre}."
            ]);
            $cantidad = $producto->stock;
        }

        if ($cantidad < 1) {
            $cantidad = 1;
        }

        // Verificar si el producto ya fue agregado
        if (isset($this->productosAgregados[$productoId])) {
            $this->productosAgregados[$productoId]['cantidad'] += $cantidad;

            // Ajustar si la cantidad excede el stock
            if ($this->productosAgregados[$productoId]['cantidad'] > $producto->stock) {
                $this->productosAgregados[$productoId]['cantidad'] = $producto->stock;
                $this->dispatch('alerta-stock', [
                    'mensaje' => "No puedes agregar más de {$producto->stock} unidades del producto {$producto->nombre}."
                ]);
            }
        } else {
            // Agregar un nuevo producto
            $this->productosAgregados[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'cantidad' => $cantidad,
                'precio_venta' => $producto->precio_venta,
                'precio_lista' => $producto->precio_lista, // Agregar precio_lista
            ];
        }

        // Reiniciar la cantidad del input
        $this->cantidades[$productoId] = null;
    }
    public function calcularTotal()
    {
        $total = 0;

        foreach ($this->productosAgregados as $producto) {
            $precio = $this->esEstudiante ? $producto['precio_lista'] : $producto['precio_venta'];
            $total += $producto['cantidad'] * $precio;
        }

        return $total;
    }


    public function calcularTotalDescuento()
    {
        $totalDescuento = 0;

        if ($this->esEstudiante) {
            foreach ($this->productosAgregados as $producto) {
                $descuento = $producto['precio_venta'] - $producto['precio_lista'];
                $totalDescuento += $producto['cantidad'] * $descuento;
            }
        }

        return $totalDescuento;
    }


    public function confirmarVenta()
    {
        // Validar si hay productos agregados
        if (empty($this->productosAgregados)) {
            session()->flash('error', 'No hay productos para confirmar la venta.');
            return;
        }

        try {
            // Calcular el total
            $totalVenta = $this->calcularTotal();
            $totalDescuento = $this->calcularTotalDescuento(); // Total de descuentos si aplica

            // Obtener el administrador asociado al usuario actual
            $usuario = Auth::user();

            if (!$usuario || !$usuario->Persona || !$usuario->Persona->Administrador) {
                session()->flash('error', 'El usuario actual no tiene un administrador asociado.');
                return;
            }

            $id_admin = $usuario->Persona->Administrador->id;



            // Crear la venta
            $venta = Ventas::create([
                'nombre_comprador' => $this->comprador ?? 'No proporcionado',
                'fecha_compra' => now()->format('Y-m-d H:i:s'),
                'total' => $totalVenta,
                'id_admin' => $id_admin,
                'es_estudiante' => $this->esEstudiante ? 'si' : 'no',
                'matricula' => $this->matricula ?? null,
            ]);


            // Crear los detalles de la venta
            foreach ($this->productosAgregados as $producto) {
                $precioAplicado = $this->esEstudiante ? $producto['precio_lista'] : $producto['precio_venta'];
                $descuento = $producto['precio_venta'] - $producto['precio_lista']; // Descuento por producto

                DetalleVenta::create([
                    'id_venta' => $venta->id,
                    'id_producto' => $producto['id'],
                    'cantidad' => $producto['cantidad'],
                    'precio_aplicado' => $precioAplicado,
                    'descuento' => $this->esEstudiante ? $descuento : 0,
                ]);

                Productos::where('id', $producto['id'])->decrement('stock', $producto['cantidad']);
            }
            // Limpiar el estado del componente
            $this->reset(['productosAgregados', 'cantidades', 'comprador', 'esEstudiante', 'matricula']);
            session()->flash('success', 'Venta confirmada exitosamente.');

            return redirect()->route('dashboard.ventas');
        } catch (\Exception $e) {
            // Capturar errores y mostrar un mensaje de error
            session()->flash('error', 'Ocurrió un error al confirmar la venta: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.ventas-modal', [
            'categorias' => $this->categorias,
            'proveedores' => $this->proveedores,
        ]);
    }
}
