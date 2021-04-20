<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="nav-icon la la-dashboard"></i>{{ trans('backpack::base.dashboard') }}</a></li>


<!-- Contacts -->
@if (auth()->user()->hasAnyPermission(['contactperson.list', 'contactfamily.list', 'contactchurch.list','contactsetting.list']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-address-book"></i>{{ trans('common.menu.contact') }}</a>
	<ul class="nav-dropdown-items">

 	  @can('contactperson.list')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contactperson') }}'><i class='nav-icon la la-id-card'></i>{{ trans('contact.person.entity_names') }}</a></li>
	  @endcan

 	  @can('contactfamily.list')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contactfamily') }}'><i class='nav-icon la la-users'></i>{{ trans('contact.family.entity_names') }}</a></li>
	  @endcan

 	  @can('contactchurch.list')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contactchurch') }}'><i class='nav-icon la la-cross'></i>{{ trans('contact.church.entity_names') }}</a></li>
	  @endcan

 	  @can('contactsetting.list')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contenttype') }}'><i class='nav-icon la la-cogs'></i>{{ trans('contact.type.entity_names') }}</a></li>	
	  @endcan

  	  @can('contactdata.list')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contactdata') }}'><i class='nav-icon la la-question'></i>Contact Data</a></li>	
	  @endcan
	</ul>
  </li>
@endif

<!-- Blog: Posts, Comments, Categories, Tags -->
@if (auth()->user()->hasAnyPermission(['blogpost.list','blogcomment.list','blogcategory.list','blogtag.list']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-book"></i>{{ trans('common.menu.blog') }}</a>
	  <ul class="nav-dropdown-items">

	  @can('blogpost.list')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('blogpost') }}'><i class='nav-icon la la-newspaper-o'></i><span>{{ trans('blog.post.entity_names') }}</span></a></li>
      @endcan

	  @can('blogcomment.list')		
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('blogcomment') }}'><i class='nav-icon la la-comments'></i><span>{{ trans('blog.comment.entity_names') }}</span></a></li>
      @endcan

	  @can('blogcategory.list')		
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('blogcategory') }}'><i class='nav-icon la la-list'></i><span>{{ trans('blog.category.entity_names') }}</span></a></li>
      @endcan

	  @can('blogtag.list')		
		 <li class='nav-item'><a class='nav-link' href='{{ backpack_url('blogtag') }}'><i class='nav-icon la la-tag'></i><span>{{ trans('blog.tag.entity_names') }}</span></a></li>
      @endcan
	</ul>
  </li>
@endif

<!-- World: Continents, Contries, Divisions, Cities -->
@if (auth()->user()->hasAnyPermission(['worldcontinent.list','worldcountry.list','worlddivision.list','worldcity.list']))
 <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-globe"></i>{{ trans('common.menu.world') }}</a>
	<ul class="nav-dropdown-items">

	  @can('worldcontinent.list')
	  	   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcontinent') }}"><i class="nav-icon la la-cloud"></i><span>{{ trans('world.continent.titles') }}</span></a></li>
       @endcan

       @can('worldcountry.list')
	  	   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcountry') }}"><i class="nav-icon la la-flag"></i><span>{{ trans('world.country.titles') }}</span></a></li>
        @endcan

        @can('worlddivision.list')
	  	   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('worlddivision') }}"><i class="nav-icon la la-map-o"></i><span>{{ trans('world.division.titles') }}</span></a></li>
        @endcan

        @can('worldcity.list')
	  	   <li class="nav-item"><a class="nav-link" href="{{ backpack_url('worldcity') }}"><i class="nav-icon la la-building"></i><span>{{ trans('world.city.titles') }}</span></a></li>
       @endcan
	</ul>
  </li>
@endif


<!-- Users, Roles, Permissions -->
@if (auth()->user()->hasAnyPermission(['authuser.list','authrole.list','authpermission.list']))
 <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-user-plus"></i>{{ trans('common.menu.authentication') }}</a>
	<ul class="nav-dropdown-items">

	  @can('authuser.list')
	     <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i><span>{{ trans('backpack::permissionmanager.users') }}</span></a></li>
      @endcan
      
	  @can('authrole.list')
	     <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-users-cog"></i><span>{{ trans('backpack::permissionmanager.roles') }}</span></a></li>
      @endcan

	  @can('authpermission.list')
	      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i><span>{{ trans('backpack::permissionmanager.permission_plural') }}</span></a></li>
      @endcan
	</ul>
 </li>
@endif


<!-- Reportes -->
@if (auth()->user()->hasAnyPermission(['managerlog.list', 'managermigrate.list']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-file-text-o"></i>{{ trans('common.menu.report') }}</a>
	<ul class="nav-dropdown-items">

		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('authchecker') }}'><i class='nav-icon la la-sign-in'></i><span>{{ trans('report.authchecker.titles') }}</span></a></li>

	  @can('managerlog.list')
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-history'></i>{{ trans('report.logs.titles') }}</a></li>
	  @endcan

      @can('managermigrate.list')  
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('migration') }}'><i class='nav-icon la la-upload'></i><span>{{ trans('report.migration.titles') }}</span></a></li>
	  @endcan
	</ul>
  </li>
@endif

<!-- Backup Manager, Log Manager -->
@if (auth()->user()->hasAnyPermission(['managerbackup.list','managersetting.list', 'managermigrate.list']))
  <li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-wrench"></i>{{ trans('common.menu.manager') }}</a>
	<ul class="nav-dropdown-items">


	  @can('managerbackup.list')
	   <li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon la la-hdd-o'></i>{{ trans('backpack::backup.backup') }}</a></li>
	   <li class='nav-item'><a class='nav-link' href='{{ backpack_url('backuprestore') }}'><i class='nav-icon la la-hdd-o'></i>{{ trans('backup.backup') }}</a></li>
	  @endcan

	  @can('managerfile.list')
		<li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i><span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
	  @endcan

 	  @can('managersetting.list')
       <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i><span>{{ trans('backpack::settings.setting_plural') }}</span></a></li>
	  @endcan

	</ul>
  </li>
@endif


@can('blognotification.list')
	<li class='nav-item'><a class='nav-link' href='{{ backpack_url('notification') }}'><i class='nav-icon la la-comment-o'></i><span>{{ trans('blog.notification.entity_names') }}</span></a></li>
@endcan

<!--		<li class='nav-item'><a class='nav-link' href=' 
  route("log-viewer::logs.list")}}'><i class='nav-icon la la-history'></i>
-->
<!--  trans('report.logs.titles')}}</a></li> 
-->

