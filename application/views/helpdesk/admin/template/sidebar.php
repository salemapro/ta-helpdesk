<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>assets/back/dist/img/insaba.png" alt="Helpdesk Logo" class="brand-image" style="opacity: 1">
        <span class="brand-text font-weight-normal">Helpdesk IT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>assets/back/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">GENERAL</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/dashboard/admin') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'helpdesk/dashboard') echo 'active' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/ticket/admin') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'helpdesk/ticket') echo 'active' ?>">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Tickets
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/report/report_admin') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'helpdesk/report') echo 'active' ?>">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Report
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <hr>
                <li class="nav-header">ADMINISTRATION</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/subject/subject') ?>" class="nav-link">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Subject
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/client/company') ?>" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Company
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/divisi/divisi') ?>" class="nav-link">
                        <i class="nav-icon fas fa-landmark"></i>
                        <p>
                            Divisi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/client/application') ?>" class="nav-link">
                        <i class="nav-icon fas fa-window-maximize"></i>
                        <p>
                            Application
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/user/user') ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/user/user_roles') ?>" class="nav-link">
                        <i class="nav-icon far fa-id-card"></i>
                        <p>
                            User Roles
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>