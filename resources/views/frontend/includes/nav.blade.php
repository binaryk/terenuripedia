<nav class="navbar navbar-default">
		<div id="navigare" class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="{!! url('/') !!}"><div class="navbar-logo"><!--{!! HTML::image('/img/logo.png', 'a picture') !!}--></div></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
                    <li><a href="{!! route('about') !!}" class="animate-link">Despre</a></li>
                    <li><a href="{!! route('howWork') !!}" class="animate-link">Cum functioneaza</a></li>
					@role('Buyer')
                    <li><a href="{!! route('buyer.search') !!}">Terenuri</a></li>
					@endauth
					@if (Auth::guest())
						<li>{!! link_to('auth/login', trans('navs.login')) !!}</li>
					@else
                        @role('Saller')
                        <li>{!! link_to('terenuri', trans('navs.terrain_add')) !!}</li>
                        @endauth
                        <span class="badge" title="Credit" ng-click="mc.creditfn()" style="position:absolute; top: 5px; right: 0px;z-index: 9999;cursor: pointer;">@{{mc.credit}}R</span>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">

                                <li>{!! link_to('dashboard', trans('navs.dashboard')) !!}</li>

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
