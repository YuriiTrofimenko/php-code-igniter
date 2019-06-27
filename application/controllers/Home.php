<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//tyaa 6
//Контроллер главной страницы
class Home extends CI_Controller {

        //http://localhost/appci1/index.php/home/index
        //or
        //http://localhost/appci1/
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
        //http://localhost/index.php/home/ItemsList
        //or
        //http://localhost/appci1/index.php/home/ItemsList
    public function ItemsList() {

            //echo '<pre>';
            //var_dump($this->home_model->getItems());
            //echo '</pre>';
        $data['title'] = 'Список товаров';
        $data['items'] = $this->home_model->getItems();

            //echo '<pre>';
            //var_dump($data);
            //echo '</pre>';

        $this->load->view('items', $data);

    }

    public function getItemInfo()
    {
     $send=$this->input->post('send');
     if(!$send)
        $this->load->view('form_item_id');
    else
    {
     $id=$this->input->post('itemid');
     $item=$this->home_model->getItemById($id);
     $data['item']=$item;
     $data['title']='Description Of Items '.$id;
     $this->load->view('item_info',$data);
 }
}

public function getItemInfo2()
{
    if(!$this->input->post('send')){
            //Формируем данніе для віпадающего списка
        $data['list'] = $this->home_model->getItems();
        //var_dump($data);
        //die();
        $this->load->view('form_item_id2',$data);
    } else {
            //Отображаем подробности о вібранном пункте
       $id=$this->input->post('itemid');
       $item=$this->home_model->getItemById($id);
       $data['item']=$item;
       $data['title']='Description Of Items '.$id;
       $this->load->view('item_info',$data);
   }
}

public function selectImages(){
    $send=$this->input->post('send');
    if(!$send)
        $this->load->view('form_upload');
    else
    {
        $file_name = uniqid();

        $config['upload_path'] = './assets/images/';
        $config['file_name'] = $file_name;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 10000;
        $config['max_width'] = 3000;
        $config['max_height'] = 2000;
        $this->load->library('upload', $config);

            //$data = array('error' => $this->upload->display_errors());
            //$this->load->view('form_upload', $data);

            //Save imege's path to db
        $data = array('itemid'=>9, 'imagepath'=>'/assets/images/'.$file_name);
        $image_id = $this->home_model->addImages($data);
            //var_dump($image_id);
            //die();
            // Render the view with model
        if ($image_id) {

            if ($this->upload->do_upload('image')) {

                $upload_result = $this->upload->data();
                $view_model = array('result' => $upload_result);
                // $path_parts = pathinfo($view_model['result']['file_name']);
                // $file_extention = $path_parts['extension'];
                //$this->home_model->setImageExt($image_id, $file_name.'.'.$file_extention);
                $this->home_model->setImageExt($image_id, $upload_result['file_name']);
                $this->load->view('form_upload', $view_model);
            } else {
                $data = array('error' => $this->upload->display_errors());
                $this->load->view('form_upload', $data);
            }
        } else {
            $data = array('error' => 'DB Error');
            $this->load->view('form_upload', $data);
        }
    }
}

public function selectMultipleImages(){
    $send=$this->input->post('send');
    if(!$send)
        $this->load->view('form_upload_multiple');
    else
    {

        $number_of_files = sizeof($_FILES['upfile'] ['tmp_name']);
         //we create array $files out of uploaded files
        $files = $_FILES['upfile'];
        $error = array();
        $success = array();

        for ($i=0; $i < $number_of_files; $i++) {

            $file_name = uniqid();
            $config['upload_path'] = './assets/images/';
            $config['file_name'] = $file_name;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10000;
            $config['max_width'] = 3000;
            $config['max_height'] = 2000;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $_FILES['upfile']['name'] = $files['name'][$i];
            $_FILES['upfile']['type'] = $files['type'][$i];
            $_FILES['upfile']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['upfile']['error'] = $files['error'][$i];
            $_FILES['upfile']['size'] = $files['size'][$i];

            $data = array('itemid'=>9, 'imagepath'=>'/assets/images/'.$file_name);
            $image_id = $this->home_model->addImages($data);

            if ($image_id) {

                if ($this->upload->do_upload('upfile')) {

                    $upload_result = $this->upload->data();
                    $view_model = array('result' => $upload_result);
                    $this->home_model->setImageExt($image_id, $upload_result['file_name']);
                    $success['msg'.$i] = $view_model;
                } else {
                    $data = array('error' => $this->upload->display_errors());
                    $error['msg'.$i] = array('error' => $this->upload->display_errors());
                }
            } else {
                $error['msg'.$i] = array('error' => 'DB Error');
            }
        }
        // Render the view with model
        $result['error']=$error;
        $result['success']=$success;
        $this->load->view('form_upload_multiple', $result);
    }
}

public function registration(){
    // $this->load->view('form_validation');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('login',
       'User name',
       'trim|required|min_length[8]|max_length[16]|is_unique[customers.login]',
       array('required' => 'You have not filled %s.',
           'is_unique' => 'Value %s already exists.')
   );
    $this->form_validation->set_rules('pass1',
       'Password',
       'trim|required|min_length[8]|max_length[16]');
    $this->form_validation->set_rules('pass2', 'Password Confirmation',
       'required|matches[pass1]');
    $this->form_validation->set_rules('email',
       'Email',
       'required|valid_email');
    if ($this->form_validation->run() == FALSE)
    {
        $this->load->view('form_validation');
    }
    else
    {
        $data['success']='Form data passed the validation';
        $this->load->view('form_validation',$data);
    }
}

}
