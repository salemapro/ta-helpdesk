<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <?php echo form_open('helpdesk/client/update_client', ['class' => 'formEditClient']) ?>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-light"> Client Details</h5>
                            <p class="font-weight-light text-black-50  text-sm"> This information will be displayed publicly.</p>
                        </div>
                        <div class="col-8 text-sm">
                            <div class="form-group">
                                <label for="full_name" class="font-weight-light">Full Name</label>
                                <input type="hidden" name="id" id="id" value="<?= $cln->id_client ?>" class="form-control">
                                <input type="hidden" name="code_user" id="code_user" value="<?= $cln->user_code ?>" class="form-control">
                                <input type="text" name="fullname" id="fullname" class="form-control text-black-50 font-weight-light text-sm" value="<?= $cln->fullname ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-light">Email</label>
                                <input type="text" name="email" id="email" disabled class="form-control text-black-50 font-weight-light text-sm" value="<?= $cln->email ?>">
                            </div>
                            <div class="form-group">
                                <label for="num_phone" class="font-weight-light">Phone Number</label>
                                <input type="text" name="num_phone" id="num_phone" class="form-control text-black-50 font-weight-light text-sm" value="<?= $cln->num_phone ?>">
                            </div>
                            <div class="form-group">
                                <label for="company" class="font-weight-light">Company</label>
                                <select name="company" id="company" class="form-control text-black-50 font-weight-light text-sm">
                                    <option value="0" disabled>Select an option</option>
                                    <?php
                                    foreach ($company as $row) { ?>
                                        <option value="<?= $row->id_company ?>" <?= $row->id_company == $cln->company_id ? "selected" : null ?>>
                                            <?= $row->company ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <hr>
                    <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-light"> Client Settings</h5>
                            <p class="font-weight-light text-black-50  text-sm"> User settings and permissions access.</p>
                        </div>
                        <div class="col-8 text-sm">
                            <div class="form-group">
                                <label for="role" class="font-weight-light">Role</label>
                                <select name="role" id="role" class="form-control text-black-50 font-weight-light text-sm">
                                    <option value="0" disabled>Select an option</option>
                                    <?php
                                    foreach ($role as $row) { ?>
                                        <option value="<?= $row->id_role ?>" <?= $row->id_role == $cln->role_id ? "selected" : null ?>>
                                            <?= $row->role ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php $status = ($cln->status == 1) ? "checked" : "unchecked"; ?>
                                <?php if ($cln->status == 1) {
                                    $desc = "actived";
                                } else {
                                    $desc = "deactived";
                                } ?>
                                <label for="status" class="font-weight-light">Status</label><br>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="my-checkbox" id="status" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" <?php echo $status ?>>
                                    <label class="custom-control-label" for="customSwitch1">
                                        <span class="text-xs font-weight-light text-black-50">The client is <?= $desc ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                    <div class="card-footer float-right ">
                        <div class="col-12">
                            <button type="reset" onclick="back()" class="btn btn-danger btn-sm">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>

    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('.formEditClient').submit(function(e) {
            $id_client = $('#id').val();
            $code_user = $('#code_user').val();
            $fullname = $('#fullname').val();
            $email = $('#email').val();
            $company = $('#company').val();
            $num_phone = $('#num_phone').val();
            // $role = $('#role').val();
            // $status = getStatusChanged('#customSwitch1');
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    id_client: $id_client,
                    code_user: $code_user,
                    fullname: $fullname,
                    email: $email,
                    company: $company,
                    num_phone: $num_phone,
                    // role: $role,
                    // status: $status
                },
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        // $('.pesan').html(response.error).show();
                        toastr.error(response.error);
                    }
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        setTimeout(function() {
                            window.location.href = "<?= base_url('helpdesk/client/client') ?>"
                            // location.reload();
                        }, 1000)
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

    })

    function getStatusChanged(obj) {
        var status = 0;
        if ($(obj).is(":checked")) {
            status = 1;
        }
        return status;
    }

    function back() {
        window.location.href = "<?= base_url('helpdesk/client/client') ?>"
    }
</script>