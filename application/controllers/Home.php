<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//tyaa 6
//Контроллер главной страницы
class Home extends CI_Controller {

	public function index()
	{
            //tyaa 7
            //Тестовый вывод строки в браузер
            //echo 'Hello World!';
            
            //tyaa 9
            //Тестовый вывод представления page1
            //$this->load->view('page1');
            
            //tyaa 10
            //Вывод представления page1
            //с передачей ему параметров
            $data['title'] = 'Страница1';
            $data['text'] = 'Это представление page1, выданное контроллером Home';
            $data['countries'] =
                array('Argentina','Belgium','Canada','Great Britain', 'Japan', 'Russia', 'Ukraine', 'USA');
            $this->load->view('page1', $data);
	}
        
        //tyaa 13
        //Внедрение зависимости модели
        public function __construct()
        {
            parent::__construct();
            $this->load->model('home_model');
        }
        
        //tyaa 14
        //Загрузка данных при помощи модели
        //и передача их в представление
        public function ItemsList() {
            $data['title'] = 'Список товаров';
            $data['items'] = $this->home_model->getItems();
            $this->load->view('items', $data);
        }

}
