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
    protected $listeners = [
        'cerrarDropdown',
    ];

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
        $this->productos = Productos::orderBy('nombre', 'asc')->get();

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


    public $mostrarDropdown = false;

    public function abrirDropdown()
    {
        $this->mostrarDropdown = true;
    }

    public function cerrarDropdown()
    {
        $this->mostrarDropdown = false;
    }

    public function selectMatricula($matricula)
    {
        $this->matricula = $matricula;
        $this->cerrarDropdown(); // Cierra el dropdown después de seleccionar
        $this->resultados = []; // Limpia los resultados después de la selección
    }


    public function updatedMatricula($value)
    {
        // Evitar consultas innecesarias si la longitud del input es menor a 1
        if (strlen($value) < 1) {
            $this->resultados = [];
            return;
        }

        // Buscar estudiantes por matrícula (mínimo un carácter)
        $this->resultados = Estudiante::where('matricula', 'like', "%$value%")
            ->orWhereHas('persona', function ($query) use ($value) {
                $query->where('nombre', 'like', "%$value%")
                    ->orWhere('ap_paterno', 'like', "%$value%");
            })->get()->map(function ($estudiante) {
                return [
                    'matricula' => $estudiante->matricula,
                    'persona' => [
                        'nombre' => $estudiante->persona->nombre,
                        'ap_paterno' => $estudiante->persona->ap_paterno,
                    ],
                ];
            })->toArray();
    }


    public function confirmarVenta()
    {
        // Validar si hay productos agregados
        if (empty($this->productosAgregados)) {
            session()->flash('error', 'No hay productos para confirmar la venta.');
            return redirect()->route('dashboard.ventas');
        }

        // Validar si es estudiante y verificar matrícula
        if ($this->esEstudiante) {
            if (empty($this->matricula)) {
                session()->flash('error', 'Ocurrió un error con la matrícula: no la ingresaste.');
                return redirect()->route('dashboard.ventas');
            }

            $estudiante = Estudiante::where('matricula', $this->matricula)->first();
            if (!$estudiante) {
                session()->flash('error', 'Ocurrió un error: la matrícula no existe en el sistema.');
                return redirect()->route('dashboard.ventas');
            }
        }

        try {
            // Calcular el total de la venta y los descuentos
            $totalVenta = $this->calcularTotal();
            $totalDescuento = $this->calcularTotalDescuento();

            // Obtener el administrador asociado al usuario actual
            $usuario = Auth::user();
            if (!$usuario || !$usuario->Persona || !$usuario->Persona->Administrador) {
                session()->flash('error', 'El usuario actual no tiene un administrador asociado.');
                return redirect()->route('dashboard.ventas');
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

            // Crear los detalles de la venta y actualizar el stock
            foreach ($this->productosAgregados as $producto) {
                // Conversión a enteros para evitar problemas con cadenas
                $cantidad = (int) $producto['cantidad'];

                // Calcular precio y descuento aplicados
                $precioAplicado = $this->esEstudiante ? $producto['precio_lista'] : $producto['precio_venta'];
                $descuento = $this->esEstudiante ? $producto['precio_venta'] - $producto['precio_lista'] : 0;

                // Crear el detalle de venta
                DetalleVenta::create([
                    'id_venta' => $venta->id,
                    'id_producto' => $producto['id'],
                    'cantidad' => $cantidad,
                    'precio_aplicado' => $precioAplicado,
                    'descuento' => $descuento,
                ]);

                // Obtener el producto desde la base de datos con bloqueo para evitar condiciones de carrera
                $productoDb = Productos::where('id', $producto['id'])->lockForUpdate()->first();

                // Validar si hay suficiente stock
                if ($productoDb->stock < $cantidad) {
                    dump('ERROR: Stock insuficiente', [
                        'id_producto' => $productoDb->id,
                        'stock_disponible' => $productoDb->stock,
                        'cantidad_solicitada' => $cantidad,
                    ]);
                    continue; // Salta este producto si no hay suficiente stock
                }

                // Calcular el nuevo stock
                $nuevoStock = $productoDb->stock - $cantidad;

                // Determinar el nuevo estado del producto
                $nuevoEstado = $nuevoStock > 0 ? 'activo' : 'agotado';

                // Actualizar el producto en la base de datos
                $productoDb->update([
                    'stock' => $nuevoStock,
                    'estado' => $nuevoEstado,
                ]);

            }

            // Limpiar el estado del componente
            $this->reset(['productosAgregados', 'cantidades', 'comprador', 'esEstudiante', 'matricula']);

            // Mensaje de éxito
            session()->flash('success', 'Venta confirmada exitosamente.');
            return redirect()->route('dashboard.ventas');
        } catch (\Exception $e) {
            // Mostrar mensaje de error al usuario
            session()->flash('error', 'Ocurrió un error al confirmar la venta: ' . $e->getMessage());
            return redirect()->route('dashboard.ventas');
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
