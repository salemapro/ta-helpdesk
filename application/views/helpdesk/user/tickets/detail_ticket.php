<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 mt-3">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bolder">Details Ticket</h3>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-11">
                            <button class="btn btn-primary text-sm float-right mr-2" onclick="back()"> Back </button>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-outline-primary text-sm float-right" onclick="reload()">
                                <i class="fas fa-sync"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- <div class="row">
                        <div class="col-sm-12">
                            <ol class="float-sm-right">
                                <button class="btn btn-primary text-sm" onclick="back()"> Back </button>
                            </ol>
                        </div>
                    </div> -->

                    <!-- <div class="callout callout-info">
                        <h5><b>No Ticket : <?= $ticket->no_ticket ?></b></h5>
                    </div> -->

                    <div class="invoice p-3 mb-3" style="border-radius: 12px;">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-ticket-alt"></i> <b>HELPDESK TICKET</b>
                                    <small class="float-right">Date: <?= $ticket->created_at ?></small>
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Costumer</label>
                                        <input type="text" readonly value="<?= $ticket->fullname ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-normal">Ticket Number</label>
                                        <input type="text" readonly value="<?= $ticket->no_ticket ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-normal">Company</label>
                                        <input type="text" readonly value="<?= $ticket->company ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-normal">Application</label>
                                        <input type="text" readonly value="<?= $ticket->application ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Status</label>
                                        <?php if ($ticket->status_ticket == '0') {
                                            $status = 'WAITING';
                                        } else if ($ticket->status_ticket == '1') {
                                            $status = 'PROCESS';
                                        } else {
                                            $status = 'SOLVED';
                                        }
                                        ?>
                                        <input type="text" readonly value="<?= $status ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-normal">Divisi</label>
                                        <input type="text" readonly value="<?= $ticket->divisi ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-normal">Solved at</label>
                                        <?php
                                        if ($ticket->solved_at) {
                                            $solved = $ticket->solved_at;
                                        } else {
                                            $solved = '--';
                                        }
                                        ?>
                                        <input type="text" readonly value="<?= $solved ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-normal">Solved by</label>
                                        <?php
                                        if ($ticket->status_ticket == '2') {
                                            $solved_by = $ticket->solved_by;
                                        } else {
                                            $solved_by = '--';
                                        }
                                        ?>
                                        <input type="text" readonly value="<?= $solved_by ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <h5 class="mt-3"><b>Subject :</b></h5>
                            <input type="text" readonly value="<?= $ticket->subject ?>" class="form-control">

                            <h5 class="mt-3"><b>Description :</b></h5>
                            <textarea readonly class="form-control" rows="3"><?= $ticket->message ?></textarea>

                            <h5 class="mt-3"><b>Image :</b></h5>
                            <img class="img-fluid pad" src="<?= base_url('assets/images/tiket/' . $ticket->img_ticket) ?>" alt="Image Ticket">

                            <h5 class="mt-5"><b>Comments :</b></h5>
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
                                    <div class="img-push">
                                        <input type="hidden" id="ticket_id" name="ticket_id" class="form-control form-control-sm" value="<?= $ticket->id_ticket ?>">
                                        <input type="hidden" id="sender_id" name="sender_id" class="form-control form-control-sm" value="<?= $ticket->sender_id ?>">
                                        <input type="hidden" id="divisi_id" name="divisi_id" class="form-control form-control-sm" value="<?= $ticket->id_divisi ?>">
                                        <input type="hidden" id="user_id" name="user_id" class="form-control form-control-sm" value="<?= $this->session->id_user ?>">
                                        <input type="text" id="comment" name="comment" class="form-control form-control-sm" placeholder="Press enter to post comment">
                                    </div>
                                </form>
                            </div>
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
                sender_id: $('#sender_id').val(),
                divisi_id: $('#divisi_id').val(),
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
                        // $('#comment').val('');
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
        window.location.href = "<?= base_url('helpdesk/ticket/user') ?>"
    }

    function reload() {
        location.reload();
    }
</script>