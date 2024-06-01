<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div>
    </section>
    <section class="content">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Ticket</h3>
                        <!-- <a href="<?= base_url('helpdesk/ticket/add_ticket') ?>" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#form_tiket">
                            Tambah Ticket
                        </a> -->
                        <button class="btn btn-primary text-sm float-right" onclick="crtTicket()">Create Ticket</button>
                    </div>

                    <div class="card-body">
                        <!-- <?= $this->session->flashdata('message'); ?> -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="nowrap font-weight-light text-sm">No</th>
                                    <th class="font-weight-light text-sm">Customer</th>
                                    <th class="font-weight-light text-sm">Ticket Summary</th>
                                    <th class="font-weight-light text-sm">Status</th>
                                    <th class="font-weight-light text-sm">Confirm</th>
                                    <th class="font-weight-light text-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($ticket as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->fullname ?></td>
                                        <td><?= $row->subject ?></td>
                                        <td>
                                            <?php if ($row->status_ticket == '0') {
                                                echo '<span class="badge badge-warning">Waiting...</span>';
                                            } else if ($row->status_ticket == '1') {
                                                echo '<span class="badge badge-info">Opened</span>';
                                            } else if ($row->status_ticket == '2') {
                                                echo '<span class="badge badge-success">Process..</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Solved</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->status_ticket == '0') {
                                                echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-tiket" id="select-tiket" data-id_ticket="' . $row->id_ticket . '"
                                                data-status_ticket="' . $row->status_ticket . '"
                                                class="btn btn-success btn-sm">
                                                Confirm
                                                </a>';
                                            } else if ($row->status_ticket == '1') {
                                                echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-reply" id="reply-message" 
                                                data-ticket_id="' . $row->id_ticket . '"
                                                data-id_ticket_id="' . $row->id_ticket . '"
                                                data-subject="' . $row->subject . '"
                                                data-message="' . $row->message . '"
                                                class="btn btn-warning btn-sm">
                                                Reply Massage
                                                </a>';
                                            } else if ($row->status_ticket == '2') {
                                                echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-closeTiket" id="cTicket" 
                                                data-close_ticket="' . $row->id_ticket . '"
                                                data-close_status="' . $row->status_ticket . '"
                                    
                                                class="btn btn-primary btn-sm">
                                                Close
                                                </a>';
                                            } else {
                                                echo '<a href="javascript:void(0);" class="btn btn-danger btn-sm">
                                                Closed
                                                </a>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('tiket/detail_tiket/' . $row->no_ticket) ?>" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a onclick="return confirm('Yakin Akan Menghapus?')" href="<?= base_url('tiket/delete_tiket/' . $row->id_ticket) ?>" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- <div class="modal fade" id="form_tiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Ticket</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tiket') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="hidden" name="no_ticket" value="<?= $no_tiket ?>" class="form-control">
                        <input type="text" name="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="img_ticket">Image</label><br>
                        <input type="file" name="img_ticket">
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin Confirm Ticket Ini?</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tiket_waiting') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_ticket" id="id_ticket" class="form-control">
                    <input type="hidden" name="status_ticket" value="1" class="form-control">

                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-reply">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tanggapan</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tiket_reply') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_ticket" id="id_ticket_id" class="form-control">
                    <input type="hidden" name="ticket_id" id="ticket_id" class="form-control">
                    <div class="form-group">
                        <label for="subject">subject</label>
                        <input type="text" id="subject" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="message">message</label>
                        <textarea id="message" readonly class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggapan">tanggapan</label>
                        <textarea name="tanggapan" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar_tanggapan">Gambar Tanggapan</label><br>
                        <input type="file" name="gambar_tanggapan" id="gambar_tanggapan">
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Reply Message</button>
                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-closeTiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin Close Ticket Ini?</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tiket_close') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_ticket" id="close_ticket" class="form-control">
                    <input type="hidden" name="status_ticket" value="3" class="form-control">

                    <button type="submit" class="btn btn-primary btn-sm">Close Tiket</button>
                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

<script>
    $(document).ready(function() {

        $(document).on('click', '#select-tiket', function() {
            var id_ticket = $(this).data('id_ticket')
            var status_ticket = $(this).data('status_ticket')

            $('#id_ticket').val(id_ticket)
            $('#status_ticket').val(status_ticket)
        })

        $(document).on('click', '#reply-message', function() {
            var ticket_id = $(this).data('ticket_id')
            var id_ticket_id = $(this).data('id_ticket_id')
            var subject = $(this).data('subject')
            var message = $(this).data('message')

            $('#ticket_id').val(ticket_id)
            $('#id_ticket_id').val(id_ticket_id)
            $('#subject').val(subject)
            $('#message').val(message)
        })

        $(document).on('click', '#cTicket', function() {
            var close_ticket = $(this).data('close_ticket')
            var close_status = $(this).data('close_status')
            // var status_ticket = $(this).data('status_ticket')

            $('#close_ticket').val(close_ticket)
            $('#close_status').val(close_status)
            // $('#status_ticket').val(status_ticket)
        })
    });

    function crtTicket() {
        window.location.href = "<?= base_url('helpdesk/ticket/new_ticket') ?>"
    }
</script>