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
                <?php echo form_open('helpdesk/client/save_client', ['class' => 'formSimpanClient']) ?>
                <!-- <form action="<?= base_url('helpdesk/user/save_user') ?>" method="post"> -->
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-light"> Client Details</h5>
                            <p class="font-weight-light text-black-50  text-sm"> This information will be displayed publicly.</p>
                        </div>
                        <div class="col-8 text-sm">
                            <div class="form-group">
                                <label for="fullname" class="font-weight-light">Full Name</label>
                                <input type="text" name="code_user" id="code_user" value="<?= $code_user ?>" class="form-control">
                                <input type="text" name="fullname" id="fullname" class="form-control text-black-50 font-weight-light text-sm" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-light">Email</label>
                                <input type="text" name="email" id="email" class="form-control text-black-50 font-weight-light text-sm" placeholder="Email">
                            </div>
                            <!-- <div class="form-group">
                                <label for="password" class="font-weight-light">Password</label>
                                <input type="text" name="password" id="password" class="form-control text-black-50 font-weight-light text-sm" placeholder="Password">
                            </div> -->
                            <div class="form-group">
                                <label for="num_phone" class="font-weight-light">Phone Number</label>
                                <input type="text" name="num_phone" id="num_phone" class="form-control text-black-50 font-weight-light text-sm" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="company" class="font-weight-light">Company</label>
                                <select name="company" id="company" class="form-control text-black-50 font-weight-light text-sm">
                                    <option value="0" selected disabled>Select an option</option>
                                    <?php
                                    foreach ($company as $row) :
                                        echo "<option value='$row->id_company'>$row->company" . "</option>";
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-light"> Client Settings</h5>
                            <p class="font-weight-light text-black-50  text-sm"> User settings and permissions access.</p>
                        </div>
                        <div class="col-8 text-sm">
                            <div class="form-group">
                                <label for="role" class="font-weight-light">Role</label>
                                <select name="role" id="role" class="form-control text-black-50 font-weight-light text-sm">
                                    <option value="3" selected disabled>Client</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
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

        $('.formSimpanClient').submit(function(e) {
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

    function back() {
        window.location.href = "<?= base_url('helpdesk/client/client') ?>"
    }
</script>