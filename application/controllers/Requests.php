<?php
class Requests extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('requests_model');
	}

	public function index()
	{
		$data['title'] = 'Заявки на ремонт';
		if($this->session->userdata('isUserLoggedIn')) {
			if($this->session->userdata('admin')) {
				$data['request'] = $this->requests_model->get();
			} else {
				$data['request'] = $this->requests_model->getByCreator();
			}
		}
		$this->load->view('templates/header', $data);
		$this->load->view('requests/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($slug = null)
	{
		$data['requests_item'] = $this->requests_model->getBySlug($slug);

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

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');

		if (!in_array($this->getMime(), $validImg)) {
			$this->form_validation->set_rules('pic', 'Photo', 'matches[pic]');
		}else{
			//$this->form_validation->set_rules('pic', 'Photo', 'required');
		}

		if ($this->form_validation->run() === false) {
			$this->load->view('templates/header', $data);
			$this->load->view('requests/create');
			$this->load->view('templates/footer');
		} else {
			$img_url = $this->getImgUrl();
			$this->requests_model->setRequests($img_url);
			redirect('requests');
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
		$img_name = pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
		$type = explode(".",$img_name);
		$type = $type[count($type)-1];
		$uniq_name = uniqid(rand()).".".$type;
		$tmppath = FCPATH."/uploads/".$uniq_name;

		if (is_uploaded_file($_FILES["pic"]["tmp_name"])) {
			move_uploaded_file($_FILES['pic']['tmp_name'],$tmppath);
			$tmppath = "http://site.local/uploads/".$uniq_name; 
			return $tmppath; 
		}
	}
}