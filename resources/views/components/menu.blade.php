<div class="brand-logo">
			<a href="index.html">
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
                @can("admin")
                <li>
    <a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow {{ isActiveRoute('dashboard') }}">
        <span class="micon dw dw-house-1"></span><span class="mtext">Accueil</span>
    </a>
</li>

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



<li>
<a href="{{ route('Admin.clients.index') }}" class="dropdown-toggle no-arrow {{ isActiveRoute('Admin.clients.index') }}">
        <span class="micon dw dw-apartment"></span><span class="mtext">Gestion Clients</span>
    </a>
        </li>

<li>
    <a href="{{ route('Admin.prestations.index') }}" class="dropdown-toggle no-arrow {{ isActiveRoute('Admin.prestations.index') }}">
        <span class="micon dw dw-apartment"></span><span class="mtext">Gestion Prestations</span>
    </a>
</li>

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
                Utilisateur & Roles
            </a>
        </li>
    </ul>
</li>

<!-- <li>
    <a href="{{ route('Admin.e-mails.index') }}" class="dropdown-toggle no-arrow {{ isActiveRoute('Admin.e-mails.index') }}">
        <span class="micon dw dw-paint-brush"></span><span class="mtext">Gestion Mail</span>
    </a>
</li> -->
<li>
    <a href="{{ route('Admin.subscriptions.index') }}" class="dropdown-toggle no-arrow {{ isActiveRoute('Admin.subscriptions.index') }}">
        <span class="micon dw dw-calendar1"></span><span class="mtext">Gestion Souscrption</span>
    </a>
</li>


                    @endcan
				</ul>
			</div>
		</div>