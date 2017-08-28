<?php
class Request extends CI_Model {
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

    public function getByCreator()
    {
        $userId = $this->session->userdata('userId');
        $query = $this->db->get_where('request', array('creator_id' => $userId));
        return $query->result_array();
    }

    public function getBySlug($slug = false)
    {
        $query = $this->db->get_where('request', array('slug' => $slug));
        return $query->row_array();
    }

    public function setRequests($data)
    {
        $this->load->helper('url');
        $this->load->library('translit');
        $slug = url_title($data['title'], 'dash', TRUE);
        $slug = $this->translit->strToUrl($slug);
        $db_data = array(
            'title' => $data['title'],
            'slug' => $slug,
            'description' => $data['description'],
            'phone' => $data['phone'],
            'image_url' => $data['image_url'],
            'creator_id'=> $this->session->userdata('userId')
        );
        return $this->db->insert('request', $db_data);
    }
}