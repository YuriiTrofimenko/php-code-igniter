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
            $data['title'] = 'Page1';
            $data['text'] = 'This text was send from Home controller';
            $data['countries'] = array('Argentina','Belgium','Canada','Great Britain');
            $this->load->view('page1', $data);
	}
}
