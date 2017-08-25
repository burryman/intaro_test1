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
        $slug = url_title($data['title'], 'dash', TRUE);
        $slug = $this->strToUrl($slug);
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

    protected function translit($string)
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );

        return strtr($string, $converter);
    }

    protected function strToUrl($str)
    {
        // переводим в транслит
        $str = $this->translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }

}