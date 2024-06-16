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
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header">
                        <h3 class="card-title">Data Ticket</h3>
                        <a href="<?= base_url('helpdesk/ticket/add_ticket') ?>" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#form_tiket">
                            Tambah Ticket
                        </a>
                        <button class="btn btn-primary text-sm float-right" onclick="crtTicket()">Create Ticket</button>
                    </div> -->
                        <div class="card-body table-responsive text-sm">
                            <table id="example1" class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="col-ms-1 font-weight-normal text-sm">No</th>
                                        <th class="font-weight-normal text-sm">Customer</th>
                                        <th class="font-weight-normal text-sm">Ticket Summary</th>
                                        <th class="font-weight-normal text-sm">Agent</th>
                                        <th class="font-weight-normal text-sm">Status</th>
                                        <th class="font-weight-normal text-sm">Confirm</th>
                                        <th class="font-weight-normal text-sm">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($ticket as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td class="text-sm">
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
                                            </td>
                                            <td class="text-sm"><?= $row->subject ?></td>
                                            <td class="text-sm"><?= $row->divisi ?></td>
                                            <td class="text-sm">
                                                <?php if ($row->status_ticket == '0') {
                                                    echo '<span class="badge badge-warning">Waiting</span>';
                                                    // } else if ($row->status_ticket == '1') {
                                                    //     echo '<span class="badge badge-info">Opened</span>';
                                                } else if ($row->status_ticket == '1') {
                                                    echo '<span class="badge badge-success">Process</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger">Solved</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-sm">
                                                <?php
                                                if ($row->status_ticket == '0') { ?>
                                                    <button class="btn btn-success btn-sm text-sm" onclick="confirm(<?= $row->id_ticket ?>)"> confirm </button>
                                                <?php } else if ($row->status_ticket == '1') { ?>
                                                    <button class="btn btn-warning btn-sm text-sm" onclick="closeTicket(<?= $row->id_ticket . ',\'' . $this->session->fullname . '\'' ?>)"> close </button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-sm text-sm"> closed </button>
                                                <?php } ?>
                                            </td>
                                            <td class="text-sm">
                                                <a href="<?= base_url('helpdesk/ticket/detail_ticket_admin/' . $row->id_ticket) ?>" class="btn btn-primary btn-sm">
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
        window.location.href = "<?= base_url('helpdesk/ticket/new_ticket_admin') ?>"
    }

    function confirm(id) {
        Swal.fire({
            title: 'Confirm ticket ini?',
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
                    url: "<?php echo base_url('') ?>",
                    data: {
                        id_ticket: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'konfirmasi',
                                text: response.success,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    }
                });
            }
        })
    }

    function closeTicket(id, user) {
        Swal.fire({
            title: 'Close this ticket?',
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
                    url: "<?php echo base_url('helpdesk/ticket/close_confirm') ?>",
                    data: {
                        id_ticket: id,
                        status_ticket: 2,
                        solved_by: user
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