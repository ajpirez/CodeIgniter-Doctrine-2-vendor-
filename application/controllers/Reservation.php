<?php

class Reservation extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Reservation');
        $this->load->library('doctrine');
        $this->load->library('unit_test');
    }

    public function index()
    {
		 // testing
//        $em = $this->doctrine->em;
//        $contactType = $em->getRepository('Entity\Type');
//        $selContactType = $contactType->findAll();
//        $test = $selContactType;
//        $result = 'is_array';
//        $nombre = 'Is Array?';
//        $datos['prueba'] = $this->unit->run($test,$result,$nombre);

        $em = $this->doctrine->em;
        $contactType = $em->getRepository('Entity\Type');
        $selContactType = $contactType->findAll();
        $contact = $em->getRepository('Entity\Contact');
        $selContact = $contact->findAll();
        $data['content'] = "reservation/index";
        $data['title'] = "<h5 style='color: red; margin-left: 30px'>Create Reservation</h5>";
        $data['action'] = 'create';
        $data['selReservation'] = $this->Model_Reservation->sel_reservation();
        $data['selContactType'] = $selContactType;
        $this->load->view("plantilla", $data);
    }

    // dob date of birth
    public function insert()
    {
        $datos = $this->input->post();
        // with database reference
        /*
        if (isset($datos['name']) && isset($datos['dob']) && isset($datos['contact_type'])) {
            if ((int)$datos['name'] != 0) throw new Exception('Name is not string');
            if ((int)$datos['phone'] === 0) throw new Exception('Phone is not int');
            $nombre = $datos['name'];
            $contact_type = $datos['contact_type'];
            $phone = $datos['phone'];
            $dob = $datos['dob'];
            $description = $datos['description'];
            $this->Model_Reservation->insertReservation($nombre, $contact_type, $phone, $dob, $description);
            redirect(' ');
        }*/
        //with doctrine

        if ($datos['phone'] === '') {
            $tel = 0;
        } else {
            $tel = $datos['phone'];
            }
        if (isset($datos['name']) && isset($datos['dob']) && isset($datos['contact_type'])) {
            if ((int)$datos['name'] != 0) throw new Exception('Name is not string');
            $em = $this->doctrine->em;
            $contactType = $em->getRepository('Entity\Type');
            $selContactType = $contactType->findOneById($datos['contact_type']);
            $contact = new \Entity\Contact;
            $contact->setNombre($datos['name']);
            $contact->setDob(new \DateTime($datos['dob']));
            $contact->setPhone($tel);
            $contact->setDescription($datos['description']);
            $contact->setContactType($selContactType);
            $em->persist($contact);
            $em->flush();
            redirect(' ');
        }
    }

    public function listReservation()
    {
        $data['content'] = "reservation/list";
        $data['action'] = 'list';
        $data['title'] = "<h5 style='color: red; margin-left: 30px'>List Reservation</h5>";
        $data['selReservation'] = $this->Model_Reservation->sel_reservation();
        $this->load->view("plantilla", $data);
    }

    public function grid()
    {
        $datos = $this->input->post();
        print_r($this->Model_Reservation->listar($datos));
    }

    public function edit($id)
    {
        $em = $this->doctrine->em;
        $contactType = $em->getRepository('Entity\Type');
        $selContactType = $contactType->findAll();
        $data['content'] = "reservation/edit";
        $data['action'] = "edit";
        $data['title'] = "<h5 style='color: red; margin-left: 30px'>Edit</h5>";
        $data['selContactType'] = $selContactType;
        $data['getContact'] = $this->Model_Reservation->edit($id);
        $this->load->view("plantilla", $data);
    }

    public function update()
    {
        $datos = $this->input->post();
        if ($datos['phone'] === '') {
            $tel = 0;
        } else {
            $tel = $datos['phone'];
        }
        if (isset($datos['name']) && isset($datos['dob']) && isset($datos['contact_type'])) {
            if ((int)$datos['name'] != 0) throw new Exception('Name is not string');
            $id = $datos['id'];
            $nombre = $datos['name'];
            $contact_type = $datos['contact_type'];
            $phone = $tel;
            $dob = $datos['dob'];
            $description = $datos['description'];
            $this->Model_Reservation->updateReservation($id, $nombre, $contact_type, $phone, $dob, $description);
            redirect('reservation/listReservation');
        }
    }

    public function delete()
    {
        $datos = $this->input->post();
        print_r($this->Model_Reservation->delete($datos));
    }
}
