<?php
/**
 * Created by PhpStorm.
 * User: lara
 * Date: 6/27/16
 * Time: 3:01 PM
 */

/**
 * Agregamos un usuario nuevo a la base de datos.
 */

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

//use App\Permission;
//use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->insert(array(
            'username' => 'administrator',
            'email' => 'admin@admin.com',
            'name' => 'Administrator',
            'active' => 1,
            'api_token' => str_random(60),
            'password' => \Hash::make('Administrator') // Hash::make() nos va generar una cadena con nuestra contraseña encriptada

        ));
        \DB::table('users')->insert(array(
            'username' => 'guest',
            'email' => 'guest@guest.com',
            'name' => 'Guest',
            'active' => 0,
            'api_token' => 'MiNv3cX4SxfOh3JuUyuxvBZkIqZWEQcKwtD60heoeWXPopecSEnYukK6cCjF',
            'password' => \Hash::make('gues}tSddf1e(') // Hash::make() nos va generar una cadena con nuestra contraseña encriptada

        ));
        $this->Crud_rol();


//        factory(\App\Permission::class)->times(300)->create();
    }

    public function Crud_rol()
    {
        $user_rol = new Role();
        $user_rol->name = 'user';
        $user_rol->display_name = 'User'; // optional
        $user_rol->description = 'User'; // optional
        $user_rol->save();

        $guest = new Role();
        $guest->name = 'guest';
        $guest->display_name = 'Guest'; // optional
        $guest->description = 'Guest'; // optional
        $guest->save();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description = 'User is allowed to manage and edit other users'; // optional
        $admin->save();


        $createRol = new Permission();
        $createRol->name = 'create_rol';
        $createRol->display_name = 'Create Rol'; // optional
        $createRol->description = 'create new Rol'; // optional
        $createRol->save();

        $editRol = new Permission();
        $editRol->name = 'edit_rol';
        $editRol->display_name = 'Edit Rol'; // optional
        $editRol->description = 'Edit Rol'; // optional
        $editRol->save();

        $deleteRol = new Permission();
        $deleteRol->name = 'delete_rol';
        $deleteRol->display_name = 'Delete Rol'; // optional
        $deleteRol->description = 'Delete new Rol'; // optional
        $deleteRol->save();

        $createUser = new Permission();
        $createUser->name = 'create_user';
        $createUser->display_name = 'Create User'; // optional
        $createUser->description = 'create new User'; // optional
        $createUser->save();

        $editUser = new Permission();
        $editUser->name = 'edit_user';
        $editUser->display_name = 'Edit User'; // optional
        $editUser->description = 'Edit User'; // optional
        $editUser->save();

        $deleteUser = new Permission();
        $deleteUser->name = 'delete_user';
        $deleteUser->display_name = 'Delete User'; // optional
        $deleteUser->description = 'Delete new User'; // optional
        $deleteUser->save();

        $createPermission = new Permission();
        $createPermission->name = 'create_permission';
        $createPermission->display_name = 'Create Permission'; // optional
        $createPermission->description = 'create new Permission'; // optional
        $createPermission->save();

        $editPermission = new Permission();
        $editPermission->name = 'edit_permission';
        $editPermission->display_name = 'Edit Permission'; // optional
        $editPermission->description = 'Edit Permission'; // optional
        $editPermission->save();

        $deletePermission = new Permission();
        $deletePermission->name = 'delete_permission';
        $deletePermission->display_name = 'Delete Permission'; // optional
        $deletePermission->description = 'Delete new Permission'; // optional
        $deletePermission->save();


        $user = User::where('username', '=', 'administrator')->first();

//        $perfil_user = new \App\Profile();
//        $perfil_user->bio = "adfadfadf";
//        $user->profile()->save($perfil_user);

        $user->attachRole($admin);

        $user_guest = User::where('username', '=', 'guest')->first();

        $user_guest->attachRole($guest);

        $admin->perms()->sync([$createPermission->id, $editPermission->id, $deletePermission->id, $createRol->id, $editRol->id, $deleteRol->id, $createUser->id, $editUser->id, $deleteUser->id]);


    }
}