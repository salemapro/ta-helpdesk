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
                    <div class="row">
                        <div class="col-sm-12">
                            <ol class="float-sm-right">
                                <button class="btn btn-primary text-sm" onclick="back()"> Back </button>
                            </ol>
                        </div>
                    </div>

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
                                To
                                <address>
                                    <strong>
                                        <?= $ticket->divisi ?>
                                    </strong>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Status Ticket :</b> <?php if ($ticket->status_ticket == '0') {
                                                            echo '<span class="badge badge-warning">Waiting...</span>';
                                                        } else if ($ticket->status_ticket == '1') {
                                                            echo '<span class="badge badge-success">Process..</span>';
                                                        } else {
                                                            echo '<span class="badge badge-danger">Solved</span>';
                                                        }
                                                        ?>
                                <br>
                                <b>No Ticket :</b> <?= $ticket->no_ticket ?>
                                <br>
                                <b>Solved at:</b>
                                <?php
                                if ($ticket->solved_at) {
                                    echo $ticket->solved_at;
                                } else {
                                    echo '--';
                                }
                                ?>
                                <br>
                                <b>Solved by:</b>
                                <?php
                                if ($ticket->status_ticket == '2') {
                                    echo $ticket->solved_by;
                                } else {
                                    echo '';
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <!-- <p><?= $ticket->subject ?></p><br> -->
                            <h5><b><?= $ticket->subject ?></b></h5>
                            <img class="img-fluid pad" src="<?= base_url('assets/images/tiket/' . $ticket->img_ticket) ?>" alt="Photo">
                            <p><?= $ticket->message ?></p>
                        </div>

                        <b>Comments</b>
                        <div class="card-footer card-comments">
                            <?php
                            foreach ($comment as $row) { ?>
                                <div class="card-comment">
                                    <img class="img-circle img-sm" src="<?= base_url('assets/back') ?><?= $row->avatar ?>" alt="A">

                                    <div class="comment-text">
                                        <span class="username">
                                            <?= $row->fullname ?>
                                            <span class="text-muted float-right"><?= $row->date ?></span>
                                        </span>
                                        <?= $row->comment ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer">
                            <form action="#" method="post" id="commentForm">
                                <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/back') ?><?= $this->session->avatar ?>" alt="Alt Text">
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
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        toastr.error(response.error);
                        $('#comment').val('');
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
                            $('#comment').val('');
                            location.reload();
                        }, 1000);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log("Error response", xhr.status, xhr.responseText, thrownError);
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        }

    });

    function back() {
        window.location.href = "<?= base_url('helpdesk/ticket/admin') ?>"
    }
</script>