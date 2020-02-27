<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i>{{ trans('backpack::base.dashboard') }}</a></li>



<!-- Contactos -->
@if (auth()->user()->hasAnyPermission(['list contactdata','list contactsetting']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-address-book"></i>{{ trans('common.menu.contact') }}</a>
	<ul class="nav-dropdown-items">
 	  @can('list contactdata')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact') }}'><i class='nav-icon fa fa-id-card-o'></i>{{ trans('contact.titles') }}</a></li>
	  @endcan

 	  @can('list contactsetting')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contenttype') }}'><i class='nav-icon fa fa-cogs'></i>Preferencias</a></li>	
	  @endcan

		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contactdata') }}'><i class='nav-icon fa fa-question'></i>ContactDatas

		</a></li>	
	</ul>
  </li>
@endif

<!-- Continents, Contries, Divisions, Cities -->
@if (auth()->user()->hasAnyPermission(['list worldcontinent','list worldcountry','list worlddivision','list worldcity']))
 <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-globe"></i>{{ trans('common.menu.world') }}</a>
	<ul class="nav-dropdown-items">
	  @can('list worldcontinent')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcontinent') }}"><i class="nav-icon fa fa-cloud"></i><span>{{ trans('world.continent.titles') }}</span></a></li>
       @endcan

       @can('list worldcountry')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcountry') }}"><i class="nav-icon fa fa-flag"></i><span>{{ trans('world.country.titles') }}</span></a></li>
        @endcan

        @can('list worlddivision')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worlddivision') }}"><i class="nav-icon fa fa-map-o"></i><span>{{ trans('world.division.titles') }}</span></a></li>
        @endcan

        @can('list worldcity')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcity') }}"><i class="nav-icon fa fa-building"></i><span>{{ trans('world.city.titles') }}</span></a></li>
       @endcan
	</ul>
  </li>
@endif


<!-- Users, Roles, Permissions -->
@if (auth()->user()->hasAnyPermission(['list authuser','list authrole','list authpermission']))
 <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-user-plus"></i>{{ trans('common.menu.authentication') }}</a>
	<ul class="nav-dropdown-items">
	  @can('list authuser')
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon fa fa-user"></i><span>{{ trans('backpack::permissionmanager.users') }}</span></a></li>
      @endcan
      
	  @can('list authrole')
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon fa fa-group"></i><span>{{ trans('backpack::permissionmanager.roles') }}</span></a></li>
      @endcan

	  @can('list authpermission')
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon fa fa-key"></i><span>{{ trans('backpack::permissionmanager.permission_plural') }}</span></a></li>
      @endcan
	</ul>
 </li>
@endif

<!-- Backup Manager, Log Manager -->
@if (auth()->user()->hasAnyPermission(['list managerbackup','list managerlog','list managersetting', 'list managermigrate']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-wrench"></i>{{ trans('common.menu.manager') }}</a>
	<ul class="nav-dropdown-items">
	  @can('list managerbackup')
	   <li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon fa fa-hdd-o'></i>{{ trans('backpack::backup.backup') }}</a></li>
	  @endcan

      @can('list managerlog')
       <li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon fa fa-terminal'></i>Logs</a></li>
 	  @endcan 

 	  @can('list managersetting')
       <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon fa fa-cog'></i><span>{{ trans('backpack::settings.setting_plural') }}</span></a></li>
	  @endcan

      @can('list managermigrate')  
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('migration') }}'><i class='nav-icon fa fa-upload'></i>Migrations</a></li>
	  @endcan
	</ul>
  </li>
@endif

<li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i><span>{{ trans('backpack::crud.file_manager') }}</span></a></li>