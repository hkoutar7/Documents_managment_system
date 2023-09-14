<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            //pages
            'dashboard',
            'documents',
            'archives',
            'reports',
            'users',
            'roles',
            'sections',

            //actions
            'add_document', //
            'export_document_excel', //
            'list_documents',  //
            'view_document', //
            'edit_document', //
            'archive_document', //
            'delete_document',//

            'list_attachments',
            'add_attachment',
            'view_attachment',
            'download_attachment',
            'edit_attachment',
            'delete_attachment',

            'restore_from_archive',
            'delete_from_archive',

            'filter_documents',
            'search_documents',

            'user_list',
            'user_create',
            'user_edit',
            'user_delete',
            'user_changeStatus',
            'user_show',

            'role-list',
            'role_show',
            'role-create',
            'role-edit',
            'role-delete',

            'section_list',
            'section_create',
            'section_edit',
            'section_delete',

            'client_list',
            'client_add',
            'client_edit',
            'client_delete',

        ];

        foreach ($permissions as $permission)
            Permission::create(['name' => $permission]);

}
}
