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
		        $data['request'] = $this->requests_model->get();
		        $data['title'] = 'Заявки на ремонт';

		        $this->load->view('templates/header', $data);
		        $this->load->view('requests/index', $data);
		        $this->load->view('templates/footer');
		}

        public function view($slug = null)
		{
		        $data['requests_item'] = $this->requests_model->getBySlug($slug);

		        if (empty($data['requests_item'])){
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

		    if ($this->form_validation->run() === false)
		    {
		        $this->load->view('templates/header', $data);
		        $this->load->view('requests/create');
		        $this->load->view('templates/footer');

		    }else{
		    	$img_url = $this->get_img_url();
		        $this->requests_model->set_requests($img_url);
		        $this->load->view('requests/success');
		    }
		}


		public function get_img_url()
		{
		  $info = getimagesize($_FILES['pic']['tmp_name']);
		  $mime = $info['mime'];
		  $img_name = basename($_FILES['pic']['name']);
		  $img_name = str_replace(' ','|',$img_name);
		  $type = explode(".",$img_name);
		  $type = $type[count($type)-1];
		  if ($mime == "image/png")
		  {
		  	$uniq_name = uniqid(rand()).".".$type;
		    $tmppath = "/home/burrman/public_html/site.local/uploads/".$uniq_name; 
		    if(is_uploaded_file($_FILES["pic"]["tmp_name"]))
		    {
		      move_uploaded_file($_FILES['pic']['tmp_name'],$tmppath);
		      $tmppath = "http://site.local/uploads/".$uniq_name; 
		      return $tmppath; 
		    }
		  }else{
		    redirect(base_url() . 'index.php/Welcome/not_img', 'refresh');
		  }

		}
}