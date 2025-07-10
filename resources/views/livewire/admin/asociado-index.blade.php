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
        <h1 class="text-2xl font-bold text-white mb-6" data-flux-component="heading">
            Registrar Nuevo Asociado
        </h1>
        <form action="{{ route('admin.asociados.store') }}" method="POST" class="space-y-6" data-flux-component="form">
            @csrf
            <!-- Campo Nombre -->
            <div data-flux-field>
                <label for="name" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Nombre del Asociado <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Nombres..." required data-flux-control>
                @error('name')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Apellido -->
            <div data-flux-field>
                <label for="last_name" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Apellido del Asociado <span class="text-red-500">*</span>
                </label>
                <input type="text" id="last_name" name="last_name"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Apellidos..." required data-flux-control>
                @error('last_name')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo dni -->
            <div data-flux-field>
                <label for="dni" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    DNI <span class="text-red-500">*</span>
                </label>
                <input id="dni" name="dni" type="text"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Dijite su DNI" required data-flux-control>
                @error('dni')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Direccion de vivienda -->
            <div data-flux-field>
                <label for="address_house" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                 Direccion de Vivienda <span class="text-red-500">*</span>
                </label>
                <input id="address_house" name="address_house" type="text"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Dijite la Direccion de su Vivienda" required data-flux-control>
                @error('address_house')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo Fecha de inscripcion -->
            <div data-flux-field>
                <label for="housing_registration" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Fecha de Inscripciòn<span class="text-red-500">*</span>
                </label>
                <input id="housing_registration" name="housing_registration" type="date"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Ej: 15/08/2024" required data-flux-control>
                @error('housing_registration')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
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
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-all duration-200 shadow-lg hover:shadow-xl"
                    data-flux-component="button">
                    Registrar Asociado
                </button>
            </div>
        </form>
    </div>
</div>
