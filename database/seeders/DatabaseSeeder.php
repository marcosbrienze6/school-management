<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserRoleSeeder::class,
        
        ]);

        $admin = Role::create(['name' => 'admin']);
        $professor = Role::create(['name' => 'professor']);
        $aluno = Role::create(['name' => 'aluno']);
        $responsavel = Role::create(['name' => 'responsavel']);
        $funcionario = Role::create(['name' => 'funcionario']);

        Permission::create(['name' => 'gerenciar usuarios']);
        Permission::create(['name' => 'visualizar diario']);
        Permission::create(['name' => 'editar desempenho']);

        $admin->givePermissionTo(['gerenciar usuarios', 'visualizar diario', 'editar desempenho']);
        $professor->givePermissionTo(['visualizar diario', 'editar desempenho']);
        $aluno->givePermissionTo(['visualizar diario']);
        $responsavel->givePermissionTo(['visualizar diario']);
    }
}
