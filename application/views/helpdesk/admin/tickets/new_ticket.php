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
                                    <!-- <input type="hidden" readonly name="sender_id" value="<?= $this->session->id_user ?>" class="form-control"> -->
                                </div>
                                <div class="form-group">
                                    <label for="costumer" class="font-weight-normal">Costumer</label>
                                    <select name="sender_id" id="sender_id" class="form-control select2bs4 font-weight-normal text-sm" onchange="cariCompany()">
                                        <option value="0" selected disabled>Select an option</option>
                                        <?php foreach ($user as $row) { ?>
                                            <option value="<?= $row->id_user ?>">
                                                <!-- <div class="media align-items-center">
                                                    <div class="avatar-wrapper2">
                                                        <img src="<?php echo base_url('assets/back') ?><?= $row->avatar; ?>" class="img-size-32 img-circle">
                                                    </div>
                                                    <div class="media-body ml-2 ">
                                                        <h4 class="dropdown-item-title text-sm mb-0 ">
                                                            <?= $row->fullname; ?>
                                                        </h4>
                                                    </div>
                                                </div> -->
                                                <?= $row->fullname; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="form_company">
                                    <label for="company" class="font-weight-normal">Company</label>
                                    <select name="company" id="company" class="form-control select2bs4 font-weight-normal text-sm"></select>
                                </div>
                                <div class="form-group" id="form_app">
                                    <label for="application" class="font-weight-normal">Application</label>
                                    <select name="application" id="application" class="form-control select2bs4 font-weight-normal text-sm"></select>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="font-weight-normal">Subject</label>
                                    <select name="subject" id="subject" class="form-control select2bs4 font-weight-normal text-sm" style="width: 100%; height: 100%;">
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

        $('#form_app').hide();
        $('#form_company').hide();

        $("#formSimpanTicket").on("submit", function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this); // Create a FormData object from the form

            $.ajax({
                type: "post",
                url: "<?php echo base_url('helpdesk/ticket/save_ticket') ?>",
                data: formData,
                processData: false, // Important: Prevent jQuery from processing the data
                contentType: false, // Important: Prevent jQuery from setting content type
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
                            window.location.href = "<?= base_url('helpdesk/ticket/admin') ?>"
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

    // $("#formSimpanTicket").on("submit", function(event) {
    //     event.preventDefault();
    //     var image = document.getElementById('img_ticket');
    //     var file = image.files[0];

    //     if (file) {
    //         var reader = new FileReader();
    //         reader.onloadend = function() {
    //             var img_ticket = reader.result.split(';base64,')[1];
    //             var no_ticket = $('#no_ticket').val();
    //             var subject = $('#subject').val();
    //             var message = $('#message').val();
    //             var company = $('#company').val();
    //             var application = $('#application').val();

    //             $.ajax({
    //                 type: "post",
    //                 url: "<?php echo base_url('helpdesk/ticket/save_ticket') ?>",
    //                 data: {
    //                     no_ticket: no_ticket,
    //                     subject: subject,
    //                     message: message,
    //                     company: company,
    //                     application: application,
    //                     img_ticket: img_ticket
    //                 },
    //                 // encypte: "multipart/form-data",
    //                 dataType: "json",
    //                 success: function(response) {
    //                     if (response.error) {
    //                         toastr.error(response.error);
    //                     }
    //                     if (response.success) {
    //                         Swal.fire({
    //                             icon: 'success',
    //                             title: 'Berhasil',
    //                             text: response.success,
    //                             showCancelButton: false,
    //                             showConfirmButton: false
    //                         });
    //                         setTimeout(function() {
    //                             window.location.href = "<?= base_url('helpdesk/ticket/ticket') ?>"
    //                         }, 1000);
    //                     }
    //                 },
    //                 error: function(xhr, ajaxOptions, thrownError) {
    //                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //                 }
    //             });
    //         };
    //         reader.readAsDataURL(file);
    //     } else {
    //         alert("Please select an image file.");
    //     }

    //     return false;
    // });

    // $('.formSimpanTicket').submit(function(e) {
    //     // var sender_id = $('#sender_id').val();
    //     // var no_ticket = $('#no_ticket').val();
    //     // var subject = $('#subject').val();
    //     // var message = $('#message').val();
    //     // var company = $('#company').val();
    //     // var application = $('#application').val();
    //     // var img_ticket = $('#img_ticket').val();

    //     $.ajax({
    //         type: "post",
    //         url: $(this).attr('action'),
    //         data: $(this).serialize(),
    //         // data: {
    //         //     sender_id: sender_id,
    //         //     no_ticket: no_ticket,
    //         //     subject: subject,
    //         //     message: message,
    //         //     company: company,
    //         //     application: application,
    //         //     img_ticket: img_ticket
    //         // },
    //         dataType: "json",
    //         success: function(response) {
    //             if (response.error) {
    //                 // $('.pesan').html(response.error).show();
    //                 toastr.error(response.error);
    //             }
    //             if (response.success) {
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Berhasil',
    //                     text: response.success,
    //                     showCancelButton: false,
    //                     showConfirmButton: false
    //                 });
    //                 setTimeout(function() {
    //                     window.location.href = "<?= base_url('helpdesk/ticket/ticket') ?>"
    //                     // location.reload();
    //                 }, 1000)
    //             }
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //         }
    //     });
    //     return false;
    // });
    // });

    function cariCompany() {
        var user = $("#sender_id").val();
        // var app = $('#application');
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
                $('#form_company').show();
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching applications:", error);
            }
        });
    }

    function cariApp() {
        var company = $("#company").val();
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
        window.location.href = "<?= base_url('helpdesk/ticket/admin') ?>"
    }
</script>