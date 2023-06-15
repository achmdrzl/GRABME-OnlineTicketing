<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.index') }}" class="sidebar-brand">
            GrabMe.<span>co</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Events</li>
            <li class="nav-item">
                <a href="{{ route('event.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Events Data</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">History Events</span>
                </a>
            </li>
            <li class="nav-item nav-category">Transaction</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#icons" role="button" aria-expanded="false"
                    aria-controls="icons">
                    <i class="link-icon" data-feather="smile"></i>
                    <span class="link-title">Data Transaction</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="icons">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('transaction.index') }}" class="nav-link">Transaction</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.event') }}" class="nav-link">Event Transaction</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Components</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" role="button" aria-expanded="false"
                    aria-controls="general-pages">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Data Master</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="general-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">Data User</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Data Partner</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
