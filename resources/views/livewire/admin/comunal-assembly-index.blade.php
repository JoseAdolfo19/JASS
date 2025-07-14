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
            Registrar Asambleas
        </h1>
        <form action="{{ route('admin.task.store') }}" method="POST" class="space-y-6" data-flux-component="form">
            @csrf

            <!-- Campo DNI del asociado -->
                <div data-flux-field>
                    <label for="associate_id" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                        Nombre del Encargado <span class="text-red-500">*</span>
                    </label>
                    <select id="user_id" name="user_id"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white"
                        required data-flux-control>
                        <option value="" disabled selected>Seleccione un Nombre</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                    @enderror
                </div>

            <!-- Campo fecha de la asamblea -->
            <div data-flux-field>
                <label for="assembly_date" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Fecha de la Asamblea <span class="text-red-500">*</span>
                </label>
                <input type="date" id="assembly_date" name="assembly_date"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Descripcion..." required data-flux-control>
                @error('assembly_date')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo motivo de combocatoria -->
            <div data-flux-field>
                <label for="reason_call" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Motivo de Comvocatoria <span class="text-red-500">*</span>
                </label>
                <input type="text" id="reason_call" name="reason_call"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Motivo..." required data-flux-control>
                @error('reason_call')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo acuerdos principales -->
            <div data-flux-field>
                <label for="main_agreements" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                    Acuerdos Principales <span class="text-red-500">*</span>
                </label>
                <input type="text" id="main_agreements" name="main_agreements"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Acuerdos..." required data-flux-control>
                @error('main_agreements')
                    <p class="mt-1 text-sm text-red-500 font-medium" data-flux-component="error">{{ $message }}</p>
                @enderror
            </div>
            <!-- Campo numero de asistentes -->
            <div data-flux-field>
                <label for="number_attendees" class="block text-sm font-medium text-zinc-300 mb-1" data-flux-label>
                 Numero de Asociados <span class="text-red-500">*</span>
                </label>
                <input type="number" name="number_attendees" id="number_attendees"
                    class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white placeholder-zinc-500"
                    placeholder="Asociados..." required data-flux-control>
                @error('number_attendees')
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
                    Registrar Asamblea
                </button>
            </div>
        </form>
    </div>
</div>
