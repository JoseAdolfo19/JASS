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
        <h1 class="text-2xl font-bold text-white mb-6">
            Reportar Nueva Incidencia
        </h1>
        <form action="{{ route('admin.reported_incidence.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Campo ID Asociados -->
            <div>
                <label for="id_associates" class="block text-sm font-medium text-zinc-300 mb-1">
                    Nombre del Asociado <span class="text-red-500">*</span>
                </label>
                <select name="id_associates" id="id_associates"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white"
                    required>
                    <option value="" disabled selected>Seleccione un Asociado</option>
                    @foreach ($associates as $associate)
                        <option value="{{ $associate->id }}">{{ $associate->name }}</option>
                    @endforeach
                </select>
                @error('id_associates')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror               
            </div>
            <!-- Campo lacacion -->
            <div>
                <label for="location" class="block text-sm font-medium text-zinc-300 mb-1">
                    Locacion <span class="text-red-500">*</span>
                </label>
                <input type="text" id="location" name="location"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Calle s/n" required>
                @error('location')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Descripción --> 
            <div>
                <label for="description" class="block text-sm font-medium text-zinc-300 mb-1">
                    Descripción <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="3"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Describe la incidencia" required></textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Tipo de Incidencia -->
            <div>
                <label for="type_incidence" class="block text-sm font-medium text-zinc-300 mb-1">
                    Tipo de Incidencia <span class="text-red-500">*</span>
                </label>
                <input type="text" id="type_incidence" name="type_incidence"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: Fallo de equipo" required>
                @error('type_incidence')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Fecha Reporte -->
            <div>
                <label for="date_reported" class="block text-sm font-medium text-zinc-300 mb-1">
                    Fecha de Reporte <span class="text-red-500">*</span>
                </label>
                <input type="date" id="date_reported" name="date_reported"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white"
                    required>
                @error('date_reported')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Fecha Solución -->
            <div>
                <label for="date_resolved" class="block text-sm font-medium text-zinc-300 mb-1">
                    Fecha de Solución
                </label>
                <input type="date" id="date_resolved" name="date_resolved"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white">
                @error('date_resolved')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Costo de Reparación -->
            <div>
                <label for="repair_cost" class="block text-sm font-medium text-zinc-300 mb-1">
                    Costo de Reparación
                </label>
                <input type="text" id="repair_cost" name="repair_cost"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ingrese costo de reparación">
                @error('repair_cost')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Estado -->
            <div>
                <label for="status" class="block text-sm font-medium text-zinc-300 mb-1">
                    Estado <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white">
                    <option value="pendiente">Pendiente</option>
                    <option value="resuelto">Resuelto</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-800"></div>
                </div>
            </div>
            <!-- Nota de campos obligatorios -->
            <div class="text-sm text-zinc-500 mb-6">
                Campos marcados con <span class="text-red-500 font-bold">*</span> son obligatorios
            </div>
            <!-- Botón de acción principal -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Reportar Incidencia
                </button>
            </div>
        </form>
    </div>
</div>