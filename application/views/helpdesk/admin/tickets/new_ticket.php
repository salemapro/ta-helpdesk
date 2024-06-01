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
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-4">
                            <h5 class="font-weight-light"> Ticket Details</h5>
                            <p class="font-weight-light text-black-50  text-sm"> Ticket details and classification.</p>
                        </div>
                        <div class="col-8 text-black-50 text-sm">
                            <!-- <?php echo form_open_multipart('helpdesk/ticket/save_ticket', ['class' => 'formSimpanTicket']) ?> -->
                            <form class="form-horizontal" class="formSimpanTicket" id="formSimpanTicket" role="form" method="post" action="#" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="no_ticket" class="font-weight-light">No. Ticket</label>
                                    <input type="text" readonly name="no_ticket" id="no_ticket" value="<?= $no_ticket ?>" class="form-control">
                                    <input type="text" readonly name="sender_id" value="<?= $this->session->id_user ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="company" class="font-weight-light">Company</label>
                                    <select name="company" id="company" class="form-control font-weight-light text-sm" onchange="cariApp()">
                                        <option value="0" selected disabled>Select an option</option>
                                        <?php foreach ($company as $row) { ?>
                                            <option value="<?= $row->id_company ?>"> <?= $row->company ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group" id="form_app">
                                    <label for="application" class="font-weight-light">Application</label>
                                    <select name="application" id="application" class="form-control font-weight-light text-sm">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="font-weight-light">Subject</label>
                                    <select name="subject" id="subject" class="form-control font-weight-light text-sm">
                                        <option value="0" selected disabled>Select an option</option>
                                        <?php foreach ($subject as $row) { ?>
                                            <option value="<?= $row->id_subject ?>"> <?= $row->subject ?></option>
                                        <?php } ?>
                                    </select>
                                    <!-- <input type="hidden" name="for_department" value="<?= $row->department_id ?>" class="form-control"> -->
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="font-weight-light">Message</label>
                                    <!-- <input type="text" name="subject" class="form-control"> -->
                                    <textarea name="message" id="message" class="form-control font-weight-light text-sm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="img_ticket" class="font-weight-light">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img_ticket" id="img_ticket" class="custom-file-input" required>
                                            <label class="custom-file-label" for="img_ticket">Choose file</label>
                                        </div>
                                    </div>
                                    <!-- <input type="file" name="img_ticket"> -->
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                            </form>
                            <!-- <?php echo form_close() ?> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            bsCustomFileInput.init();
        });

        $('#form_app').hide();

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
</script>