<header class="header">
    <div class="header-left">
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
        <h1>Beranda</h1>
    </div>
    <div class="header-right">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari...">
        </div>
        <div class="user-profile">
            <div class="notification">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </div>
            <div class="user-avatar">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff" alt="Admin User">
                <div class="dropdown">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>