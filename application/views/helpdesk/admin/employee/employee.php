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
                        <h3 class="card-title">Employee</h3>
                        <!-- <a href="<?= base_url('') ?>" class="btn btn-primary btn-sm float-right ">Create User</a> -->
                        <button class="btn btn-primary btn-lg text-sm float-right" onclick="crtEmp()">Create Employee</button>

                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <!-- <th>Company</th> -->
                                    <th>Divisi</th>
                                    <!-- <th>Status</th> -->
                                    <!-- <th>Role</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($emp as $key => $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?= $row->fullname ?><br>
                                            <p class="text-black-50 font-weight-light text-sm"><i class="fas fa-envelope"></i> <?= $row->email ?></p>
                                        </td>
                                        <td>
                                            <?= $row->divisi ?>
                                        </td>
                                        <!-- <td>
                                            <?php if ($row->status == '1') {
                                                echo 'Active';
                                            } else {
                                                echo 'Non Active';
                                            }
                                            ?>
                                        </td> -->
                                        <!-- <td>
                                            <?= $row->role ?>
                                        </td> -->
                                        <td nowrap align="center" <?= $code = $row->user_code ?>>
                                            <button title="Update" class="btn btn-sm btn-success" onclick="get_emp(<?= $row->id_employee ?>);">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            &nbsp;
                                            <button title="Delete" onclick="deleteConfirm(<?= $row->id_employee . ',\'' . $code . '\'' ?> );" class="btn btn-sm btn-danger">
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
    function crtEmp() {
        window.location.href = "<?= base_url('helpdesk/employee/add_employee') ?>"
    }

    function get_emp(id) {
        var id_employee = id
        if (id_employee != "") {
            window.location.href = "<?= base_url('helpdesk/employee/edit_employee/') ?>" + id_employee;
        } else {
            alert('Oops.!!');
        }
    }

    function deleteConfirm(id, code) {
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
                    url: "<?php echo base_url('helpdesk/employee/delete_employee') ?>",
                    data: {
                        id_employee: id,
                        code: code,
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