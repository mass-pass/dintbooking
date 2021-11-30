<?php

use Illuminate\Database\Seeder;

class VisitorPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = \App\Models\Permissions::firstOrCreate(
            [
                'name'              => 'manage_visitor'
            ],
            [
                'display_name'      => 'Manage Visitor',
                'description'       => 'Manage Visitor',
                'created_at'        => now(),
                'updated_at'        => now()
            ]
        );
        \DB::table('permission_role')->insertOrIgnore(
            ['permission_id' => $permission->id, 'role_id' => 1]
        );
    }
}
