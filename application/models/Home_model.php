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
}
