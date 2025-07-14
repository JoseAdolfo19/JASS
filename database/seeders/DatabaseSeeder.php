<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);

        // crear permisos
        $permissions = [
            // dashboard y home
            'admin.dashboard',
            'admin.home.index',

            // clientes
            'admin.asocidados.index',
            'admin.asocidados.store',
            'admin.asocidados.update',
            'admin.asocidados.destroy',
            'admin.asocidados.export-pdf',

            // gastosproductoses
            'admin.gastosproductos.index',
            'admin.gastosproductos.store',
            'admin.gastosproductos.update',
            'admin.gastosproductos.destroy',
            'admin.gastosproductos.export-pdf',

            // compras
            'admin.reportes.index',
            'admin.reportes.store',
            'admin.reportes.update',
            'admin.reportes.destroy',

            // detalles de reportes
            'admin.pago.index',
            'admin.pago.store',
            'admin.pago.update',
            'admin.pago.destroy',

            // task
            'admin.task.index',
            'admin.task.store',
            'admin.task.update',
            'admin.task.destroy',

            // ordenes
            'admin.comunalassemby.index',
            'admin.comunalassemby.store',
            'admin.comunalassemby.update',
            'admin.comunalassemby.destroy',
        ];

        foreach ($permissions as $perm) {
            Permission::findOrCreate($perm, 'web')->assignRole($role);
        }

        // Crear un usuario admin
        User::factory()->create([
            'name' => 'adolfo',
            'email' => 'adolfo@gmail.com',
            'password' => bcrypt('123456789'),
        ])->assignRole($role);
    }
}
