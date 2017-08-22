<?php
class Requests_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_requests($slug = FALSE)
		{
		        if ($slug === FALSE)
		        {
		                $query = $this->db->get('request');
		                return $query->result_array();
		        }

		        $query = $this->db->get_where('request', array('slug' => $slug));
		        return $query->row_array();
		}

		public function set_requests()
		{
		    $this->load->helper('url');

		    $slug = url_title($this->input->post('title'), 'dash', TRUE);

		    $data = array(
		        'title' => $this->input->post('title'),
		        'slug' => $slug,
		        'description' => $this->input->post('description')
		    );

		    return $this->db->insert('request', $data);
		}
}