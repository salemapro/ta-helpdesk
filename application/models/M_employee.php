<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_employee extends CI_Model
{
    function get_employee()
    {
        $this->db->join('divisi', 'employee.divisi_id = divisi.id_divisi', 'left');
        // $this->db->join('user_role', 'employee.role_id = user_role.id_role', 'left');
        return $this->db->get('employee')->result();
    }

    function data_employee($id)
    {
        $this->db->join('divisi', 'employee.divisi_id = divisi.id_divisi', 'left');
        // $this->db->join('user_role', 'employee.role_id = user_role.id_role', 'left');
        $this->db->where('id_employee', $id);
        return $this->db->get('employee')->row();
    }

    function code_employee()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(user_code,3)) AS code_user FROM employee");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->code_user) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        // date_default_timezone_set('Asia/Jakarta');
        return "EMP" . $kd;
    }

    function save_employee($code_user, $fullname, $email, $company, $divisi, $num_phone,  $update)
    {
        $save = [
            'user_code' => $code_user,
            'email' => $email,
            'fullname' => $fullname,
            // 'password' => $password,
            'num_phone' => $num_phone,
            'company_id' => $company,
            'divisi_id' => $divisi,
            // 'status' => $status,
            'updated_at' => $update
        ];
        // var_dump($save);
        $this->db->insert('employee', $save);
    }

    function update_employee($id_employee, $fullname, $email, $divisi, $num_phone,  $update)
    {
        $save = [
            'id_employee' => $id_employee,
            'email' => $email,
            'fullname' => $fullname,
            'num_phone' => $num_phone,
            'divisi_id' => $divisi,
            'updated_at' => $update
        ];
        // var_dump($save);
        $this->db->where('id_employee', $id_employee);
        $this->db->update('employee', $save);
    }

    public function delete_employee($id)
    {
        return $this->db->delete('employee', ['id_employee' => $id]);
    }
}
