<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear rol admin
        $role = Role::create(['name' => 'admin']);

        Permission::create(['name' => 'admin.dashboard'])->syncRoles([$role]);

        // Lista de permisos organizados por módulo
        $permissions = [
            // Dashboard y home
            'admin.dashboard',
            'admin.home.index',

            // Asociados
            'admin.asociados.index',
            'admin.asociados.store',
            'admin.asociados.update',
            'admin.asociados.destroy',
            'admin.asociados.export-pdf',

            // Incidencias reportadas
            'admin.reported-incidence.index',
            'admin.reported-incidence.store',
            'admin.reported-incidence.update',
            'admin.reported-incidence.destroy',
            'admin.reported-incidence.export-pdf',

            // Pagos
            'admin.pago_cuotas.index',
            'admin.pago_cuotas.store',
            'admin.pago_cuotas.update',
            'admin.pago_cuotas.destroy',
            'admin.pago_cuotas.export-excel',

            // Gasto productos
            'admin.gastoproductos.index',
            'admin.gastoproductos.store',
            'admin.gastoproductos.update',
            'admin.gastoproductos.destroy',
            'admin.gastoproductos.export-excel',
        ];

        // Crear permisos y asignarlos al rol admin
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm])->assignRole($role);
        }

        // Crear un usuario y asignarle el rol
        User::factory()->create([
            'name' => 'adolfo',
            'email' => 'adolfo@gmail.com',
            'password' => bcrypt('123456789'),
        ])->assignRole('admin');
    }
}
