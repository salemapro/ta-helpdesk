<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_client extends CI_Model
{
    function get_client()
    {
        $this->db->join('company', 'client.company_id = company.id_company', 'left');
        // $this->db->join('user_role', 'client.role_id = user_role.id_role', 'left');
        return $this->db->get('client')->result();
    }

    function data_client($id)
    {
        $this->db->join('company', 'client.company_id = company.id_company', 'left');
        // $this->db->join('user_role', 'client.role_id = user_role.id_role', 'left');
        $this->db->where('id_client', $id);
        return $this->db->get('client')->row();
    }

    function get_company()
    {
        return $this->db->get('company')->result();
    }

    function get_app()
    {
        $this->db->join('company', 'application.company_id = company.id_company', 'left');
        return $this->db->get('application')->result();
    }

    function get_company_user($id_user)
    {
        // $this->db->join('company', 'user.company_id = company.id_company', 'left');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $company_id = $row->company_id;
            }
        }

        $this->db->from('company');
        $this->db->where('id_company', $company_id);
        return $this->db->get()->result();

        // return null;
    }

    function get_application($company)
    {
        // $this->db->join('company', 'application.company_id = company.id_company', 'left');
        // return $this->db->get('application')->result();
        $this->db->from('application');
        $this->db->where('company_id', $company);
        return $this->db->get()->result();
    }

    function code_client()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(user_code,3)) AS code_user FROM client");
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
        return "CLN" . $kd;
    }

    function insert($company)
    {
        return $this->db->insert('company', $company);
    }

    function save_client($code_user, $fullname, $email, $num_phone, $company,  $update)
    {
        $save = [
            'user_code' => $code_user,
            'email' => $email,
            // 'password' => $password,
            'fullname' => $fullname,
            'num_phone' => $num_phone,
            'company_id' => $company,
            // 'role_id' => $role,
            // 'status' => $status,
            'updated_at' => $update
        ];
        // var_dump($save);
        $this->db->insert('client', $save);
    }

    public function save_company($company)
    {
        $simpan = [
            'company' => $company,
        ];
        $this->db->insert('company', $simpan);
    }

    public function save_app($app, $company_id)
    {
        $simpan = [
            'application' => $app,
            'company_id' => $company_id
        ];
        $this->db->insert('application', $simpan);
    }

    public function data_company($id)
    {
        return $this->db->get_where('company', ['id_company' => $id]);
    }

    public function data_app($id)
    {
        $this->db->join('company', 'application.company_id = company.id_company', 'left');
        $this->db->where('id_application', $id);
        return $this->db->get('application')->row();
    }

    function update_client($id_client, $fullname, $email, $num_phone, $company, $update)
    {
        $save = [
            'id_client' => $id_client,
            'email' => $email,
            'fullname' => $fullname,
            'num_phone' => $num_phone,
            'company_id' => $company,
            // 'role_id' => $role,
            // 'status' => $status,
            'updated_at' => $update
        ];
        // var_dump($save);
        $this->db->where('id_client', $id_client);
        $this->db->update('client', $save);
    }

    public function update_company($id, $company)
    {
        $update = [
            'id_company' => $id,
            'company' => $company
        ];
        $this->db->where('id_company', $id);
        $this->db->update('company', $update);
    }

    public function update_app($id, $app, $company_id)
    {
        $update = [
            'id_application' => $id,
            'application' => $app,
            'company_id' => $company_id
        ];
        // var_dump($update);
        $this->db->where('id_application', $id);
        $this->db->update('application', $update);
    }

    public function delete_client($id)
    {
        return $this->db->delete('client', ['id_client' => $id]);
    }

    public function delete_company($id)
    {
        return $this->db->delete('company', ['id_company' => $id]);
    }

    public function delete_app($id)
    {
        return $this->db->delete('application', ['id_app' => $id]);
    }
}
