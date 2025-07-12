<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="w-full py-8 px-4 sm:px-6 lg:px-8">
    {{-- Alerta de éxito --}}
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

    {{-- Alerta de error --}}
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
        <h1 class="text-2xl font-bold text-white mb-6">Registrar Nuevo Asociado</h1>

        <form action="{{ route('admin.asociados.store') }}" method="POST" data-flux-component="form">
            @csrf

            {{-- Fila 1: Nombre - Apellido - DNI --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-300 mb-1">Nombre del Asociado <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                        placeholder="Nombres..." required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-zinc-300 mb-1">Apellido del Asociado <span class="text-red-500">*</span></label>
                    <input type="text" id="last_name" name="last_name"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                        placeholder="Apellidos..." required>
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="dni" class="block text-sm font-medium text-zinc-300 mb-1">DNI <span class="text-red-500">*</span></label>
                    <input id="dni" name="dni" type="text"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                        placeholder="Digite su DNI" required>
                    @error('dni')
                        <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Fila 2: Dirección - Fecha Inscripción - Meses Adeudados --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="address_house" class="block text-sm font-medium text-zinc-300 mb-1">Dirección de Vivienda <span class="text-red-500">*</span></label>
                    <input id="address_house" name="address_house" type="text"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                        placeholder="Digite la dirección de su vivienda" required>
                    @error('address_house')
                        <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="housing_registration" class="block text-sm font-medium text-zinc-300 mb-1">Fecha de Inscripción <span class="text-red-500">*</span></label>
                    <input id="housing_registration" name="housing_registration" type="date"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                        required>
                    @error('housing_registration')
                        <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-zinc-300 mb-1">Estado <span class="text-red-500">*</span></label>
                    <select id="status" name="status"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                        required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>           
            {{-- Botón --}}
            <div class="flex justify-end w-full mt-6 grid grid-cols-1  gap-6 ">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Registrar Asociado
                </button>
            </div>
        </form>
    </div>
</div>
