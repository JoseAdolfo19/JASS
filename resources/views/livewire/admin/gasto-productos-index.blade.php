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
            Registrar Gasto de Productos
        </h1>
       <form action="{{ route('admin.gastoproductos.store') }}" method="POST" data-flux-component="form">
    @csrf

    {{-- Fila 1: Producto - Descripción - Proveedor --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div>
            <label for="name" class="block text-sm font-medium text-zinc-300 mb-1">
                Producto <span class="text-red-500">*</span>
            </label>
            <input type="text" id="name" name="name"
                class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                placeholder="Nombre del producto..." required>
            @error('name')
                <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description_product" class="block text-sm font-medium text-zinc-300 mb-1">
                Descripción <span class="text-red-500">*</span>
            </label>
            <input type="text" id="description_product" name="description_product"
                class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                placeholder="Descripción..." required>
            @error('description_product')
                <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="supplier" class="block text-sm font-medium text-zinc-300 mb-1">
                Proveedor <span class="text-red-500">*</span>
            </label>
            <input type="text" id="supplier" name="supplier"
                class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                placeholder="Proveedor..." required>
            @error('supplier')
                <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Fila 2: Cantidad - Costo Total - Fecha de Compra --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div>
            <label for="amount" class="block text-sm font-medium text-zinc-300 mb-1">
                Cantidad <span class="text-red-500">*</span>
            </label>
            <input type="text" id="amount" name="amount"
                class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                placeholder="Cantidad..." required>
            @error('amount')
                <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="total_cost" class="block text-sm font-medium text-zinc-300 mb-1">
                Costo Total <span class="text-red-500">*</span>
            </label>
            <input type="number" name="total_cost" id="total_cost"
                class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                placeholder="Total..." required>
            @error('total_cost')
                <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="date_buy" class="block text-sm font-medium text-zinc-300 mb-1">
                Fecha de Compra <span class="text-red-500">*</span>
            </label>
            <input id="date_buy" name="date_buy" type="date"
                class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-lg text-white"
                required>
            @error('date_buy')
                <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>
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
    <div class="flex justify-end w-full mt-6">
        <button type="submit"
            class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 transition-all duration-200 shadow-lg hover:shadow-xl"
            data-flux-component="button">
            Registrar Gasto de Productos
        </button>
    </div>
</form>
    </div>
</div>