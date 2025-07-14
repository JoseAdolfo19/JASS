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
            Registrar Faenas
        </h1>
        <form action="{{ route('admin.task.store') }}" method="POST" class="space-y-6" data-flux-component="form">
            @csrf

            <!-- Campo DNI del asociado -->
                <div data-flux-field>
                    <label for="associate_id" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                        Encargado de Faena <span class="text-red-500">*</span>
                    </label>
                    <select id="user_id" name="user_id"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white"
                        required data-flux-control>
                        <option value="" disabled selected>Seleccione un Nombre</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('associate_id')
                        <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                    @enderror
                </div>

            <!-- Campo Descripcion del producto -->
            <div data-flux-field>
                <label for="description" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Descripcion <span class="text-red-500">*</span>
                </label>
                <input type="text" id="description" name="description"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Descripcion..." required data-flux-control>
                @error('description')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo feha de faena -->
            <div data-flux-field>
                <label for="date_task" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Fecha de Faena <span class="text-red-500">*</span>
                </label>
                <input type="date" id="date_task" name="date_task"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Fecha..." required data-flux-control>
                @error('date_task')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo tipo de faena -->
            <div data-flux-field>
                <label for="type_task" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Tipo de Faena <span class="text-red-500">*</span>
                </label>
                <input type="text" id="type_task" name="type_task"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Tipo..." required data-flux-control>
                @error('type_task')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo numero de participantes -->
            <div data-flux-field>
                <label for="number_participants" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                 Numero de Asociados <span class="text-red-500">*</span>
                </label>
                <input type="number" name="number_participants" id="number_participants"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Total..." required data-flux-control>
                @error('number_participants')
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
                    Registrar Faena
                </button>
            </div>
        </form>
    </div>
</div>
