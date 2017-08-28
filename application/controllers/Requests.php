<?php
class Requests extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('request');
        $this->load->helper('xml');
    }

    public function index()
    {
        $data = $this->loadIndex();

        if (isset($_GET['requests'])) {
            $id = $_GET['requests'];
            if($id == 'last') {
                $tmp = array_pop($data['request']);
                $tmp['title'] = "<h2>" . $tmp['title'] . "</h2>";
                array_push($data['request'], $tmp);
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('requests/index', $data);
        $this->load->view('templates/footer');
    }

    protected function loadIndex()
    {
        $data['title'] = 'Заявки на ремонт';
        if ($this->session->userdata('isUserLoggedIn')) {
            if ($this->session->userdata('admin')) {
                $data['request'] = $this->request->get();
        } else {
                $data['request'] = $this->request->getByCreator();
            }
        }

        return $data;
    }

    public function view($slug = null)
    {
        $data['requests_item'] = $this->request->getBySlug($slug);

        if (empty($data['requests_item'])) {
            show_404();
        }

        $data['title'] = $data['requests_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('requests/view', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $validImg = array('image/png', 'image/gif', 'image/jpeg');
        $data['title'] = 'Создание заявки';

        $create_data['title'] = $this->input->post('title');;
        $create_data['description'] = $this->input->post('description');
        $create_data['phone'] = $this->input->post('phone');
        $create_data['image_url'] = false;

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        if (!in_array($this->getMime(), $validImg) && !empty($_FILES['pic']['tmp_name'])) {
            $this->form_validation->set_rules('pic', 'Photo', 'matches[pic]');
        }

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header', $data);
            $this->load->view('requests/create');
            $this->load->view('templates/footer');
        } else {
            if (!empty($_FILES['pic']['tmp_name'])) {
                $create_data['image_url'] = $img_url = $this->getImgUrl();
            }

            $this->request->setRequests($create_data);
            redirect('?requests=last');
        }
    }

    protected function getMime()
    {
        if (!empty($_FILES['pic']['tmp_name'])) {
            $info = getimagesize($_FILES['pic']['tmp_name']);
            $mime = $info['mime'];
            return $mime;
        }
    }

    protected function getImgUrl()
    {
        $img_info = pathinfo($_FILES['pic']['name']);
        $uniq_name = uniqid(rand()).".".$img_info['extension'];
        $tmppath = FCPATH."uploads/".$uniq_name;

        if (is_uploaded_file($_FILES["pic"]["tmp_name"])) {
            move_uploaded_file($_FILES['pic']['tmp_name'],$tmppath);
            $img_url = 'uploads/'.$uniq_name; 
            return $img_url; 
        }
    }

	protected function createXML($data)
    {
        $requestsXML = new SimpleXMLElement("<requests></requests>");
        foreach ($data['request'] as $requestsItem){
            $request = $requestsXML->addChild('request');
            $request->addAttribute('id', $requestsItem['id']);

            $title = $request->addChild('title', $requestsItem['title']);
            $phone = $request->addChild('phone', $requestsItem['phone']);
            $desc = $request->addChild('desc', $requestsItem['description']);
            $img = $request->addChild('image', $requestsItem['image_url']);

        }
        return $requestsXML->asXML();
    }

    public function download()
    {
        $xml = $this->createXML($this->loadIndex());
        force_download('requests.xml', $xml);
    }
}