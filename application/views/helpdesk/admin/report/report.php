<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4 mt-4">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bolder">Report</h1>
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol> -->
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
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
                                                <!-- <img src="<?php echo base_url('assets/back') ?><?= $row->avatar ?>" class="img-circle img-size-32 mr-2">
                                                <?= $row->fullname ?> -->
                                            </td>
                                            <td class="text-sm"><?= $row->subject ?></td>
                                            <td class="text-sm">
                                                <?php if ($row->status_ticket == '0') {
                                                    echo '<span class="badge badge-warning">Waiting...</span>';
                                                    // } else if ($row->status_ticket == '1') {
                                                    //     echo '<span class="badge badge-info">Opened</span>';
                                                } else if ($row->status_ticket == '1') {
                                                    echo '<span class="badge badge-success">Process..</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger">Solved</span>';
                                                }
                                                ?>
                                            </td>
                                            <!-- <td class="text-sm">
                                                <?php
                                                if ($row->status_ticket == '0') { ?>
                                                    <button class="btn btn-success btn-sm text-sm" onclick="confirm(<?= $row->id_ticket ?>)"> confirm </button>
                                                <?php } else if ($row->status_ticket == '1') { ?>
                                                    <button class="btn btn-warning btn-sm text-sm" onclick="closeTicket(<?= $row->id_ticket . ',\'' . $this->session->fullname . '\'' ?>)"> close </button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-sm text-sm"> closed </button>
                                                <?php } ?>
                                            </td> -->
                                            <td class="text-sm">
                                                <!-- <a href="<?= base_url('helpdesk/ticket/detail_ticket_admin/' . $row->id_ticket) ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a onclick="return confirm('Yakin Akan Menghapus?')" href="<?= base_url('tiket/delete_tiket/' . $row->id_ticket) ?>" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
                                                <a href="<?= base_url('helpdesk/report/print_report_admin/' . $row->id_ticket) ?>" class="btn btn-default btn-sm">
                                                    <i class="fa fa-print"></i>
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

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('avatarInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('current-avatar').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });

    $('#updateAccount').on('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: '<?php echo base_url('helpdesk/user/update_account'); ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                console.log("Success response", response);
                if (response.error) {
                    toastr.error(response.error);
                }
                if (response.success) {
                    console.log("Showing Swal.fire");
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.success,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.href = "<?= base_url('helpdesk/user/account_admin') ?>"
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
</script>