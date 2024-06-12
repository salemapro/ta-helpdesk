<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4 mt-4">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bolder">Subject</h1>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-11">
                            <button class="btn btn-primary text-sm float-right" onclick="crtSub()">Create Subject</button>
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
                        <h3 class="card-title">Subject</h3>
                        <button class="btn btn-primary btn-lg text-sm float-right" onclick="crtSub()">Create Subject</button>
                    </div> -->
                        <div class="card-body table-responsive text-sm">
                            <table id="example1" class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="col-md-1 font-weight-normal text-sm">No</th>
                                        <th class="font-weight-normal text-sm">Subject</th>
                                        <th class="font-weight-normal text-sm">Divisi</th>
                                        <th class="font-weight-normal text-sm">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($sub as $key => $row) { ?>
                                        <tr>
                                            <td class="font-weight-normal text-sm"><?= $no++ ?></td>
                                            <td class="font-weight-normal text-sm">
                                                <?= $row->subject ?><br>
                                            </td>
                                            <td class="font-weight-normal text-sm">
                                                <?= $row->divisi ?><br>
                                            </td>
                                            <td nowrap>
                                                <button title=" Update" class="btn btn-sm btn-success" onclick="get_sub(<?= $row->id_subject ?>);">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <!-- &nbsp; -->
                                                <button title="Delete" onclick="deleteConfirm(<?= $row->id_subject ?>);" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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

<script type="text/javascript">
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    function crtSub() {
        window.location.href = "<?= base_url('helpdesk/subject/add_subject') ?>"
    }

    function get_sub(id) {
        var id_subject = id
        if (id_subject != "") {
            window.location.href = "<?= base_url('helpdesk/subject/edit_subject/') ?>" + id_subject;
        } else {
            alert('Oops.!!');
        }
    }

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You won't be able to revert this`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('helpdesk/subject/delete_subject') ?>",
                    data: {
                        id_subject: id,
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

    function reload() {
        location.reload();
    }
</script>