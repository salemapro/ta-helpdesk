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
                        <h3 class="card-title">Divisi</h3>
                        <button class="btn btn-primary btn-lg text-sm float-right" onclick="crtDept()">Create Divisi</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Divisi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($dept as $key => $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?= $row->divisi ?><br>
                                            <!-- <p class="text-black-50 font-weight-light text-sm"><i class="fas fa-envelope"></i> <?= $row->email ?></p> -->
                                        </td>
                                        <td nowrap align="center">
                                            <button title="Update" class="btn btn-sm btn-success" onclick="get_dept(<?= $row->id_divisi ?>);">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            &nbsp;
                                            <button title="Delete" onclick="deleteConfirm(<?= $row->id_divisi ?>);" class="btn btn-sm btn-danger">
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
    </section>
</div>

<script type="text/javascript">
    function crtDept() {
        window.location.href = "<?= base_url('helpdesk/divisi/add_divisi') ?>"
    }

    function get_dept(id) {
        var id_divisi = id
        if (id_divisi != "") {
            window.location.href = "<?= base_url('helpdesk/divisi/edit_divisi/') ?>" + id_divisi;
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
                    url: "<?php echo base_url('helpdesk/divisi/delete_divisi') ?>",
                    data: {
                        id_divisi: id,
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
</script>