<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 mt-3">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bolder">Tickets</h3>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-11">
                            <button class="btn btn-primary text-sm float-right mr-2" onclick="crtTicket()">Create Ticket</button>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-outline-primary text-sm float-right" onclick="reload()">
                                <i class="fas fa-sync"></i>
                            </button>
                        </div>
                    </div>
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol> -->
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header"> -->
                        <!-- <h3 class="card-title">Data Ticket</h3> -->
                        <!-- <a href="<?= base_url('helpdesk/ticket/add_ticket') ?>" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#form_tiket">
                            Tambah Ticket
                        </a> -->
                        <!-- <button class="btn btn-primary text-sm float-right" onclick="crtTicket()">Create Ticket</button> -->
                        <!-- </div> -->
                        <div class="card-body table-responsive text-sm">
                            <table id="example1" class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="col-md-1 font-weight-normal text-sm">No</th>
                                        <th class="font-weight-normal text-sm">Customer</th>
                                        <th class="font-weight-normal text-sm">Ticket Summary</th>
                                        <th class="font-weight-normal text-sm">Status</th>
                                        <!-- <th class="font-weight-normal text-sm">Confirm</th> -->
                                        <th class="font-weight-normal text-sm">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($ticket as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td class="text-sm font-weight-normal">
                                                <div class="media align-items-center">
                                                    <div class="avatar-wrapper2">
                                                        <img src="<?php echo base_url('assets/back') ?><?= $row->avatar; ?>" class="img-size-32 img-circle">
                                                    </div>
                                                    <div class="media-body ml-2 ">
                                                        <h4 class="dropdown-item-title text-sm mb-0 ">
                                                            <?= $row->fullname; ?>
                                                        </h4>
                                                        <p class="text-sm text-muted mb-0"><?= $row->email; ?></p>
                                                    </div>
                                                </div>
                                                <!-- <img src="<?php echo base_url('assets/back') ?><?= $row->avatar ?>" class="img-circle img-size-32 mr-2">
                                                <?= $row->fullname ?> -->
                                            </td>
                                            <td class="text-sm"><?= $row->subject ?></td>
                                            <td class="text-sm">
                                                <?php if ($row->status_ticket == '0') {
                                                    echo '<span class="badge badge-warning">waiting</span>';
                                                } else if ($row->status_ticket == '1') {
                                                    echo '<span class="badge badge-success">process</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger">solved</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-sm">
                                                <a href="<?= base_url('helpdesk/ticket/detail_ticket_user/' . $row->id_ticket) ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a onclick="deleteTicket(<?= $row->id_ticket ?>)" href="#" class="btn btn-danger btn-sm">
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
</div> -->

<!-- <div class="modal fade" id="modal-tiket">
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
</div> -->

<!-- <div class="modal fade" id="modal-reply">
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
</div> -->

<!-- <div class="modal fade" id="modal-closeTiket">
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
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    function crtTicket() {
        window.location.href = "<?= base_url('helpdesk/ticket/new_ticket') ?>"
    }

    function deleteTicket(id) {
        Swal.fire({
            title: 'Delete this ticket?',
            text: `You won't be able to revert this`,
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('helpdesk/ticket/delete_ticket') ?>",
                    data: {
                        id_ticket: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.error);
                        }

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.success,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log("Error response", xhr.status, xhr.responseText, thrownError);
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    }

    function reload() {
        location.reload();
    }
</script>