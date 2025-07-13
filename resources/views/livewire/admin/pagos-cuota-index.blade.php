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
            Reportar Pago de Cuota
        </h1>
        <form action="{{ route('admin.pago_cuotas.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Campo ID Asociados -->
            <div>
                <label for="id_associate" class="block text-sm font-medium text-zinc-300 mb-1">
                    Asociado <span class="text-red-500">*</span>
                </label>
                <select name="id_associate" id="id_associate"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white"
                    required>
                    <option value="" disabled selected>Seleccione un Asociado</option>
                    @foreach ($associates as $associate)
                        <option value="{{ $associate->id }}">{{ $associate->name }} - {{ $associate->last_name }}</option>
                    @endforeach
                </select>
                @error('id_associate')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Monto -->
            <div>
                <label for="amount" class="block text-sm font-medium text-zinc-300 mb-1">
                    Monto <span class="text-red-500">*</span>
                </label>
                <input type="number" id="amount" name="amount"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: 100.00" required>
                @error('amount')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Fecha de Emisión -->
            <div>
                <label for="issue_date" class="block text-sm font-medium text-zinc-300 mb-1">
                    Fecha de Emisión <span class="text-red-500">*</span>
                </label>
                <input type="date" id="issue_date" name="issue_date"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white"
                    required>
                @error('issue_date')
                    <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Fecha de Expiración -->
            <div>
                <label for="expiration_date" class="block text-sm font-medium text-zinc-300 mb-1">
                    Fecha de Expiración <span class="text-red-500">*</span>
                </label>
                <input type="date" id="expiration_date" name="expiration_date"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white"
                    required>
                @error('expiration_date')
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
                    <option value="pagado">Pagado</option>
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
                    Reportar Pago de Cuota
                </button>
            </div>
        </form>
    </div>
</div>
