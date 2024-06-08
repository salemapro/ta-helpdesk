 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
     </ul>
     <ul class="navbar-nav ml-auto">
         <!-- <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">15</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new messages
                     <span class="float-right text-muted text-sm">3 mins</span>
                 </a>
             </div>
         </li> -->
         <li class="nav-item dropdown user-menu">
             <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                 <img src="<?php echo base_url('assets/back') ?><?= $this->session->avatar; ?>" class="user-image img-circle elevation-1" alt="User Image">
                 <!-- <span class="d-none d-md-inline">Alexander Pierce</span> -->
             </a>
             <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <!-- <a href="#" class="dropdown-item text-sm">
                     <div class="media">
                         <img src="<?php echo base_url('assets/back') ?><?= $this->session->avatar; ?>" alt="User Avatar" class="img-size-32 mt-1 mr-3 img-circle">
                         <div class="media-body">
                             <h4 class="dropdown-item-title text-sm">
                                 <?= $this->session->fullname; ?>
                             </h4>
                             <p class="text-sm text-muted"><?= $this->session->email; ?></p>
                         </div>
                     </div>
                 </a> -->
                 <a href="#" class="dropdown-item text-sm">
                     <div class="media align-items-center">
                         <div class="avatar-wrapper2">
                             <img src="<?php echo base_url('assets/back') ?><?= $this->session->avatar; ?>" alt="User Avatar" class="img-size-32 img-circle">
                         </div>
                         <div class="media-body ml-3">
                             <h4 class="dropdown-item-title text-sm mb-0">
                                 <?= $this->session->fullname; ?>
                             </h4>
                             <p class="text-sm text-muted mb-0"><?= $this->session->email; ?></p>
                         </div>
                     </div>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="<?php echo base_url('helpdesk/dashboard/admin') ?>" class="dropdown-item text-sm">
                     Dashboard
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="<?php echo base_url('helpdesk/user/account_admin') ?>" class="dropdown-item text-sm">
                     Account Settings
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="<?php echo base_url('helpdesk/auth/logout') ?>" class="dropdown-item text-sm">
                     Logout
                 </a>
             </ul>
         </li>
     </ul>
 </nav>