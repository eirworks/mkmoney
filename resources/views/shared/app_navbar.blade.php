<nav class="navbar navbar-dark navbar-expand-lg bg-primary mb-3 d-print-none">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand site-title">{{ setting('site_name', '') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('stores::index') }}" class="nav-link">Bisnisku</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @if(auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                <li class="nav-item">
                    <a href="{{ route('admin::dashboard') }}" class="nav-link">Admin</a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('profile::edit') }}" class="nav-link">Profil</a>
                </li>
                <li class="nav-item">
                    <button type="submit" class="btn btn-link nav-link" form="logout">Keluar</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<form id="logout" action="{{ route('auth::logout') }}" method="post" onsubmit="return confirm('Apa anda yakin ingin keluar?')">
    @csrf
</form>
