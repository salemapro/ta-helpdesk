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
                <?php echo form_open('helpdesk/subject/save_subject', ['class' => 'formSimpanSubject']) ?>
                <!-- <form action="<?= base_url('helpdesk/user/save_user') ?>" method="post"> -->
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-light"> Subject Details</h5>
                            <p class="font-weight-light text-black-50  text-sm"> This information will be displayed publicly.</p>
                        </div>
                        <div class="col-8 text-sm">
                            <div class="form-group">
                                <label for="subject" class="font-weight-light">Subject</label>
                                <!-- <input type="hidden" name="code_user" id="code_user" value="<?= $code_user ?>" class="form-control"> -->
                                <input type="text" name="subject" id="subject" class="form-control text-black-50 font-weight-light text-sm" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <label for="divisi" class="font-weight-light">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control text-black-50 font-weight-light text-sm">
                                    <option value="0" selected disabled>Select an option</option>
                                    <?php
                                    foreach ($divisi as $row) :
                                        echo "<option value='$row->id_divisi'>$row->divisi" . "</option>";
                                    endforeach;
                                    ?>
                                </select>
                            </div>
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
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state');
        });

        $('.formSimpanSubject').submit(function(e) {
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
                            window.location.href = "<?= base_url('helpdesk/subject/subject') ?>"
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
        window.location.href = "<?= base_url('helpdesk/subject/subject') ?>"
    }
</script>