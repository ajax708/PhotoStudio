<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //roles del sistema
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' =>'Fotografo']);
        $role3 = Role::create(['name' =>'Cliente']);

        //permisos para acceder a las rutas
        //MODULO DE EVENTOS
        Permission::create(['name' => 'event.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'event.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'event.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'event.destroy'])->syncRoles([$role1]);

        //MODULO DE ASIGNACIONES
        Permission::create(['name' => 'assign.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'assign.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'assign.destroy'])->syncRoles([$role1]);

        //MODULO DE FOTOS(FOTOGRAFOS)
        Permission::create(['name' => 'photo.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'photo.show'])->syncRoles([$role2]);
        Permission::create(['name' => 'photo.showtoadmin'])->syncRoles([$role1, $role3]);

        //MODULO DE FOTOS(CLIENTE)
        Permission::create(['name' => 'detect.create'])->syncRoles([$role3]);
        Permission::create(['name' => 'detect.show'])->syncRoles([$role3]);

        //MODULO DE SHOPP
        Permission::create(['name' => 'sale.create'])->syncRoles([$role3]);
        Permission::create(['name' => 'sale.invoice'])->syncRoles([$role3]);

    }
}
