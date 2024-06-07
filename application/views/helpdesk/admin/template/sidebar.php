<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url() ?>assets/back/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
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
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-header">GENERAL</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/dashboard/admin') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/ticket/admin') ?>" class="nav-link">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Tickets
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/subject/subject') ?>" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Subject
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/auth/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Logout
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-header">EMPLOYEE</li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Master Employee
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('helpdesk/employee/employee') ?>" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Employee
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('helpdesk/divisi/divisi') ?>" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Divisi
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">CLIENT</li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Master Client
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('helpdesk/client/client') ?>" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Client
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('helpdesk/client/company') ?>" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Company
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('helpdesk/client/application') ?>" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Application
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">ADMINISTRATION</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/user/user') ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('helpdesk/user/user_roles') ?>" class="nav-link">
                        <i class="nav-icon far fa-id-card"></i>
                        <p>
                            User roles
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li> -->
            </ul>
        </nav>
    </div>
</aside>