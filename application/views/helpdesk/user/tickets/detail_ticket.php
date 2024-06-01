<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><b>No Ticket : <?= $ticket->no_ticket ?></b></h5>
                    </div>

                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-ticket-alt"></i> HELPDESK TICKET
                                    <small class="float-right">Date: <?= $ticket->created_at ?></small>
                                </h4>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong><?= $ticket->fullname ?></strong><br>
                                    <?= $ticket->company ?><br>
                                    <?= $ticket->application ?><br>
                                    <?= $ticket->email ?><br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">

                                <b>Status Ticket :</b> <?php if ($ticket->status_ticket == '0') {
                                                            echo '<span class="badge badge-warning">Waiting...</span>';
                                                        } else if ($ticket->status_ticket == '1') {
                                                            echo '<span class="badge badge-info">Opened</span>';
                                                        } else if ($ticket->status_ticket == '2') {
                                                            echo '<span class="badge badge-success">Process..</span>';
                                                        } else {
                                                            echo '<span class="badge badge-danger">Solved</span>';
                                                        }
                                                        ?>
                                <br>
                                <b>No Ticket :</b> <?= $ticket->no_ticket ?>
                                <br>
                                <b>Solved at:</b>
                                <!-- <?php
                                        if ($ticket->status_ticket == '3') {
                                            echo $ticket->waktu_tanggapan;
                                        } else {
                                            echo '--';
                                        }
                                        ?> -->
                            </div>
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>Developer</strong><br>
                                    <b>Solved by:</b>
                                </address>
                            </div>
                        </div>
                        <hr>
                        <!-- <div class="row">
                            <div class="col-6">
                                <label for="">Keluhan User:</label>
                                <input type="text" value="<?= $ticket->subject ?>" readonly class="form-control">
                                <label for="">Keterangan:</label>
                                <textarea rows="6" readonly class="form-control"><?= $ticket->message ?></textarea>
                            </div>
                            <div class="col-6">
                                <label for="">Comment:</label>
                            </div>
                        </div> -->

                        <!-- <div class="row">
                            <div class="col-6">
                                <label>Image Komplain:</label>
                                <img src="<?= base_url('assets/images/tiket/' . $ticket->img_ticket) ?>" width="508px">
                            </div>
                            
                        </div> -->

                        <div class="card-body">
                            <!-- <p><?= $ticket->subject ?></p><br> -->
                            <h5><b><?= $ticket->subject ?></b></h5>
                            <img class="img-fluid pad" src="<?= base_url('assets/images/tiket/' . $ticket->img_ticket) ?>" alt="Photo">
                            <p><?= $ticket->message ?></p>
                            <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                            <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                            <span class="float-right text-muted">127 likes - 3 comments</span> -->
                        </div>
                        <!-- /.card-body -->

                        <b>Comments:</b>
                        <div class="card-footer card-comments">
                            <div class="card-comment">
                                <img class="img-circle img-sm" src="<?= base_url('assets/back') ?>/dist/img/user3-128x128.jpg" alt="User Image">

                                <div class="comment-text">
                                    <span class="username">
                                        Maria Gonzales
                                        <span class="text-muted float-right">8:03 PM Today</span>
                                    </span>
                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.
                                </div>
                            </div>
                            <!-- <div class="card-comment">
                                <img class="img-circle img-sm" src="<?= base_url('assets/back') ?>/dist/img/user3-128x128.jpg" alt="User Image">

                                <div class="comment-text">
                                    <span class="username">
                                        Maria Gonzales
                                        <span class="text-muted float-right">8:03 PM Today</span>
                                    </span>
                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.
                                </div>
                            </div>
                            <div class="card-comment">
                                <img class="img-circle img-sm" src="<?= base_url('assets/back') ?>/dist/img/user4-128x128.jpg" alt="User Image">

                                <div class="comment-text">
                                    <span class="username">
                                        Luna Stark
                                        <span class="text-muted float-right">8:03 PM Today</span>
                                    </span>
                                    It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at its layout.
                                </div>
                            </div> -->
                        </div>
                        <div class="card-footer">
                            <form action="#" method="post" id="commentForm">
                                <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/back') ?>/dist/img/user4-128x128.jpg" alt="Alt Text">
                                <!-- .img-push is used to add margin to elements next to floating images -->
                                <div class="img-push">
                                    <input type="hidden" id="ticket_id" name="ticket_id" class="form-control form-control-sm" value="<?= $ticket->id_ticket ?>">
                                    <input type="hidden" id="user_id" name="user_id" class="form-control form-control-sm" value="<?= $this->session->id_user ?>">
                                    <input type="text" id="comment" name="comment" class="form-control form-control-sm" placeholder="Press enter to post comment">
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer -->
                    </div>

                </div>
            </div>
        </div>
</div>
</section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#comment').keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                postComment();
            }
        });

        function postComment() {
            var formData = {
                ticket_id: $('#ticket_id').val(),
                user_id: $('#user_id').val(),
                comment: $('#comment').val()
            };

            $.ajax({
                type: 'POST',
                url: '<?= base_url('helpdesk/ticket/post_comment') ?>',
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Optionally, clear the input field
                    $('#comment').val('');
                },
                error: function(response) {
                    // Handle error response
                    console.log(response);
                }
            });
        }

        // function postComment() {
        //     if (window.event.keyCode == 13) {
        //         var ticket_id = $('#ticket_id').val();
        //         var user_id = $('#user_id').val();
        //         var comment = $('#comment').val();

        //         $.ajax({
        //             type: "post",
        //             url: "<?php echo base_url('helpdesk/ticket/post_comment') ?>",
        //             data: {
        //                 ticket_id: ticket_id,
        //                 user_id: user_id,
        //                 comment: comment
        //             },
        //             dataType: "json",
        //             success: function(response) {
        //                 if (response.error) {
        //                     toastr.error(response.error);
        //                 }
        //                 if (response.success) {
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: 'Berhasil',
        //                         text: response.success,
        //                         showCancelButton: false,
        //                         showConfirmButton: false
        //                     });
        //                     // setTimeout(function() {
        //                     //     window.location.href = "<?= base_url('helpdesk/ticket/ticket') ?>"
        //                     // }, 1000);
        //                 }
        //             },
        //             error: function(xhr, ajaxOptions, thrownError) {
        //                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        //             }
        //         });
        //     }
        //     return false;
        // }
    })
</script>