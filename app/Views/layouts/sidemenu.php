
<?php if (session()->get('role') == 'admin'): ?>

    <ul class="nav nav-pills nav-sidebar flex-column">

        <!-- Dashboard -->

        <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>"
                class="nav-link <?= service('uri')->getSegment(1) == 'dashboard' ? 'active' : '' ?>">

                <i class="nav-icon fas fa-gauge-high"></i>

                <p>Dashboard</p>

            </a>
        </li>

        <!-- Master Data -->

        <li class="nav-header text-uppercase mt-3 mb-2 text-secondary">
            Masters
        </li>

        <li class="nav-item">

            <a href="<?= base_url('machine') ?>"
                class="nav-link <?= service('uri')->getSegment(1) == 'machine' ? 'active' : '' ?>">

                <i class="nav-icon fas fa-gears"></i>

                <p>Machine Master</p>

            </a>

        </li>

        <!-- Transactions -->

        <li class="nav-header text-uppercase mt-3 mb-2 text-secondary">
            Transactions
        </li>

        <li class="nav-item">

            <a href="<?= base_url('order') ?>"
                class="nav-link <?= service('uri')->getSegment(1) == 'order' ? 'active' : '' ?>">

                <i class="nav-icon fas fa-file-lines"></i>

                <p>Order Entry</p>

            </a>

        </li>

        <li class="nav-item">

            <a href="<?= base_url('loading') ?>"
                class="nav-link <?= service('uri')->getSegment(1) == 'loading' ? 'active' : '' ?>">

                <i class="nav-icon fas fa-industry"></i>

                <p>Machine Loading</p>

            </a>

        </li>

        <!-- Reports -->

        <li class="nav-header text-uppercase mt-3 mb-2 text-secondary">
            Reports
        </li>

        <li class="nav-item">

            <a href="<?= base_url('reports') ?>"
                class="nav-link <?= service('uri')->getSegment(1) == 'reports' ? 'active' : '' ?>">

                <i class="nav-icon fas fa-chart-column"></i>

                <p>Production Reports</p>

            </a>

        </li>

        <!-- Settings -->

        <li class="nav-header text-uppercase mt-3 mb-2 text-secondary">
            System
        </li>

        <li class="nav-item">

            <a href="<?= base_url('users') ?>"
                class="nav-link <?= service('uri')->getSegment(1) == 'users' ? 'active' : '' ?>">

                <i class="nav-icon fas fa-users"></i>

                <p>Users</p>

            </a>

        </li>

    </ul>

<?php endif; ?>
