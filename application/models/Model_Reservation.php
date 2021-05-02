<?php

class Model_Reservation extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function sel_reservation()
    {
        try {
            $sql = $this->db->query('Select c.*,ct.nombre as contact_type from contact c left join type ct on(c.type_id = ct.id)');
            return $sql->result();
        } catch (Exception $e) {
            print_r($e->getMessage());
        }

    }

    public function sel_contact_Type()
    {
        try {
            $sql = $this->db->query('Select * from contact_type');
            return $sql->result();
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function insertReservation($nombre, $contact_type, $phone, $dob, $description)
    {
        try {
            $array = array(
                'nombre' => $nombre,
                'type_id' => $contact_type,
                'phone' => $phone,
                'dob' => $dob,
                'description' => $description
            );
            $this->db->insert('contact', $array);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function listar($datos)
    {
        try {
            $limit = (int)$datos['limite'];
            $start = (int)$datos['pagina'] - 1;
            if ($start > 0) $start = $start * $limit;
            $columna = $datos['columna'];
            if ($columna === 'contact_type') $columna = $columna . '_id';
            $columna_orden = ($datos['columna_orden']) ? $datos['columna_orden'] : 'desc';
            $query = 'select c.*,ct.nombre as contact_type
                   from contact c inner join type ct on(c.type_id = ct.id)
                   order by ' . 'c.' . $columna . ' ' . $columna_orden . ' limit ' . $limit . ' offset ' . $start;
            $sql = $this->db->query($query);
            $sql2 = $this->db->query('
                Select c.*,ct.nombre as contact_type
                from contact c left join type ct on(c.type_id = ct.id)');
            $data2 = $sql2->result();

            $data = $sql->result();
            $count = count($data2);
            return json_encode(array(
                'data' => $data,
                'total' => $count
            ));
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

//dob format 2021-03-30
    public function edit($id)
    {
        try {
            $id = (int)$id;
            $sql = $this->db->query('Select c.*,ct.nombre as contact_type
                from contact c left join type ct on(c.type_id = ct.id)
                where c.id = ? ', array($id));
            $datos = $sql->result()[0];
            $dobs = explode(" ", $datos->dob);
            $datos->dob = $dobs[0];
            return $datos;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function updateReservation($id, $nombre, $contact_type, $phone, $dob, $description)
    {
        try {
            $nombre = "'" . $nombre . "'";
            $dob = "'" . $dob . "'";
            $description = "'" . $description . "'";
            $query = 'UPDATE `contact` SET nombre=' . $nombre . ',' . 'type_id=' . $contact_type . ',' . 'phone=' . $phone . ',' . 'dob=' . $dob . ',' . 'description=' . $description . ' ' .
                'where ' . 'id=' . $id;
            $sql = $this->db->query($query);
            return;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function delete($data)
    {
        try {
            $response = new stdClass();
            $id = (int)$data['id'];
//            $sql = $this->db->query('delete from contact where id = ?',array($id));
            $this->db->where('id', $id);
            $this->db->delete('contact');
            $response->response = true;
            $response->message = 'Deleted!';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
        return json_encode($response);
    }

}
