<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="nav-icon la la-dashboard"></i>{{ trans('backpack::base.dashboard') }}</a></li>


<!-- Contacts -->
@if (auth()->user()->hasAnyPermission(['list contactdata','list contactsetting']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-address-book"></i>{{ trans('common.menu.contact') }}</a>
	<ul class="nav-dropdown-items">
 	  @can('list contactdata')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact') }}'><i class='nav-icon la la-address-card'></i>{{ trans('contact.titles') }}</a></li>
	  @endcan

 	  @can('list contactsetting')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contenttype') }}'><i class='nav-icon la la-cogs'></i>Preferencias</a></li>	
	  @endcan
  	  @can('list contactdebug')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contactdata') }}'><i class='nav-icon la la-question'></i>ContactDatas
	  @endcan
		</a></li>	
	</ul>
  </li>
@endif

<!-- Blog: Posts, Comments, Categories, Tags -->
@if (auth()->user()->hasAnyPermission(['list blogpost','list blogcomment','list blogcategory','list blogtag']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-book"></i>{{ trans('common.menu.blog') }}</a>
	  <ul class="nav-dropdown-items">
	  @can('list blogpost')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('blogpost') }}'><i class='nav-icon la la-newspaper-o'></i><span>{{ trans('blog.post.titles') }}</span></a></li>
      @endcan

	  @can('list blogcomment')		
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('blogcomment') }}'><i class='nav-icon la la-comments'></i><span>{{ trans('blog.comment.titles') }}</span></a></li>
      @endcan

	  @can('list blogcategory')		
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('blogcategory') }}'><i class='nav-icon la la-list'></i><span>{{ trans('blog.category.titles') }}</span></a></li>
      @endcan

	  @can('list blogtag')		
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('blogtag') }}'><i class='nav-icon la la-tag'></i><span>{{ trans('blog.tag.titles') }}</span></a></li>
      @endcan
	</ul>
  </li>
@endif

<!-- World: Continents, Contries, Divisions, Cities -->
@if (auth()->user()->hasAnyPermission(['list worldcontinent','list worldcountry','list worlddivision','list worldcity']))
 <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-globe"></i>{{ trans('common.menu.world') }}</a>
	<ul class="nav-dropdown-items">
	  @can('list worldcontinent')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcontinent') }}"><i class="nav-icon la la-cloud"></i><span>{{ trans('world.continent.titles') }}</span></a></li>
       @endcan

       @can('list worldcountry')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcountry') }}"><i class="nav-icon la la-flag"></i><span>{{ trans('world.country.titles') }}</span></a></li>
        @endcan

        @can('list worlddivision')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worlddivision') }}"><i class="nav-icon la la-map-o"></i><span>{{ trans('world.division.titles') }}</span></a></li>
        @endcan

        @can('list worldcity')
	  	<li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcity') }}"><i class="nav-icon la la-building"></i><span>{{ trans('world.city.titles') }}</span></a></li>
       @endcan
	</ul>
  </li>
@endif


<!-- Users, Roles, Permissions -->
@if (auth()->user()->hasAnyPermission(['list authuser','list authrole','list authpermission']))
 <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-user-plus"></i>{{ trans('common.menu.authentication') }}</a>
	<ul class="nav-dropdown-items">
	  @can('list authuser')
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i><span>{{ trans('backpack::permissionmanager.users') }}</span></a></li>
      @endcan
      
	  @can('list authrole')
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-group"></i><span>{{ trans('backpack::permissionmanager.roles') }}</span></a></li>
      @endcan

	  @can('list authpermission')
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i><span>{{ trans('backpack::permissionmanager.permission_plural') }}</span></a></li>
      @endcan
	</ul>
 </li>
@endif


<!-- Reportes -->
@if (auth()->user()->hasAnyPermission(['list managerlog', 'list managermigrate']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-file-text-o"></i>{{ trans('common.menu.report') }}</a>
	<ul class="nav-dropdown-items">

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('authchecker') }}'><i class='nav-icon la la-sign-in'></i><span>{{ trans('report.authchecker.titles') }}</span></a></li>

      @can('list managerlog')
		<li class='nav-item'><a class='nav-link' href='{{route("log-viewer::logs.list")}}'><i class='nav-icon la la-history'></i>{{ trans('report.logs.titles')}}</a></li>
 	  @endcan 

      @can('list managermigrate')  
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('migration') }}'><i class='nav-icon la la-upload'></i><span>{{ trans('report.migration.titles') }}</span></a></li>
	  @endcan
	</ul>
  </li>
@endif

<!-- Backup Manager, Log Manager -->
@if (auth()->user()->hasAnyPermission(['list managerbackup','list managerlog','list managersetting', 'list managermigrate']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-wrench"></i>{{ trans('common.menu.manager') }}</a>
	<ul class="nav-dropdown-items">
	  @can('list managerbackup')
	   <li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon la la-hdd-o'></i>{{ trans('backpack::backup.backup') }}</a></li>
	  @endcan

 	  @can('list managersetting')
       <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i><span>{{ trans('backpack::settings.setting_plural') }}</span></a></li>
	  @endcan

	</ul>
  </li>
@endif

<li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i><span>{{ trans('backpack::crud.file_manager') }}</span></a></li>


<li class='nav-item'><a class='nav-link' href='{{ backpack_url('notification') }}'><i class='nav-icon la la-comment-o'></i> Notifications</a></li>