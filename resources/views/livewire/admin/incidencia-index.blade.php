<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="w-full py-8 px-4 sm:px-6 lg:px-8">
    {{-- Alerta --}}
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

    <div class="w-full bg-zinc-900 rounded-xl shadow-2xl overflow-hidden p-6 border border-zinc-800">
        <h1 class="text-2xl font-bold text-white mb-6">Reportar Incidencia</h1>

        <form action="{{ route('admin.incidencia.store') }}" method="POST" data-flux-component="form">
            @csrf

            {{-- Fila 1: Asociado - Estado - Costo --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="associate_id" class="text-sm text-zinc-300 mb-1">Asociado <span class="text-red-500">*</span></label>
                    <select id="associate_id" name="associate_id" required
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white">
                        <option value="">Seleccione un asociado</option>
                        @foreach ($associates as $associate)
                            <option value="{{ $associate->id }}">{{ $associate->name }} {{ $associate->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="text-sm text-zinc-300 mb-1">Estado <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white">
                        <option value="">Seleccione el estado</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="resuelto">Resuelto</option>
                    </select>
                </div>

                <div>
                    <label for="repair_cost" class="text-sm text-zinc-300 mb-1">Costo de Reparación <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" id="repair_cost" name="repair_cost" required
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                        placeholder="Ej: 150.00">
                </div>
            </div>

            {{-- Fila 2: Ubicación - Fecha Reporte - Fecha Resolución --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="location" class="text-sm text-zinc-300 mb-1">Ubicación <span class="text-red-500">*</span></label>
                    <input type="text" id="location" name="location" required
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                        placeholder="Ubicación de la incidencia">
                </div>

                <div>
                    <label for="date_reported" class="text-sm text-zinc-300 mb-1">Fecha de Reporte <span class="text-red-500">*</span></label>
                    <input type="date" id="date_reported" name="date_reported" required
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white">
                </div>

                <div>
                    <label for="date_resolved" class="text-sm text-zinc-300 mb-1">Fecha de Resolución</label>
                    <input type="date" id="date_resolved" name="date_resolved"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white">
                </div>
            </div>

            {{-- Fila completa: Tipo de incidencia --}}
            <div class="mb-6">
                <label for="type_incidence" class="text-sm text-zinc-300 mb-1">Tipo de Incidencia <span class="text-red-500">*</span></label>
                <input type="text" id="type_incidence" name="type_incidence" required
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                    placeholder="Ej: Fuga de agua">
            </div>

            {{-- Fila completa: Descripción --}}
            <div class="mb-6">
                <label for="description" class="text-sm text-zinc-300 mb-1">Descripción <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="4" required
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                    placeholder="Describe la incidencia con detalle..."></textarea>
            </div>

            {{-- Separador --}}
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-800"></div>
                </div>
            </div>

            {{-- Nota --}}
            <div class="text-sm text-zinc-500 mb-6">
                Campos marcados con <span class="text-red-500 font-bold">*</span> son obligatorios
            </div>

            {{-- Botón --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Reportar Incidencia
                </button>
            </div>
        </form>
    </div>
</div>
