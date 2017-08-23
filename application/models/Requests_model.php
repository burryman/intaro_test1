<?php
class Requests_model extends CI_Model {

		public $id;
		public $title;
		public $phone;
		public $description;
		public $image_url;
		public $slug;

        public function __construct()
        {
                 parent::__construct();
                $this->load->database();
        }

        public function get()
		{
		        
            $query = $this->db->get('request');
            return $query->result_array();
		             
		}

		public function getBySlug($slug = false){

				$query = $this->db->get_where('request', array('slug' => $slug));
		        return $query->row_array();

		}

		public function set_requests($img_url = null)
		{
		    $this->load->helper('url');

		    $slug = url_title($this->input->post('title'), 'dash', TRUE);
		    $img = $img_url;
		    var_dump($img);

		    $data = array(
		        'title' => $this->input->post('title'),
		        'slug' => $slug,
		        'description' => $this->input->post('description'),
		        'phone' => $this->input->post('phone'),
		        'image_url' => $img_url
		    );

		    return $this->db->insert('request', $data);
		}

		
}