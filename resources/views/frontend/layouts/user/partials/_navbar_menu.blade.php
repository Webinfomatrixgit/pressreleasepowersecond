<div class="collapse navbar-collapse" id="navbar-menu">
    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
        <ul class="navbar-nav">
            <li class="nav-item {{ isActive('user.dashboard') }}">
                <a class="nav-link" href="{{ route('user.dashboard') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <x-svg i="dashboard-2"/>
                    </span>
                    <span class="nav-link-title">
                      {{ __('Dashboard') }}
                    </span>
                </a>
            </li>
            <li class="nav-item {{ isActive('user.deposit.create') }}">
                <a class="nav-link" href="{{ route('user.deposit.create') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <x-svg i="deposit" />
                    </span>
                    <span class="nav-link-title">
                      {{ __('Deposit') }}
                    </span>
                </a>
            </li>
            <li class="nav-item {{ isActive('user.service.my') }}">
                <a class="nav-link" href="{{ route('user.service.my') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block me-2">
                      <x-svg i="service-1" height="20" width="20" />
                    </span>
                    <span class="nav-link-title">
                      {{ __('My Services') }}
                    </span> 
                </a>
            </li>
            <li class="nav-item {{ isActive('user.transaction') }}">
                <a class="nav-link" href="{{ route('user.transaction') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <x-svg i="wall" height="20" width="20"/>
                    </span>
                    <span class="nav-link-title">
                      {{ __('Transaction') }}
                    </span>
                </a>
            </li>
            <li class="nav-item {{ isActive('user.support-ticket.index') }}">
                <a class="nav-link" href="{{ route('user.support-ticket.index') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <x-svg i="message" height="20" width="20"/>
                    </span>
                    <span class="nav-link-title">
                      {{ __('Support Ticket') }}
                    </span>
                </a>
            </li>
            <li class="nav-item {{ isActive('user.article') }}">
                <a class="nav-link" href="{{ route('user.article') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <x-svg i="message" height="20" width="20"/>
                    </span>
                    <span class="nav-link-title">
                      {{ __('PR') }}
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
