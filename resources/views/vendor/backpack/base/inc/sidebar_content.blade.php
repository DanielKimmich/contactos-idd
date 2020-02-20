<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i>{{ trans('backpack::base.dashboard') }}</a></li>



<!-- Contactos -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-address-book"></i> Contactos</a>
	<ul class="nav-dropdown-items">
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact') }}'><i class='nav-icon fa fa-id-card-o'></i>Datos de Contactos</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contenttype') }}'><i class='nav-icon fa fa-cogs'></i>Preferencias</a></li>	
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contactdata') }}'><i class='nav-icon fa fa-question'></i>ContactDatas</a></li>	
	</ul>
</li>


<!-- Continents, Contries, Divisions, Cities -->
@if (auth()->user()->hasAnyPermission(['list worldcontinent','list worldcountry','list worlddivision','list worldcity']))
 <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-globe"></i>World</a>
	<ul class="nav-dropdown-items">
	  @can('list worldcontinent')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcontinent') }}"><i class="nav-icon fa fa-cloud"></i><span>{{ trans('world.continents') }}</span></a></li>
       @endcan

       @can('list worldcountry')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcountry') }}"><i class="nav-icon fa fa-flag"></i><span>{{ trans('world.countries') }}</span></a></li>
        @endcan

        @can('list worlddivision')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worlddivision') }}"><i class="nav-icon fa fa-map-o"></i><span>{{ trans('world.divisions') }}</span></a></li>
        @endcan

        @can('list worldcity')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcity') }}"><i class="nav-icon fa fa-building"></i><span>{{ trans('world.cities') }}</span></a></li>
       @endcan
	</ul>
  </li>
@endif


<!-- Users, Roles, Permissions -->
@if (auth()->user()->hasAnyPermission(['list authuser','list authrole','list authpermission']))
 <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-user-plus"></i>Authentication</a>
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
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-wrench"></i> Manager</a>
	<ul class="nav-dropdown-items">
	   <li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon fa fa-hdd-o'></i>Backups</a></li>
       <li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon fa fa-terminal'></i>Logs</a></li>
       <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon fa fa-cog'></i><span>Settings</span></a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('migration') }}'><i class='nav-icon fa fa-upload'></i>Migrations</a></li>
	</ul>
</li>


<li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i><span>{{ trans('backpack::crud.file_manager') }}</span></a></li>