 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
     </ul>
     <ul class="navbar-nav ml-auto">
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <img src="<?php echo base_url('assets/back') ?><?= $this->session->avatar; ?>" class="img-circle img-size-32 elevation-2">
             </a>
             <div class="dropdown-menu dropdown-menu-md dropdown-menu-right text-sm">
                 <a href="#" class="dropdown-item text-sm">
                     <div class="media">
                         <img src="<?php echo base_url('assets/back') ?><?= $this->session->avatar; ?>" alt="User Avatar" class="img-size-32 mr-3 img-circle elevation-2">
                         <div class="media-body">
                             <h4 class="dropdown-item-title text-sm">
                                 <?= $this->session->fullname; ?>
                             </h4>
                             <!-- <p class="dropdown-item-title text-sm"><?= $this->session->fullname; ?></p> -->
                             <p class="text-sm text-muted"><?= $this->session->email; ?></p>
                         </div>
                     </div>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item text-sm">
                     Dashboard
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item text-sm">
                     Account Settings
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item text-sm">
                     Logout
                 </a>
             </div>
         </li>
     </ul>
 </nav>