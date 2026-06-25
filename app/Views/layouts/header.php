
<?php
$role = session()->get('role');

if ($role === 'admin') {
    $name = session()->get('admin_name');
} elseif ($role === 'staff') {
    $name = session()->get('staff_name');
} else {
    $name = 'User';
}

$initials = '';

if (!empty($name)) {

    $parts = explode(' ', trim($name));

    $initials = strtoupper(
        substr($parts[0], 0, 1) .
            (isset($parts[1]) ? substr($parts[1], 0, 1) : '')
    );
}
?>

<style>
    .header-wrapper {
        width: 100%;
    }

    .app-header {
        height: 60px;
        background: #ffffff;
        border-radius: 14px;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-icon {
        font-size: 18px;
        color: #6b7280;
        cursor: pointer;
    }

    .header-icon:hover {
        color: #111827;
    }

    .user-box {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        text-decoration: none;
    }

    .avatar {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
        color: #fff;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .username {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        min-width: 220px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
    }

    .user-info-card {
        text-align: center;
        padding: 15px;
    }

    .user-info-card .avatar {
        width: 55px;
        height: 55px;
        margin: auto;
        font-size: 18px;
    }

    .system-badge {
        background: #10b981;
        color: white;
        padding: 8px 15px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
    }

    @media(max-width:768px) {

        .username {
            display: none;
        }

        .system-badge {
            display: none;
        }

    }
</style>

<div class="header-wrapper">

    <nav class="app-header">

        <!-- LEFT -->

        <div class="header-left">

            <a href="#" data-lte-toggle="sidebar">
                <i class="bi bi-list fs-4 text-dark"></i>
            </a>

            <div>
                <h5 class="mb-0 fw-bold text-primary">
                    MLoad - Machine Loading System
                </h5>
            </div>

        </div>

        <!-- RIGHT -->

        <div class="header-right">

            <div class="system-badge">
                <i class="fas fa-circle me-1"></i>
                System Online
            </div>

            <a href="#" data-lte-toggle="fullscreen">
                <i class="bi bi-arrows-fullscreen header-icon"></i>
            </a>

            <div class="dropdown">

                <a href="#"
                    class="user-box"
                    data-bs-toggle="dropdown">

                    <span class="username">
                        <?= esc($name) ?>
                    </span>

                    <div class="avatar">
                        <?= esc($initials) ?>
                    </div>

                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <div class="user-info-card">

                            <div class="avatar mb-2">
                                <?= esc($initials) ?>
                            </div>

                            <h6 class="mb-0">
                                <?= esc($name) ?>
                            </h6>

                            <small class="text-muted">
                                <?= ucfirst($role) ?>
                            </small>

                        </div>

                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="px-3 mb-2">

                        <a href="<?= base_url('profile') ?>"
                            class="btn btn-outline-primary w-100">

                            <i class="fas fa-user me-1"></i>
                            Profile

                        </a>

                    </li>

                    <li class="px-3 mb-2">

                        <a href="<?= base_url('logout') ?>"
                            class="btn btn-danger w-100">

                            <i class="fas fa-right-from-bracket me-1"></i>
                            Logout

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

</div>