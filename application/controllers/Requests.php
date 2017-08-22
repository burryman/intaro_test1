<?php
class Requests extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('requests_model');
        }

        public function index()
		{
		        $data['request'] = $this->requests_model->get_requests();
		        $data['title'] = 'Заявки на ремонт';

		        $this->load->view('templates/header', $data);
		        $this->load->view('requests/index', $data);
		        $this->load->view('templates/footer');
		}

        public function view($slug = NULL)
		{
		        $data['requests_item'] = $this->requests_model->get_requests($slug);

		        if (empty($data['requests_item']))
		        {
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

		    $data['title'] = 'Создание заявки';

		    $this->form_validation->set_rules('title', 'Title', 'required');
		    $this->form_validation->set_rules('description', 'Description', 'required');
		    $this->form_validation->set_rules('phone', 'Phone', 'required');

		    if ($this->form_validation->run() === FALSE)
		    {
		        $this->load->view('templates/header', $data);
		        $this->load->view('requests/create');
		        $this->load->view('templates/footer');

		    }
		    else
		    {
		        $this->requests_model->set_requests();
		        $this->load->view('requests/success');
		    }
		}

		public function get_img_url()
		{
		  $url = "../images";
		  $image=basename($_FILES['pic']['name']);
		  $image=str_replace(' ','|',$image);
		  $type = explode(".",$image);
		  $type = $type[count($type)-1];
		  if (in_array($type,array('jpg','jpeg','png','gif')))
		  {
		    $tmppath="images/".uniqid(rand()).".".$type; 
		    if(is_uploaded_file($_FILES["pic"]["tmp_name"]))
		    {
		      move_uploaded_file($_FILES['pic']['tmp_name'],$tmppath);
		      return $tmppath; 
		    }
		  }
		  else
		  {
		    redirect(base_url() . 'index.php/Welcome/not_img', 'refresh');
		  }
		}



}