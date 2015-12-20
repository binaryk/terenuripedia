<header role="banner">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">{{ trans('front/site.title') }}</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li {!! classActivePath('/') !!}>
                        {!! link_to('/terrain', trans('front/site.home')) !!}
                    </li>
                    @if(session('statut') == 'visitor' || session('statut') == 'user')
                    @endif
                    @if(Request::is('auth/register'))
                        <li class="active">
                            {!! link_to('auth/register', trans('front/site.register')) !!}
                        </li>
                    @elseif(Request::is('password/email'))
                        <li class="active">
                            {!! link_to('password/email', trans('front/site.forget-password')) !!}
                        </li>
                    @else
                        @if(session('statut') == 'visitor')
                            <li {!! classActivePath('auth/login') !!}>
                                {!! link_to('auth/login', trans('front/site.connection')) !!}
                            </li>
                        @else
                            @if(session('statut') == 'admin')
                                <li>
                                    {!! link_to_route('admin', trans('front/site.administration')) !!}
                                </li>
                            @elseif(session('statut') == 'redac')
                                <li>
                                    {!! link_to('blog', trans('front/site.redaction')) !!}
                                </li>
                            @endif
                            <li>
                                {!! link_to('auth/logout', trans('front/site.logout')) !!}
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav> 
</header>