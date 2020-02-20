<?php

use Illuminate\Database\Seeder;
use Backpack\PermissionManager\app\Models\Permission;
use Backpack\PermissionManager\app\Models\Role;
use App\Models\BackpackUser as User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 	// Reset cached roles and permissions
    	app()['cache']->forget('spatie.permission.cache');
    	$guard = config('backpack.base.guard');

	//Borrar datos actuales
    	if (env('DB_CONNECTION') = 'mysql') {
			DB::statement('SET FOREIGN_KEY_CHECKS=0;'); }
     	DB::table('permissions')->truncate();
   		DB::table('roles')->truncate();
    	DB::table('users')->truncate();
   		DB::table('model_has_roles')->truncate();
     	DB::table('model_has_permissions')->truncate();
     	DB::table('role_has_permissions')->truncate();
    	if (env('DB_CONNECTION') = 'mysql') {
     		DB::statement('SET FOREIGN_KEY_CHECKS=1;'); }

	//Creación de usuarios
		$user_Admin = User::create([
    		'name' => 'Administrator',
    		'email' => 'admin@contactos.com',
    		'password' => bcrypt('secret')
		]);
		$user_Super = User::create([
    		'name' => 'Supervisor',
    		'email' => 'super@contactos.com',
    		'password' => bcrypt('secret')
		]);		
		$user_Guest = User::create([
    		'name' => 'Guest',
    		'email' => 'guest@contactos.com',
    		'password' => bcrypt('secret')
		]);		

