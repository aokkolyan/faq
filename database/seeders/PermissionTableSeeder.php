<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'question-list',
            'create-question',
            'edit-question',
            'delete-question',
            'answer-list',
            'create-answer',
            'edit-answer',
            'delete-answer',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


    }
}
