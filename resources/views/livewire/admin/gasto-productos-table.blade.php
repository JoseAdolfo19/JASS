<div class="w-full py-8 px-4 sm:px-6 lg:px-8" x-data="asociateTable()">
    <!-- Notificaciones -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: "{{ session('success') }}",
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#22c55e',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-lg shadow-lg'
                }
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                background: '#18181b',
                color: '#f4f4f5',
                iconColor: '#ef4444',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-lg shadow-lg text-left'
                }
            });
        </script>
    @endif

    <!-- Tabla de Categorías -->
    <div class="w-full bg-zinc-900 rounded-xl shadow-2xl overflow-hidden p-6 border border-zinc-800">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white" data-flux-component="heading">
                Lista de Gasto en Productos
            </h1>
            <a href="{{ route('admin.gastoproductos.export-pdf') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Exportar PDF
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">#</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Descripcion del Producto</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Proveedor</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Cantidad</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Costo Total</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-300 uppercase">Fecha de Compra</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-zinc-300 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @foreach ($gastoproductos as $gastoproducto)
                        <tr>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $gastoproducto->description_product }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $gastoproducto->supplier }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $gastoproducto->amount }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $gastoproducto->total_cost }}</td>
                            <td class="px-4 py-4 text-sm text-zinc-300">{{ $gastoproducto->date_buy }}</td>
                            </td>
                            <td class="px-4 py-4 text-sm text-right">
                                <!-- Botón Editar -->
                                <button
                                    @click="openModal({{ $gastoproducto->id }}, '{{ addslashes($gastoproducto->description_product) }}', '{{ addslashes($gastoproducto->supplier) }}', '{{ addslashes($gastoproducto->amount) }}', '{{ addslashes($gastoproducto->total_cost) }}', '{{ $gastoproducto->date_buy }}')"
                                    class="text-blue-500 hover:text-blue-400 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>

                                <!-- Botón Eliminar -->
                                <button onclick="confirmDelete({{ $gastoproducto->id }})"
                                    class="text-red-500 hover:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Formulario Eliminar (oculto) -->
                                <form id="delete-form-{{ $gastoproducto->id }}"
                                    action="{{ route('admin.gastoproductos.destroy', $gastoproducto->id) }}" method="POST"
                                    class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        @if ($gastoproductos->hasPages())
            <div class="mt-6">
                {{ $gastoproductos->links() }}
            </div>
        @endif
    </div>

    <template x-teleport="body">
        <div x-show="isOpen" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Fondo oscuro -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-black opacity-75" @click="closeModal"></div>
                </div>

                <!-- Contenido del Modal -->
                <div
                    class="inline-block align-bottom bg-zinc-900 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-zinc-800">
                    <form :action="'/admin/gastoproductos/' + currentId" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="px-8 py-8">
                            <h3 class="text-xl font-semibold text-white mb-6">Editar Gasto de Productos</h3>

                            <!-- Campo Descripcion del producto -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Descripcion del Producto</label>
                                <input type="text" x-model="currentDescription_product" name="description_product"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            <!-- Campo Proveedor -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Proveedor</label>
                                <input type="text" x-model="currentSupplier" name="supplier"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            <!-- Campo Cantidad -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">DNI</label>
                                <input type="text" x-model="currentAmount" name="amount"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                            <!-- Campo Costo total -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Costo Total</label>
                                <input type="text" x-model="currentTotal_cost" name="total_cost"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                            <!-- Campo Fecha de Compra -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Fecha de Compra</label>
                                <input type="date" x-model="currentDate_buy" name="date_buy"
                                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                        </div>

                        <div class="px-8 py-4 bg-zinc-800 flex justify-end space-x-4">
                            <button type="button" @click="closeModal" class="px-6 py-3 text-zinc-300 hover:text-white">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
    // Función para confirmar eliminación
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar gasto de producto?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            background: '#18181b',
            color: '#f4f4f5',
            iconColor: '#ef4444',
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'rounded-lg shadow-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Componente Alpine.js para la tabla
    function asociateTable() {
        return {
            isOpen: false,
            currentId: null,
            currentDescription_product: '',
            currentSupplier: '',
            currentAmount:'',
            currentTotal_cost: '',
            currentDate_buy: '',

            openModal(id, description_product, supplier, amount, total_cost, date_buy) {
                this.currentId = id;
                this.currentDescription_product = description_product;
                this.currentSupplier = supplier;
                this.currentAmount = amount;
                this.currentTotal_cost = total_cost;
                this.currentDate_buy = date_buy;
                this.isOpen = true;
                document.body.classList.add('overflow-hidden');
            },

            closeModal() {
                this.isOpen = false;
                document.body.classList.remove('overflow-hidden');
            }
        }
    }
</script>
