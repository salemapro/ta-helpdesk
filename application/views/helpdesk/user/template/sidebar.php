<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>assets/back/dist/img/insaba.png" alt="Helpdesk Logo" class="brand-image" style="opacity: 1">
        <span class="brand-text font-weight-normal">Helpdesk IT</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">GENERAL</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/ticket/user') ?>" class="nav-link">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Tickets
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/report/report_user') ?>" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Report
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>