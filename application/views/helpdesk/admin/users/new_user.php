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
                <?php echo form_open('helpdesk/user/save_user', ['class' => 'formSimpanUser']) ?>
                <!-- <form action="<?= base_url('helpdesk/user/save_user') ?>" method="post"> -->
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-light"> User Details</h5>
                            <p class="font-weight-light text-black-50  text-sm"> This information will be displayed publicly.</p>
                        </div>
                        <div class="col-8 text-sm">
                            <div class="form-group">
                                <label for="code_user" class="font-weight-light">Code User</label>
                                <input type="text" name="code_user" id="code_user" value="<?= $code_user ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="fullname" class="font-weight-light">Full Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control text-black-50 font-weight-light text-sm" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-light">Email</label>
                                <input type="text" name="email" id="email" class="form-control text-black-50 font-weight-light text-sm" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="font-weight-light">Password</label>
                                <input type="text" name="password" id="password" class="form-control text-black-50 font-weight-light text-sm" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="company" class="font-weight-light">Company</label>
                                <select name="company" id="company" class="form-control text-black-50 font-weight-light text-sm" onchange="showDiv()">
                                    <option value="" selected disabled>Select an option</option>
                                    <?php
                                    foreach ($company as $row) :
                                        echo "<option value='$row->id_company'>$row->company" . "</option>";
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" id="form_divisi">
                                <label for="divisi" class="font-weight-light">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control text-black-50 font-weight-light text-sm">
                                    <option value="" selected disabled>Select an option</option>
                                    <?php
                                    foreach ($divisi as $row) :
                                        echo "<option value='$row->id_divisi'>$row->divisi" . "</option>";
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-light"> User Settings</h5>
                            <p class="font-weight-light text-black-50  text-sm"> User settings and permissions access.</p>
                        </div>
                        <div class="col-8 text-sm">
                            <div class="form-group">
                                <label for="role" class="font-weight-light">Role</label>
                                <select name="role" id="role" class="form-control text-black-50 font-weight-light text-sm">
                                    <option value="" selected disabled>Select an option</option>
                                    <?php
                                    foreach ($role as $row) :
                                        echo "<option value='$row->id_role'>$row->role" . "</option>";
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="status" class="font-weight-light">Status</label><br>
                                <input type="checkbox" name="my-checkbox" id="status" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="status" class="font-weight-light">Status</label><br>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">
                                        <span class="text-xs font-weight-light text-black-50"> The status of user </span>
                                    </label>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card-footer float-right ">
                    <div class="col-12">
                        <button type="reset" onclick="back()" class="btn btn-danger btn-sm">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </div>
                <!-- </form> -->
                <?php echo form_close() ?>
            </div>
        </div>

    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#form_divisi').hide();

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state');
        });

        $('.formSimpanUser').submit(function(e) {
            // var application = $('#application').val();
            // var company_id = $('#company').val();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
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
                            window.location.href = "<?= base_url('helpdesk/user/user') ?>"
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

    function showDiv() {
        var company = $('#company').val();

        if (company == 1) {
            $('#form_divisi').show();
        } else {
            $('#form_divisi').hide();
        }
    }

    function back() {
        window.location.href = "<?= base_url('helpdesk/user/user') ?>"
    }
</script>