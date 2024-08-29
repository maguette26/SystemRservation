<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand navbar-brand-custom" href="{{ route('admin.dashbord') }}">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">Événements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reservations') }}">Réservations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.utilisateurs') }}">Utilisateurs</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Déconnexion</button>
                </form>
        </ul>
    </div>
</nav>
