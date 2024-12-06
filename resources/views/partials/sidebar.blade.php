<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-heartbeat"></i>
        </div>
        <div class="sidebar-brand-text mx-3">THE GUARDIAN</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Votre Santé</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Suivi et Historique</div>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('consultations.index') }}">
        <i class="fas fa-fw fa-calendar-check"></i>
        <span>Historique des Consultations</span>
    </a>
</li>


<li class="nav-item">
    <a class="nav-link" href="{{ route('prescriptions.index') }}">
        <i class="fas fa-fw fa-calendar-check"></i>
        <span>Traitement</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('diagnosis.form') }}">
        <i class="fas fa-fw fa-calendar-check"></i>
        <span>Faire un Diagnostic</span>
    </a>
</li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Objectifs et Activités</div>

    <!-- Nav Item - Objectifs Personnels -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('goals.dashboard') }}">
        <i class="fas fa-fw fa-bullseye"></i>
        <span>Objectifs Personnels</span>
    </a>
</li>

<!-- Nav Item - Activité Physique -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('activities.dashboard') }}">
        <i class="fas fa-fw fa-running"></i>
        <span>Activité Physique</span>
    </a>
</li>

<!-- Nav Item - Sommeil -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('sleep.dashboard') }}">
        <i class="fas fa-fw fa-bed"></i>
        <span>Suivi du Sommeil</span>
    </a>
</li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Paramètres et Conseils</div>

    

    <!-- Nav Item - Paramètres du Profil -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Paramètres du Profil</span>
        </a>
    </li>

    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
