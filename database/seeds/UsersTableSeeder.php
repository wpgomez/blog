<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Role::truncate();
        User::truncate();
        
        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);

        $viewPostsPermission = Permission::create(['name' => 'View posts']);
        $createPostsPermission = Permission::create(['name' => 'Create posts']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts']);

        $admin = factory(App\User::class)->create([
            'name' => 'Willy Gomez',
            'email' => 'wp_gomez@hotmail.com',
            'password' => bcrypt('123'),
        ]);

        $admin->assignRole($adminRole);

        $writer = factory(App\User::class)->create([
            'name' => 'Steven Gomez',
            'email' => 'sgomeza1997@hotmail.com',
            'password' => bcrypt('123'),
        ]);

        $writer->assignRole($writerRole);
        
        factory(App\User::class, 3)->create();
    }
}
