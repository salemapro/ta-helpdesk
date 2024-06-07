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
                        <!-- <button class="btn btn-primary text-sm float-right" onclick="crtTicket()">Create Ticket</button> -->
                    </div>
                    <div class="card-body table-responsive text-sm">
                        <table id="example1" class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <!-- <th class="nowrap font-weight-light text-sm">No</th> -->
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
                                foreach ($agent as $row) { ?>
                                    <tr>
                                        <!-- <td><?= $no++ ?></td> -->
                                        <td class="text-sm">
                                            <img src="<?php echo base_url('assets/back') ?><?= $row->avatar ?>" class="img-circle img-size-32 mr-2">
                                            <?= $row->fullname ?>
                                        </td>
                                        <td class="text-sm"><?= $row->subject ?></td>
                                        <td class="text-sm">
                                            <?php if ($row->status_ticket == '0') {
                                                echo '<span class="badge badge-warning">waiting...</span>';
                                            } else if ($row->status_ticket == '1') {
                                                echo '<span class="badge badge-success">process..</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">solved</span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-sm">
                                            <?php
                                            if ($row->status_ticket == '0') { ?>
                                                <button class="btn btn-success btn-sm text-sm" onclick="confirm(<?= $row->id_ticket ?>)"> Confirm </button>
                                            <?php } else if ($row->status_ticket == '1') { ?>
                                                <button class="btn btn-warning btn-sm text-sm" onclick="closeTicket(<?= $row->id_ticket . ',\'' . $this->session->fullname . '\'' ?>)"> Close </button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger btn-sm text-sm"> Closed </button>
                                            <?php } ?>
                                        </td>
                                        <td class="text-sm">
                                            <a href="<?= base_url('helpdesk/ticket/detail_ticket_agent/' . $row->id_ticket) ?>" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
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
                    url: "<?php echo base_url('helpdesk/ticket/save_confirm') ?>",
                    data: {
                        id_ticket: id,
                        status_ticket: 1
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
</script>