//Modulo Authentication
	//Creacion de Permisos
		Permission::create(['name' => 'list authrole', 'guard_name' => $guard]);
		Permission::create(['name' => 'show authrole', 'guard_name' => $guard]);
		Permission::create(['name' => 'create authrole', 'guard_name' => $guard]);
		Permission::create(['name' => 'update authrole', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete authrole', 'guard_name' => $guard]);

		Permission::create(['name' => 'list authuser', 'guard_name' => $guard]);
		Permission::create(['name' => 'show authuser', 'guard_name' => $guard]);
		Permission::create(['name' => 'create authuser', 'guard_name' => $guard]);
		Permission::create(['name' => 'update authuser', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete authuser', 'guard_name' => $guard]);

		Permission::create(['name' => 'list authpermission', 'guard_name' => $guard]);
		Permission::create(['name' => 'show authpermission', 'guard_name' => $guard]);
		Permission::create(['name' => 'create authpermission', 'guard_name' => $guard]);
		Permission::create(['name' => 'update authpermission', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete authpermission', 'guard_name' => $guard]);		

	//Creacion de Roles
		$role_AdminAuth = Role::create(['name' => 'AdminAuth', 'guard_name' => $guard]);
		$role_SuperAuth = Role::create(['name' => 'SuperAuth', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminAuth->givePermissionTo('list authrole');
		$role_AdminAuth->givePermissionTo('show authrole');
		$role_AdminAuth->givePermissionTo('create authrole');
		$role_AdminAuth->givePermissionTo('update authrole');
		$role_AdminAuth->givePermissionTo('delete authrole');

		$role_AdminAuth->givePermissionTo('list authuser');
		$role_AdminAuth->givePermissionTo('show authuser');
		$role_AdminAuth->givePermissionTo('create authuser');
		$role_AdminAuth->givePermissionTo('update authuser');
		$role_AdminAuth->givePermissionTo('delete authuser');

		$role_AdminAuth->givePermissionTo('list authpermission');
		$role_AdminAuth->givePermissionTo('show authpermission');
		$role_AdminAuth->givePermissionTo('create authpermission');
		$role_AdminAuth->givePermissionTo('update authpermission');
		$role_AdminAuth->givePermissionTo('delete authpermission');

		$role_SuperAuth->givePermissionTo('list authrole');
		$role_SuperAuth->givePermissionTo('show authrole');
		$role_SuperAuth->givePermissionTo('list authuser');
		$role_SuperAuth->givePermissionTo('show authuser');
		$role_SuperAuth->givePermissionTo('list authpermission');
		$role_SuperAuth->givePermissionTo('show authpermission');

	//Asignación del rol al usuario
		$user_Admin->assignRole('AdminAuth');
		$user_Super->assignRole('SuperAuth');


//Modulo World
	//Creacion de Permisos
		Permission::create(['name' => 'list worldcontinent', 'guard_name' => $guard]);
		Permission::create(['name' => 'show worldcontinent', 'guard_name' => $guard]);
		Permission::create(['name' => 'create worldcontinent', 'guard_name' => $guard]);
		Permission::create(['name' => 'update worldcontinent', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete worldcontinent', 'guard_name' => $guard]);

		Permission::create(['name' => 'list worldcountry', 'guard_name' => $guard]);
		Permission::create(['name' => 'show worldcountry', 'guard_name' => $guard]);
		Permission::create(['name' => 'create worldcountry', 'guard_name' => $guard]);
		Permission::create(['name' => 'update worldcountry', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete worldcountry', 'guard_name' => $guard]);

		Permission::create(['name' => 'list worlddivision', 'guard_name' => $guard]);
		Permission::create(['name' => 'show worlddivision', 'guard_name' => $guard]);
		Permission::create(['name' => 'create worlddivision', 'guard_name' => $guard]);
		Permission::create(['name' => 'update worlddivision', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete worlddivision', 'guard_name' => $guard]);

		Permission::create(['name' => 'list worldcity', 'guard_name' => $guard]);
		Permission::create(['name' => 'show worldcity', 'guard_name' => $guard]);
		Permission::create(['name' => 'create worldcity', 'guard_name' => $guard]);
		Permission::create(['name' => 'update worldcity', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete worldcity', 'guard_name' => $guard]);

	//Creacion de Roles
		$role_AdminWorld = Role::create(['name' => 'AdminWorld', 'guard_name' => $guard]);
		$role_UserWorld = Role::create(['name' => 'UserWorld', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminWorld->givePermissionTo('list worldcontinent');
		$role_AdminWorld->givePermissionTo('show worldcontinent');
		$role_AdminWorld->givePermissionTo('create worldcontinent');
		$role_AdminWorld->givePermissionTo('update worldcontinent');
		$role_AdminWorld->givePermissionTo('delete worldcontinent');

		$role_AdminWorld->givePermissionTo('list worldcountry');
		$role_AdminWorld->givePermissionTo('show worldcountry');
		$role_AdminWorld->givePermissionTo('create worldcountry');
		$role_AdminWorld->givePermissionTo('update worldcountry');
		$role_AdminWorld->givePermissionTo('delete worldcountry');

		$role_AdminWorld->givePermissionTo('list worlddivision');
		$role_AdminWorld->givePermissionTo('show worlddivision');
		$role_AdminWorld->givePermissionTo('create worlddivision');
		$role_AdminWorld->givePermissionTo('update worlddivision');
		$role_AdminWorld->givePermissionTo('delete worlddivision');

		$role_AdminWorld->givePermissionTo('list worldcity');
		$role_AdminWorld->givePermissionTo('show worldcity');
		$role_AdminWorld->givePermissionTo('create worldcity');
		$role_AdminWorld->givePermissionTo('update worldcity');
		$role_AdminWorld->givePermissionTo('delete worldcity');

		$role_UserWorld->givePermissionTo('list worldcontinent');
		$role_UserWorld->givePermissionTo('show worldcontinent');
		$role_UserWorld->givePermissionTo('list worldcountry');
		$role_UserWorld->givePermissionTo('show worldcountry');
		$role_UserWorld->givePermissionTo('list worlddivision');
		$role_UserWorld->givePermissionTo('show worlddivision');
		$role_UserWorld->givePermissionTo('list worldcity');
		$role_UserWorld->givePermissionTo('show worldcity');

	//Asignación del rol al usuario
		$user_Admin->assignRole('AdminWorld');
		$user_Guest->assignRole('UserWorld');


    }
}
