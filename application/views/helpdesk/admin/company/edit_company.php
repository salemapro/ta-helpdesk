<div class="modal fade" id="modalEditCompany" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-normal">Edit Company</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('helpdesk/client/update_company', ['class' => 'formUpdateCompany']) ?>
            <div class="modal-body">
                <input type="hidden" name="id_company" value="<?= $id_company ?>">
                <div class="form-group row">
                    <label for="inputCompany" class="col-sm-3 col-form-label font-weight-normal text-sm">Company</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control font-weight-normal text-sm" id="inputCompany" name="company" value="<?php echo $company ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary text-sm">Update</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- JQuery -->
<script>
    $(document).ready(function() {
        $('.formUpdateCompany').submit(function(e) {
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
                        $('#modalTambahCompany').modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>