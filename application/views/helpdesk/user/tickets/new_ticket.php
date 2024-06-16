<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 mt-3">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold text-black"> Create Ticket</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form class="form-horizontal" class="formSimpanTicket" id="formSimpanTicket" role="form" method="post" action="#" enctype="multipart/form-data">

                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-4">
                                <h5 class="font-weight-normal"> Ticket Details</h5>
                                <p class="font-weight-normal text-black-50  text-sm"> Ticket details and classification.</p>
                            </div>
                            <div class="col-8 text-dark text-sm">
                                <!-- <?php echo form_open_multipart('helpdesk/ticket/save_ticket', ['class' => 'formSimpanTicket']) ?> -->
                                <div class="form-group">
                                    <label for="no_ticket" class="font-weight-normal">No. Ticket</label>
                                    <input type="text" readonly name="no_ticket" id="no_ticket" value="<?= $no_ticket ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="sender_id" class="font-weight-normal">Customer</label>
                                    <input type="hidden" readonly name="sender_id" id="sender_id" value="<?= $this->session->id_user ?>" class="form-control">
                                    <input type="text" readonly name="fullname" id="fullname" value="<?= $this->session->fullname ?>" class="form-control">
                                </div>
                                <div class="form-group" id="form_company">
                                    <label for="company" class="font-weight-normal">Company</label>
                                    <select name="company" id="company" class="form-control select2bs4 font-weight-normal text-sm">
                                    </select>
                                </div>
                                <div class="form-group" id="form_app">
                                    <label for="application" class="font-weight-normal">Application</label>
                                    <select name="application" id="application" class="form-control select2bs4 font-weight-normal text-sm">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="font-weight-normal">Subject</label>
                                    <select name="subject" id="subject" class="form-control select2bs4 font-weight-normal text-sm">
                                        <option value="0" selected disabled>Select an option</option>
                                        <?php foreach ($subject as $row) { ?>
                                            <option value="<?= $row->id_subject ?>"> <?= $row->subject ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="font-weight-normal">Message</label>
                                    <textarea name="message" id="message" class="form-control font-weight-normal text-sm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="img_ticket" class="font-weight-normal">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img_ticket" id="img_ticket" class="custom-file-input" required>
                                            <label class="custom-file-label" for="img_ticket">Choose file</label>
                                        </div>
                                    </div>
                                </div>


                                <!-- <?php echo form_close() ?> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="reset" class="btn btn-danger btn-md text-sm mr-1" onclick="back()">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-md text-sm">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            bsCustomFileInput.init();
            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        $(function() {
            var user = $("#sender_id").val();
            $.ajax({
                type: "post",
                url: "../client/get_company",
                data: {
                    id_user: user
                },
                success: function(data) {
                    $('#company').empty();
                    if (typeof data === 'string') {
                        data = JSON.parse(data);
                    }
                    if (Array.isArray(data)) {
                        data.forEach(function(company) {
                            $('#company').append('<option value="' + company.id_company + '">' + company.company + '</option>');
                        });
                        cariApp();
                    } else {
                        console.error("Data is not in the expected format: ", data);
                    }
                    // $('#form_company').show();
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred while fetching applications:", error);
                }
            });
        })

        $('#form_app').hide();

        $("#formSimpanTicket").on("submit", function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: "post",
                url: "<?php echo base_url('helpdesk/ticket/save_ticket') ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    console.log("Success response", response);
                    if (response.error) {
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
                            window.location.href = "<?= base_url('helpdesk/ticket/user') ?>"
                        }, 1000);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log("Error response", xhr.status, xhr.responseText, thrownError);
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

            return false;
        });



    });

    function cariApp() {
        var company = $("#company").val();
        // var app = $('#application');
        if (company != "1") {
            $.ajax({
                type: "post",
                url: "../client/get_app",
                data: {
                    company: company
                },
                success: function(data) {
                    $('#application').empty();
                    if (typeof data === 'string') {
                        data = JSON.parse(data);
                    }
                    if (Array.isArray(data)) {
                        data.forEach(function(app) {
                            $('#application').append('<option value="' + app.id_application + '">' + app.application + '</option>');
                        });
                    } else {
                        console.error("Data is not in the expected format: ", data);
                    }
                    $('#form_app').show();
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred while fetching applications:", error);
                }
            });
        } else {
            $('#form_app').hide();
        }
    }

    function back() {
        window.location.href = "<?= base_url('helpdesk/ticket/user') ?>"
    }
</script>