<div class="brand-logo">
			<a href="{{ route('dashboard') }}">
				<img src="{{asset('v2/vendors/images/deskapp-logo.svg')}}" alt="" class="dark-logo">
				<img src="{{asset('v2/vendors/images/deskapp-logo-white.svg')}}" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">

                <li>
    <a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow {{ isActiveRoute('dashboard') }}">
        <span class="micon dw dw-house-1"></span><span class="mtext">Accueil</span>
    </a>
</li>

@can("admin")

<li class="dropdown {{ isActiveRoute(['Admin.roles', 'Admin.utilisateurs']) ? 'menu-open' : '' }}">
    <a href="javascript:;" class="dropdown-toggle {{ isActiveRoute(['Admin.roles', 'Admin.utilisateurs']) }}">
        <span class="micon dw dw-user2"></span><span class="mtext">Gestion utilisateurs</span>
    </a>
    <ul class="submenu">
        <li>
            <a class="nav-link {{ isActiveRoute('Admin.roles.index') }}" href="{{ route('Admin.roles.index') }}">
                Roles
            </a>
        </li>
        <li><a href="#">Permissions</a></li>
        <li>
            <a class="nav-link {{ isActiveRoute('Admin.utilisateurs.index') }}" href="{{ route('Admin.utilisateurs.index') }}">
                Utilisateur & Roles
            </a>
        </li>
    </ul>
</li>

@endcan
@can("Gestionnaire des Clients")
<li>
<a href="{{ route('Admin.clients.index') }}" class="dropdown-toggle no-arrow {{ isActiveRoute('Admin.clients.index') }}">
        <span class="micon dw dw-apartment"></span><span class="mtext">Gestion Clients</span>
    </a>
        </li>


        @endcan

        @can("Gestionnaire des Prestations")
<li class="dropdown {{ isActiveRoute(['Admin.planifications', 'Admin.prestations', 'Admin.clotures']) ? 'menu-open' : '' }}">
    <a href="javascript:;" class="dropdown-toggle {{ isActiveRoute(['Admin.planifications', 'Admin.prestations', 'Admin.clotures']) }}">
        <span class="micon dw dw-user2"></span><span class="mtext">Gestion de Prestations</span>
    </a>
    <ul class="submenu">
        <li>
            <a class="nav-link {{ isActiveRoute('Admin.planifications.index') }}" href="{{ route('Admin.planifications.index') }}">
                Planifications
            </a>
        </li>
        <li><a class="nav-link {{ isActiveRoute('Admin.prestations.index') }}" href="{{ route('Admin.prestations.index') }}">Prestations</a></li>
        <li>
            <a class="nav-link {{ isActiveRoute('Admin.clotures.index') }}" href="{{ route('Admin.clotures.index') }}">
                Clotures
            </a>
        </li>
    </ul>
</li>

@endcan
@can("Gestionnaire des Souscriptions")
<li class="dropdown {{ isActiveRoute(['Admin.subscriptions', 'Admin.invoices']) ? 'menu-open' : '' }}">
    <a href="javascript:;" class="dropdown-toggle {{ isActiveRoute(['Admin.subscriptions', 'Admin.invoices']) }}">
        <span class="micon dw dw-calendar1"></span><span class="mtext">Gestions Abbonnements</span>
    </a>
    <ul class="submenu">
        <li>
            <a class="nav-link {{ isActiveRoute('Admin.subscriptions.index') }}" href="{{ route('Admin.subscriptions.index') }}">
                Souscriptions
            </a>
        </li>

        <li>
            <a class="nav-link {{ isActiveRoute('Admin.invoices.index') }}" href="{{ route('Admin.invoices.index') }}">
                Factures
            </a>
        </li>
    </ul>
</li>
                    @endcan
				</ul>
			</div>
		</div>