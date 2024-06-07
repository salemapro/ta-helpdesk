<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4 mt-4">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bolder">Account Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol> -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-4">
                                    <h5 class="font-weight-normal"> Personal Information </h5>
                                    <p class="font-weight-normal text-black-50  text-sm"> This information will be displayed publicly so be careful what you share.</p>
                                </div>
                                <div class="col-8 text-dark text-sm">
                                    <form class="form-horizontal" class="formSimpanTicket" id="formSimpanTicket" role="form" method="post" action="#" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="fullname" class="font-weight-normal">Full Name</label>
                                            <input type="text" name="fullname" id="fullname" value="" class="form-control">
                                            <!-- <input type="text" readonly name="sender_id" value="<?= $this->session->id_user ?>" class="form-control"> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="font-weight-normal">Email</label>
                                            <input type="text" name="email" id="email" value="" class="form-control">
                                            <!-- <input type="text" readonly name="sender_id" value="<?= $this->session->id_user ?>" class="form-control"> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="img_ticket" class="font-weight-normal">Avatar</label>
                                            <!-- <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="img_ticket" id="img_ticket" class="custom-file-input" required>
                                                    <label class="custom-file-label" for="img_ticket">Choose file</label>
                                                </div>
                                            </div> -->
                                            <!-- <div class="media">
                                                <img src="<?php echo base_url('assets/back') ?><?= $this->session->avatar; ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                                <div class="media-body">
                                                    p
                                                </div>
                                            </div> -->
                                            <div class="user-menu">
                                                <img src="<?php echo base_url('assets/back') ?><?= $this->session->avatar; ?>" class="user-image img-circle img-size-50" alt="User Image">
                                                <!-- <span class="d-none d-md-inline ">Alexander Pierce</span> -->
                                                <div class="d-none d-md-inline ml-3">
                                                    <button class="btn btn-outline-secondary btn-sm text-sm" onclick="">Change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-md float-sm-right">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-4">
                                    <h5 class="font-weight-normal"> Change Password </h5>
                                    <p class="font-weight-normal text-black-50  text-sm"> Change your password for a new one, valid for the next login.</p>
                                </div>
                                <div class="col-8 text-dark text-sm">
                                    <form class="form-horizontal" class="formSimpanTicket" id="formSimpanTicket" role="form" method="post" action="#" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="current_pass" class="font-weight-normal">Current Password</label>
                                            <input type="text" name="current_pass" id="current_pass" class="form-control text-sm" placeholder="Your current password">
                                            <!-- <input type="text" readonly name="sender_id" value="<?= $this->session->id_user ?>" class="form-control"> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="new_pass" class="font-weight-normal">New Password</label>
                                            <input type="text" name="new_pass" id="new_pass" class="form-control text-sm" placeholder="Your new password">
                                            <!-- <input type="text" readonly name="sender_id" value="<?= $this->session->id_user ?>" class="form-control"> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_pass" class="font-weight-normal">Current Password</label>
                                            <input type="text" name="confirm_pass" id="confirm_pass" class="form-control text-sm" placeholder="Confirm your new password">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-md float-sm-right">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>