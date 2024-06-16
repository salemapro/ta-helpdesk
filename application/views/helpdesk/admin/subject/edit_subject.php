<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 mt-3">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bolder">Edit Subject</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <?php echo form_open('helpdesk/subject/update_subject', ['class' => 'formEditSubject']) ?>
                <!-- <form action="<?= base_url('helpdesk/user/save_user') ?>" method="post"> -->
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-normal"> Subject Details</h5>
                            <p class="font-weight-normal text-black-50  text-sm"> This information will be displayed publicly.</p>
                        </div>
                        <div class="col-8 text-sm">
                            <div class="form-group">
                                <label for="subject" class="font-weight-normal">Subject</label>
                                <input type="hidden" name="id_subject" id="id_subject" value="<?= $sub->id_subject ?>" class="form-control">
                                <input type="text" name="subject" id="subject" class="form-control text-dark font-weight-normal text-sm" value="<?= $sub->subject ?>">
                            </div>
                            <div class="form-group">
                                <label for="divisi" class="font-weight-normal">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control text-dark font-weight-normal text-sm">
                                    <option value="" selected disabled>Select an option</option>
                                    <?php
                                    foreach ($divisi as $row) { ?>
                                        <option value="<?= $row->id_divisi ?>" <?= $row->id_divisi == $sub->divisi_id ? "selected" : null ?>>
                                            <?= $row->divisi ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button type="reset" onclick="back()" class="btn btn-danger text-sm">Cancel</button>
                        <button type="submit" class="btn btn-primary text-sm">Update</button>
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

        $('.formEditSubject').submit(function(e) {
            $id_subject = $('#id_subject').val();
            $subject = $('#subject').val();
            $divisi = $('#divisi').val();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    id_subject: $id_subject,
                    subject: $subject,
                    divisi: $divisi
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