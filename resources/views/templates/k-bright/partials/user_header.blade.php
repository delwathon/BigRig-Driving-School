<header class="header">
    <div class="container">
        <nav class="navbar position-relative navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{route('home')}}"><figure class="mb-0"><img style="width: 233px; height:57px; object-fit:cover"  src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="" class="img-fluid"></figure></a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" 
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li class=" nav-item {{ request()->routeIs('user.home') ? 'active' : '' }}"><a href="{{ route('user.home') }}">@lang('Dashboard')</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> @lang('Fund Account') </a>
                        <div class="dropdown-menu drop-down-content">
                            <ul class="list-unstyled drop-down-pages">
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('user.deposit.index') }}">@lang('Deposit')</a></li>
                                <li class="nav-item"><a class="dropdown-item nav-link"  href="{{ route('user.deposit.history') }}">@lang('Deposit Log')</a></li>
                              
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> @lang('Transaction Report') </a>
                        <div class="dropdown-menu drop-down-content">
                            <ul class="list-unstyled drop-down-pages">
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('user.commission.log') }}">@lang('Commission Log')</a></li>
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('user.transactions') }}">@lang('Transactions')</a></li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item" ><a class="nav-link" href="{{ route('user.referrals') }}">@lang('Referrals')</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> @lang('Support')</a>
                        <div class="dropdown-menu drop-down-content">
                            <ul class="list-unstyled drop-down-pages">
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('ticket.open') }}">@lang('Open New Ticket')</a></li>
                                <li class="nav-item"><a class="dropdown-item nav-link" href="{{ route('ticket.index') }}">@lang('My Tickets')</a></li>

                        
                              
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> @lang('Account')</a>
                        <div class="dropdown-menu drop-down-content">
                            <ul class="list-unstyled drop-down-pages">
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('user.profile.setting') }}">@lang('Profile Setting')</a></li>
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('user.change.password') }}">@lang('Change Password')</a></li>
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('user.change.pin') }}">@lang('Change PIN')</a></li>
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('user.twofactor') }}">@lang('2FA Security')</a></li>
                              
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> @lang('Products')</a>
                        <div class="dropdown-menu drop-down-content">
                            @php
                                        $services                     = App\Models\Service::active()->get();

                            @endphp
                            <ul class="list-unstyled drop-down-pages">
                                @foreach ($services as $item)
                                <li class="nav-item"><a  class="dropdown-item nav-link" href="{{ route('user.play.game', $item->alias) }}">{{ __(@$item->name) }}</a></li>

                                @endforeach
                                
                              
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link signup {{ request()->routeIs('user.logout') ? 'active' : '' }}" href="{{ route('user.logout') }}"><i class="las la-sign-out-alt"></i> @lang('Logout')</a>

                   </li>
                    
                </ul>
            </div>
        </nav>
    </div>
</header>

