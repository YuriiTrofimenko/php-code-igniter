<?php

//tyaa 12
//Модель данных для главной страницы
class Home_model extends CI_Model {

    //Соединение с БД
    public function __construct() {
        $this->load->database();
    }
    
    //Метод получения данных о товарах из БД
    public function getItems()
    {
        $res = $this->db->get('items');
        return $res->result_array();
    }

    public function getItemById($id)
    {
        $query = $this->db->get_where('items', array('id' => $id));
        return $query->result_array();
    }

    public function addImages($data)
    {
        $insert = $this->db->insert("Images", $data);
        if($insert)
        {
            return $this->db->insert_id();
        }
        else
        {
         return false;
     }
 }

 public function setImageExt($id, $path)
 {
    $data = array(
        //'title' => $title,
        //'name' => $name,
        'imagepath' => $path
    );

    $this->db->where('id', $id);
    $this->db->update('Images', $data);
}
}
