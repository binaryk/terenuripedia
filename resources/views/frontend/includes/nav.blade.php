    <nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="">{{ app_name() }}</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>{!! link_to('/', trans('navs.home')) !!}</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
                    <li><a href="#" class="animate-link">Prezentare</a></li>
                    <li><a href="#">Povestea site-ului</a></li>
					@role('Saller')
                    <li><a href="#">Abonamente</a></li>
					@endauth
					@role('Buyer')
                    <li><a href="{!! route('buyer.search') !!}">Terenuri</a></li>
					@endauth
					@if (Auth::guest())
						<li>{!! link_to('auth/login', trans('navs.login')) !!}</li>
						<li>{!! link_to('auth/pre-register', trans('navs.register')) !!}</li>
					@else
                        @role('Saller')
                        <li>{!! link_to('terrain', trans('navs.terrain_add')) !!}</li>
                        @endauth
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
							    <li>{!! link_to('dashboard', trans('navs.dashboard')) !!}</li>
                                <li><a href="{!!route('frontend.profile.fonds.index')!!}">{{ trans('labels.fonds') }}</a></li>

							    @permission('view-backend')
							        <li>{!! link_to_route('admin.dashboard', trans('navs.administration')) !!}</li>
							    @endauth

								<li>{!! link_to('auth/logout', trans('navs.logout')) !!}</li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
