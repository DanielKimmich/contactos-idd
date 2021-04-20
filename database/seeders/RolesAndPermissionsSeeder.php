<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
		$user_AW = User::create([
    		'name' => 'Adriane Weyreuter',
    		'email' => 'adrianeyw@gmail.com',
    		'password' => bcrypt('secret')
		]);	


//Modulo Authentication
	//Creacion de Permisos
		Permission::create(['name' => 'authrole.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'authrole.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'authrole.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'authrole.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'authrole.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'authuser.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'authuser.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'authuser.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'authuser.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'authuser.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'authpermission.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'authpermission.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'authpermission.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'authpermission.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'authpermission.delete', 'guard_name' => $guard]);		

	//Creacion de Roles
		$role_AdminAuth = Role::create(['name' => 'AdminAuth', 'guard_name' => $guard]);
		$role_SuperAuth = Role::create(['name' => 'SuperAuth', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminAuth->givePermissionTo('authrole.list');
		$role_AdminAuth->givePermissionTo('authrole.show');
		$role_AdminAuth->givePermissionTo('authrole.create');
		$role_AdminAuth->givePermissionTo('authrole.update');
		$role_AdminAuth->givePermissionTo('authrole.delete');

		$role_AdminAuth->givePermissionTo('authuser.list');
		$role_AdminAuth->givePermissionTo('authuser.show');
		$role_AdminAuth->givePermissionTo('authuser.create');
		$role_AdminAuth->givePermissionTo('authuser.update');
		$role_AdminAuth->givePermissionTo('authuser.delete');

		$role_AdminAuth->givePermissionTo('authpermission.list');
		$role_AdminAuth->givePermissionTo('authpermission.show');
		$role_AdminAuth->givePermissionTo('authpermission.create');
		$role_AdminAuth->givePermissionTo('authpermission.update');
		$role_AdminAuth->givePermissionTo('authpermission.delete');

		$role_SuperAuth->givePermissionTo('authrole.list');
		$role_SuperAuth->givePermissionTo('authrole.show');
		$role_SuperAuth->givePermissionTo('authuser.list');
		$role_SuperAuth->givePermissionTo('authuser.show');
		$role_SuperAuth->givePermissionTo('authpermission.list');
		$role_SuperAuth->givePermissionTo('authpermission.show');

	//Asignación del rol al usuario
		$user_DK->assignRole('AdminAuth');
		$user_AB->assignRole('AdminAuth');
		$user_DC->assignRole('SuperAuth');


//Modulo World
	//Creacion de Permisos
		Permission::create(['name' => 'worldcontinent.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcontinent.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcontinent.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcontinent.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcontinent.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'worldcountry.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcountry.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcountry.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcountry.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcountry.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'worlddivision.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'worlddivision.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'worlddivision.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'worlddivision.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'worlddivision.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'worldcity.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcity.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcity.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcity.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'worldcity.delete', 'guard_name' => $guard]);

	//Creacion de Roles
		$role_AdminWorld = Role::create(['name' => 'AdminWorld', 'guard_name' => $guard]);
		$role_UserWorld = Role::create(['name' => 'UserWorld', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminWorld->givePermissionTo('worldcontinent.list');
		$role_AdminWorld->givePermissionTo('worldcontinent.show');
		$role_AdminWorld->givePermissionTo('worldcontinent.create');
		$role_AdminWorld->givePermissionTo('worldcontinent.update');
		$role_AdminWorld->givePermissionTo('worldcontinent.delete');

		$role_AdminWorld->givePermissionTo('worldcountry.list');
		$role_AdminWorld->givePermissionTo('worldcountry.show');
		$role_AdminWorld->givePermissionTo('worldcountry.create');
		$role_AdminWorld->givePermissionTo('worldcountry.update');
		$role_AdminWorld->givePermissionTo('worldcountry.delete');

		$role_AdminWorld->givePermissionTo('worlddivision.list');
		$role_AdminWorld->givePermissionTo('worlddivision.show');
		$role_AdminWorld->givePermissionTo('worlddivision.create');
		$role_AdminWorld->givePermissionTo('worlddivision.update');
		$role_AdminWorld->givePermissionTo('worlddivision.delete');

		$role_AdminWorld->givePermissionTo('worldcity.list');
		$role_AdminWorld->givePermissionTo('worldcity.show');
		$role_AdminWorld->givePermissionTo('worldcity.create');
		$role_AdminWorld->givePermissionTo('worldcity.update');
		$role_AdminWorld->givePermissionTo('worldcity.delete');

		$role_UserWorld->givePermissionTo('worldcontinent.list');
		$role_UserWorld->givePermissionTo('worldcontinent.show');
		$role_UserWorld->givePermissionTo('worldcontinent.update');
		$role_UserWorld->givePermissionTo('worldcountry.list');
		$role_UserWorld->givePermissionTo('worldcountry.show');
		$role_UserWorld->givePermissionTo('worldcountry.update');
		$role_UserWorld->givePermissionTo('worlddivision.list');
		$role_UserWorld->givePermissionTo('worlddivision.show');
		$role_UserWorld->givePermissionTo('worlddivision.update');		
		$role_UserWorld->givePermissionTo('worldcity.list');
		$role_UserWorld->givePermissionTo('worldcity.show');
		$role_UserWorld->givePermissionTo('worldcity.update');

	//Asignación del rol al usuario
		$user_DK->assignRole('AdminWorld');
		$user_AB->assignRole('AdminWorld');
		$user_DC->assignRole('AdminWorld');
		$user_LZ->assignRole('UserWorld');
		$user_AW->assignRole('AdminWorld');

//Modulo Manager
	//Creacion de Permisos
		Permission::create(['name' => 'managerbackup.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'managerlog.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'managerfile.list', 'guard_name' => $guard]);		
		Permission::create(['name' => 'managersetting.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'managermigrate.list', 'guard_name' => $guard]);

	//Creacion de Roles
		$role_AdminManager = Role::create(['name' => 'AdminManager', 'guard_name' => $guard]);
		$role_SuperManager = Role::create(['name' => 'SuperManager', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminManager->givePermissionTo('managerbackup.list');
		$role_AdminManager->givePermissionTo('managerlog.list');
		$role_AdminManager->givePermissionTo('managerfile.list');
		$role_AdminManager->givePermissionTo('managersetting.list');
		$role_AdminManager->givePermissionTo('managermigrate.list');


		$role_SuperManager->givePermissionTo('managersetting.list');
		$role_SuperManager->givePermissionTo('managermigrate.list');

	//Asignación del rol al usuario
		$user_DK->assignRole('AdminManager');
		$user_AB->assignRole('AdminManager');
		$user_DC->assignRole('SuperManager');
		$user_AW->assignRole('SuperManager');

//Modulo Contacts
	//Creacion de Permisos
		Permission::create(['name' => 'contactperson.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactperson.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactperson.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactperson.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactperson.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'contactfamily.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactfamily.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactfamily.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactfamily.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactfamily.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'contactchurch.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactchurch.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactchurch.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactchurch.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactchurch.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'contactsetting.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactsetting.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactsetting.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactsetting.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'contactsetting.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'contactdata.list', 'guard_name' => $guard]);

	//Creacion de Roles
		$role_AdminContact = Role::create(['name' => 'AdminContact', 'guard_name' => $guard]);
		$role_SuperContact = Role::create(['name' => 'SuperContact', 'guard_name' => $guard]);
		$role_UserContact = Role::create(['name' => 'UserContact', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminContact->givePermissionTo('contactperson.list');
		$role_AdminContact->givePermissionTo('contactperson.show');
		$role_AdminContact->givePermissionTo('contactperson.create');
		$role_AdminContact->givePermissionTo('contactperson.update');
		$role_AdminContact->givePermissionTo('contactperson.delete');

		$role_AdminContact->givePermissionTo('contactfamily.list');
		$role_AdminContact->givePermissionTo('contactfamily.show');
		$role_AdminContact->givePermissionTo('contactfamily.create');
		$role_AdminContact->givePermissionTo('contactfamily.update');
		$role_AdminContact->givePermissionTo('contactfamily.delete');

		$role_AdminContact->givePermissionTo('contactchurch.list');
		$role_AdminContact->givePermissionTo('contactchurch.show');
		$role_AdminContact->givePermissionTo('contactchurch.create');
		$role_AdminContact->givePermissionTo('contactchurch.update');
		$role_AdminContact->givePermissionTo('contactchurch.delete');

		$role_AdminContact->givePermissionTo('contactsetting.list');
		$role_AdminContact->givePermissionTo('contactsetting.show');
		$role_AdminContact->givePermissionTo('contactsetting.create');
		$role_AdminContact->givePermissionTo('contactsetting.update');
		$role_AdminContact->givePermissionTo('contactsetting.delete');


		$role_SuperContact->givePermissionTo('contactperson.list');
		$role_SuperContact->givePermissionTo('contactperson.show');
		$role_SuperContact->givePermissionTo('contactperson.create');
		$role_SuperContact->givePermissionTo('contactperson.update');
		$role_SuperContact->givePermissionTo('contactperson.delete');

		$role_SuperContact->givePermissionTo('contactfamily.list');
		$role_SuperContact->givePermissionTo('contactfamily.show');
		$role_SuperContact->givePermissionTo('contactfamily.create');
		$role_SuperContact->givePermissionTo('contactfamily.update');
		$role_SuperContact->givePermissionTo('contactfamily.delete');

		$role_SuperContact->givePermissionTo('contactchurch.list');
		$role_SuperContact->givePermissionTo('contactchurch.show');
		$role_SuperContact->givePermissionTo('contactchurch.create');
		$role_SuperContact->givePermissionTo('contactchurch.update');
		$role_SuperContact->givePermissionTo('contactchurch.delete');

		$role_SuperContact->givePermissionTo('contactsetting.list');
		$role_SuperContact->givePermissionTo('contactsetting.show');
		$role_SuperContact->givePermissionTo('contactsetting.update');

		$role_UserContact->givePermissionTo('contactperson.list');
		$role_UserContact->givePermissionTo('contactperson.show');
		$role_UserContact->givePermissionTo('contactperson.update');

		$role_UserContact->givePermissionTo('contactfamily.list');
		$role_UserContact->givePermissionTo('contactfamily.show');
		$role_UserContact->givePermissionTo('contactfamily.update');

		$role_UserContact->givePermissionTo('contactchurch.list');
		$role_UserContact->givePermissionTo('contactchurch.show');
		$role_UserContact->givePermissionTo('contactchurch.update');

		
	//Asignación del rol al usuario
		$user_DK->assignRole('AdminContact');
		$user_AB->assignRole('AdminContact');
		$user_DC->assignRole('SuperContact');
		$user_LZ->assignRole('UserContact');
		$user_AW->assignRole('AdminContact');

//Modulo Blog
	//Creacion de Permisos
		Permission::create(['name' => 'blogpost.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogpost.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogpost.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogpost.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogpost.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'blogcomment.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogcomment.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogcomment.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogcomment.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogcomment.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'blogcategory.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogcategory.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogcategory.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogcategory.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogcategory.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'blogtag.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogtag.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogtag.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogtag.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'blogtag.delete', 'guard_name' => $guard]);

		Permission::create(['name' => 'blognotification.list', 'guard_name' => $guard]);
		Permission::create(['name' => 'blognotification.show', 'guard_name' => $guard]);
		Permission::create(['name' => 'blognotification.create', 'guard_name' => $guard]);
		Permission::create(['name' => 'blognotification.update', 'guard_name' => $guard]);
		Permission::create(['name' => 'blognotification.delete', 'guard_name' => $guard]);


	//Creacion de Roles
		$role_AdminBlog = Role::create(['name' => 'AdminBlog', 'guard_name' => $guard]);
		$role_SuperBlog = Role::create(['name' => 'SuperBlog', 'guard_name' => $guard]);
		$role_UserBlog = Role::create(['name' => 'UserBlog', 'guard_name' => $guard]);

	//Asignacion del permiso al rol
		$role_AdminBlog->givePermissionTo('blogpost.list');
		$role_AdminBlog->givePermissionTo('blogpost.show');
		$role_AdminBlog->givePermissionTo('blogpost.create');
		$role_AdminBlog->givePermissionTo('blogpost.update');
		$role_AdminBlog->givePermissionTo('blogpost.delete');

		$role_AdminBlog->givePermissionTo('blogcomment.list');
		$role_AdminBlog->givePermissionTo('blogcomment.show');
		$role_AdminBlog->givePermissionTo('blogcomment.create');
		$role_AdminBlog->givePermissionTo('blogcomment.update');
		$role_AdminBlog->givePermissionTo('blogcomment.delete');

		$role_AdminBlog->givePermissionTo('blogcategory.list');
		$role_AdminBlog->givePermissionTo('blogcategory.show');
		$role_AdminBlog->givePermissionTo('blogcategory.create');
		$role_AdminBlog->givePermissionTo('blogcategory.update');
		$role_AdminBlog->givePermissionTo('blogcategory.delete');

		$role_AdminBlog->givePermissionTo('blogtag.list');
		$role_AdminBlog->givePermissionTo('blogtag.show');
		$role_AdminBlog->givePermissionTo('blogtag.create');
		$role_AdminBlog->givePermissionTo('blogtag.update');
		$role_AdminBlog->givePermissionTo('blogtag.delete');

		$role_AdminBlog->givePermissionTo('blognotification.list');
		$role_AdminBlog->givePermissionTo('blognotification.show');
		$role_AdminBlog->givePermissionTo('blognotification.create');
		$role_AdminBlog->givePermissionTo('blognotification.update');
		$role_AdminBlog->givePermissionTo('blognotification.delete');


		$role_SuperBlog->givePermissionTo('blogpost.list');
		$role_SuperBlog->givePermissionTo('blogpost.show');
		$role_SuperBlog->givePermissionTo('blogpost.create');
		$role_SuperBlog->givePermissionTo('blogpost.update');
		$role_SuperBlog->givePermissionTo('blogpost.delete');

		$role_SuperBlog->givePermissionTo('blogcomment.list');
		$role_SuperBlog->givePermissionTo('blogcomment.show');
		$role_SuperBlog->givePermissionTo('blogcomment.create');
		$role_SuperBlog->givePermissionTo('blogcomment.update');
		$role_SuperBlog->givePermissionTo('blogcomment.delete');

		$role_SuperBlog->givePermissionTo('blogcategory.list');
		$role_SuperBlog->givePermissionTo('blogcategory.show');
		$role_SuperBlog->givePermissionTo('blogtag.list');
		$role_SuperBlog->givePermissionTo('blogtag.show');
		$role_AdminBlog->givePermissionTo('blognotification.list');
		$role_AdminBlog->givePermissionTo('blognotification.show');


		$role_UserBlog->givePermissionTo('blogpost.list');
		$role_UserBlog->givePermissionTo('blogpost.show');
		$role_UserBlog->givePermissionTo('blogcomment.list');
		$role_UserBlog->givePermissionTo('blogcomment.show');
		$role_UserBlog->givePermissionTo('blogcategory.list');
		$role_UserBlog->givePermissionTo('blogcategory.show');
		$role_UserBlog->givePermissionTo('blogtag.list');
		$role_UserBlog->givePermissionTo('blogtag.show');

	//Asignación del rol al usuario
		$user_DK->assignRole('AdminBlog');
		$user_DC->assignRole('AdminBlog');
		$user_AB->assignRole('SuperBlog');
		$user_LZ->assignRole('UserBlog');
		$user_AW->assignRole('SuperBlog');

    }
}
