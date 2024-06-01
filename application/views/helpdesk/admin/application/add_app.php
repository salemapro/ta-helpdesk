<div class="modal fade" id="modalTambahApp" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Application</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('helpdesk/client/save_app', ['class' => 'formSimpanApp']) ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputApp" class="col-sm-3 col-form-label">Application</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="application" name="application" placeholder="Application Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputCompany" class="col-sm-3 col-form-label">Company</label>
                    <div class="col-sm-9">
                        <!-- <input type="text" class="form-control" id="inputApplication" name="app" placeholder="Company Name"> -->
                        <select class="form-control select2 text-sm" id="company" name="company" required="">
                            <option value="" selected="" disabled="">-- Select Company --</option>
                            <?php
                            foreach ($company as $row) :
                                echo "<option value='$row->id_company'>$row->company" . "</option>";
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- JQuery -->
<script>
    $(document).ready(function() {
        $('.formSimpanApp').submit(function(e) {
            var application = $('#application').val();
            var company_id = $('#company').val();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    company_id: company_id,
                    application: application
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

    // function cariPresensi() {
    //     var id_company = $("#inputCompany").val();
    //     // var base_url = "<?php echo base_url(); ?>";
    //     $.ajax({
    //         type: "post",
    //         url: "<?php echo base_url('helpdesk/client/get_company'); ?>",
    //         data: {
    //             id_company: id_company
    //         },
    //         async: true,
    //         success: function(response){

    //         },
    //         error: function(response){

    //         }
    //     })
    // }
</script>