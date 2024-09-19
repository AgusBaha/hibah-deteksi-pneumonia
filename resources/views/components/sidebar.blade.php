<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-text mx-3">Deteksi Kanker</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pneumonia</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Route::is('gejala.*') ? 'active' : '' }}"
                    href="{{ route('gejala.index') }}">Gejala</a>
                <a class="collapse-item {{ Route::is('basiskasus.*') ? 'active' : '' }}"
                    href="{{ route('basiskasus.index') }}">Basis Kasus</a>
            </div>
        </div>
    </li> --}}
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kanker</span>
        </a>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Route::is('categories.*') ? 'active' : '' }}"
                    href="{{ route('categories.index') }}">Categories</a>
                <a class="collapse-item {{ Route::is('main-questions.*') ? 'active' : '' }}"
                    href="{{ route('main-questions.index') }}">Main Questions</a>
                <a class="collapse-item {{ Route::is('specific-questions.*') ? 'active' : '' }}"
                    href="{{ route('specific-questions.index') }}">Specific Questions</a>
            </div>
        </div>
    </li>

</ul>