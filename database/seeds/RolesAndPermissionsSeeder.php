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
    	//DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	Schema::disableForeignKeyConstraints(); 
     	DB::table('permissions')->truncate();
   		DB::table('roles')->truncate();
    	DB::table('users')->truncate();
   		DB::table('model_has_roles')->truncate();
     	DB::table('model_has_permissions')->truncate();
     	DB::table('role_has_permissions')->truncate();
    	Schema::enableForeignKeyConstraints();
    	//DB::statement('SET FOREIGN_KEY_CHECKS=1;'); 


	//Creación de usuarios
		$user_DK = User::create([
    		'name' => 'Daniel Kimmich',
    		'email' => 'danielkimmich@hotmail.com',
    		'password' => bcrypt('secret')
		]);
		$user_AB = User::create([
    		'name' => 'Adrian Bergmeier',
    		'email' => 'adrianbergmeier15@gmail.com',
    		'password' => bcrypt('secret')
		]);		
		$user_DC = User::create([
    		'name' => 'Daniel Chetti',
    		'email' => 'chettichetti@hotmail.com',
    		'password' => bcrypt('secret')
		]);		
		$user_LZ = User::create([
    		'name' => 'Liliana Ziegenbein',
    		'email' => 'liliziegenbein@hotmail.com',
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
		$user_DK->assignRole('AdminAuth');
		$user_AB->assignRole('AdminAuth');
		$user_DC->assignRole('SuperAuth');


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
		$role_UserWorld->givePermissionTo('update worldcontinent');
		$role_UserWorld->givePermissionTo('list worldcountry');
		$role_UserWorld->givePermissionTo('show worldcountry');
		$role_UserWorld->givePermissionTo('update worldcountry');
		$role_UserWorld->givePermissionTo('list worlddivision');
		$role_UserWorld->givePermissionTo('show worlddivision');
		$role_UserWorld->givePermissionTo('update worlddivision');		
		$role_UserWorld->givePermissionTo('list worldcity');
		$role_UserWorld->givePermissionTo('show worldcity');
		$role_UserWorld->givePermissionTo('update worldcity');

	//Asignación del rol al usuario
		$user_DK->assignRole('AdminWorld');
		$user_AB->assignRole('AdminWorld');
		$user_DC->assignRole('AdminWorld');
		$user_LZ->assignRole('UserWorld');


//Modulo Manager
	//Creacion de Permisos
		Permission::create(['name' => 'list managerbackup', 'guard_name' => $guard]);
		Permission::create(['name' => 'list managerlog', 'guard_name' => $guard]);
		Permission::create(['name' => 'list managersetting', 'guard_name' => $guard]);
		Permission::create(['name' => 'list managermigrate', 'guard_name' => $guard]);

	//Creacion de Roles
		$role_AdminManager = Role::create(['name' => 'AdminManager', 'guard_name' => $guard]);
		$role_SuperManager = Role::create(['name' => 'SuperManager', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminManager->givePermissionTo('list managerbackup');
		$role_AdminManager->givePermissionTo('list managerlog');
		$role_AdminManager->givePermissionTo('list managersetting');
		$role_AdminManager->givePermissionTo('list managermigrate');

		$role_SuperManager->givePermissionTo('list managersetting');
		$role_SuperManager->givePermissionTo('list managermigrate');

	//Asignación del rol al usuario
		$user_DK->assignRole('AdminManager');
		$user_AB->assignRole('AdminManager');
		$user_DC->assignRole('SuperManager');

//Modulo Contacts
	//Creacion de Permisos
		Permission::create(['name' => 'list contactdata', 'guard_name' => $guard]);
		Permission::create(['name' => 'show contactdata', 'guard_name' => $guard]);
		Permission::create(['name' => 'create contactdata', 'guard_name' => $guard]);
		Permission::create(['name' => 'update contactdata', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete contactdata', 'guard_name' => $guard]);

		Permission::create(['name' => 'list contactsetting', 'guard_name' => $guard]);
		Permission::create(['name' => 'show contactsetting', 'guard_name' => $guard]);
		Permission::create(['name' => 'create contactsetting', 'guard_name' => $guard]);
		Permission::create(['name' => 'update contactsetting', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete contactsetting', 'guard_name' => $guard]);

		Permission::create(['name' => 'list contactdebug', 'guard_name' => $guard]);

	//Creacion de Roles
		$role_AdminContact = Role::create(['name' => 'AdminContact', 'guard_name' => $guard]);
		$role_SuperContact = Role::create(['name' => 'SuperContact', 'guard_name' => $guard]);
		$role_UserContact = Role::create(['name' => 'UserContact', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminContact->givePermissionTo('list contactdata');
		$role_AdminContact->givePermissionTo('show contactdata');
		$role_AdminContact->givePermissionTo('create contactdata');
		$role_AdminContact->givePermissionTo('update contactdata');
		$role_AdminContact->givePermissionTo('delete contactdata');

		$role_AdminContact->givePermissionTo('list contactsetting');
		$role_AdminContact->givePermissionTo('show contactsetting');
		$role_AdminContact->givePermissionTo('create contactsetting');
		$role_AdminContact->givePermissionTo('update contactsetting');
		$role_AdminContact->givePermissionTo('delete contactsetting');

		$role_SuperContact->givePermissionTo('list contactdata');
		$role_SuperContact->givePermissionTo('show contactdata');
		$role_SuperContact->givePermissionTo('create contactdata');
		$role_SuperContact->givePermissionTo('update contactdata');
		$role_SuperContact->givePermissionTo('delete contactdata');

		$role_SuperContact->givePermissionTo('list contactsetting');
		$role_SuperContact->givePermissionTo('show contactsetting');
		$role_SuperContact->givePermissionTo('update contactsetting');

		$role_UserContact->givePermissionTo('list contactdata');
		$role_UserContact->givePermissionTo('show contactdata');
		$role_UserContact->givePermissionTo('update contactdata');

	//Asignación del rol al usuario
		$user_DK->assignRole('AdminContact');
		$user_AB->assignRole('AdminContact');
		$user_DC->assignRole('SuperContact');
		$user_LZ->assignRole('UserContact');

//Modulo Blog
	//Creacion de Permisos
		Permission::create(['name' => 'list blogpost', 'guard_name' => $guard]);
		Permission::create(['name' => 'show blogpost', 'guard_name' => $guard]);
		Permission::create(['name' => 'create blogpost', 'guard_name' => $guard]);
		Permission::create(['name' => 'update blogpost', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete blogpost', 'guard_name' => $guard]);

		Permission::create(['name' => 'list blogcomment', 'guard_name' => $guard]);
		Permission::create(['name' => 'show blogcomment', 'guard_name' => $guard]);
		Permission::create(['name' => 'create blogcomment', 'guard_name' => $guard]);
		Permission::create(['name' => 'update blogcomment', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete blogcomment', 'guard_name' => $guard]);

		Permission::create(['name' => 'list blogcategory', 'guard_name' => $guard]);
		Permission::create(['name' => 'show blogcategory', 'guard_name' => $guard]);
		Permission::create(['name' => 'create blogcategory', 'guard_name' => $guard]);
		Permission::create(['name' => 'update blogcategory', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete blogcategory', 'guard_name' => $guard]);

		Permission::create(['name' => 'list blogtag', 'guard_name' => $guard]);
		Permission::create(['name' => 'show blogtag', 'guard_name' => $guard]);
		Permission::create(['name' => 'create blogtag', 'guard_name' => $guard]);
		Permission::create(['name' => 'update blogtag', 'guard_name' => $guard]);
		Permission::create(['name' => 'delete blogtag', 'guard_name' => $guard]);

	//Creacion de Roles
		$role_AdminBlog = Role::create(['name' => 'AdminBlog', 'guard_name' => $guard]);
		$role_SuperBlog = Role::create(['name' => 'SuperBlog', 'guard_name' => $guard]);
		$role_UserBlog = Role::create(['name' => 'UserBlog', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminBlog->givePermissionTo('list blogpost');
		$role_AdminBlog->givePermissionTo('show blogpost');
		$role_AdminBlog->givePermissionTo('create blogpost');
		$role_AdminBlog->givePermissionTo('update blogpost');
		$role_AdminBlog->givePermissionTo('delete blogpost');

		$role_AdminBlog->givePermissionTo('list blogcomment');
		$role_AdminBlog->givePermissionTo('show blogcomment');
		$role_AdminBlog->givePermissionTo('create blogcomment');
		$role_AdminBlog->givePermissionTo('update blogcomment');
		$role_AdminBlog->givePermissionTo('delete blogcomment');

		$role_AdminBlog->givePermissionTo('list blogcategory');
		$role_AdminBlog->givePermissionTo('show blogcategory');
		$role_AdminBlog->givePermissionTo('create blogcategory');
		$role_AdminBlog->givePermissionTo('update blogcategory');
		$role_AdminBlog->givePermissionTo('delete blogcategory');

		$role_AdminBlog->givePermissionTo('list blogtag');
		$role_AdminBlog->givePermissionTo('show blogtag');
		$role_AdminBlog->givePermissionTo('create blogtag');
		$role_AdminBlog->givePermissionTo('update blogtag');
		$role_AdminBlog->givePermissionTo('delete blogtag');

		$role_SuperBlog->givePermissionTo('list blogpost');
		$role_SuperBlog->givePermissionTo('show blogpost');
		$role_SuperBlog->givePermissionTo('create blogpost');
		$role_SuperBlog->givePermissionTo('update blogpost');
		$role_SuperBlog->givePermissionTo('delete blogpost');

		$role_SuperBlog->givePermissionTo('list blogcomment');
		$role_SuperBlog->givePermissionTo('show blogcomment');
		$role_SuperBlog->givePermissionTo('create blogcomment');
		$role_SuperBlog->givePermissionTo('update blogcomment');
		$role_SuperBlog->givePermissionTo('delete blogcomment');

		$role_SuperBlog->givePermissionTo('list blogcategory');
		$role_SuperBlog->givePermissionTo('show blogcategory');
		$role_SuperBlog->givePermissionTo('list blogtag');
		$role_SuperBlog->givePermissionTo('show blogtag');

		$role_UserBlog->givePermissionTo('list blogpost');
		$role_UserBlog->givePermissionTo('show blogpost');
		$role_UserBlog->givePermissionTo('list blogcomment');
		$role_UserBlog->givePermissionTo('show blogcomment');
		$role_UserBlog->givePermissionTo('list blogcategory');
		$role_UserBlog->givePermissionTo('show blogcategory');
		$role_UserBlog->givePermissionTo('list blogtag');
		$role_UserBlog->givePermissionTo('show blogtag');

	//Asignación del rol al usuario
		$user_DK->assignRole('AdminBlog');
		$user_DC->assignRole('AdminBlog');
		$user_AB->assignRole('SuperBlog');
		$user_LZ->assignRole('UserBlog');


    }
}
