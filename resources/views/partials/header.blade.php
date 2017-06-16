<div id="header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('welcome') }}"><span class="logo-1">tech</span><span class="logo-2">'</span><span class="logo-3">IT</span> <span class="logo-4">easy</span></a>
            </div>
            
                @if(Auth::check())
                    <div class="collapse navbar-collapse navbar-right">
                        <a href="{{ route('dashboard') }}"class="btn btn-default navbar-btn"><span>{{ Auth::user()->login }}</span> <i class="fa fa-unlock-alt"></i></a>
                        <a href="{{ url('auth/logout') }}"class="btn btn-default navbar-btn "><i class="fa fa-power-off" title="Déconnection"></i></a>
                    </div>
                @else
                    <div class="collapse navbar-collapse navbar-right">
                        <a href="{{ route('login') }}"class="btn btn-default navbar-btn"><span>Admin</span> <i class="fa fa-lock"></i></a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>