<?php
$this->load->view('header');

if(isset($error))
{
	echo '<div style="color:red;">';
	echo '<ul>';
	foreach ($error as $item => $value)
	{
		echo '<li>'.$item.':'.$value.'</li>';
	}
	echo '</div>';
	echo '</ul>';
}
if(isset($success))
{
	echo '<div style="color:green;">';
	echo '<ul>';
	// var_dump($success);
	foreach ($success as $item => $value)
	{
		echo '<li>'.$item.':'.$value['result']['file_name'].'</li>';
	}
	echo '</div>';
	echo '</ul>';
}


$st['class']='form-horizontal';
echo form_open_multipart('home/selectMultipleImages',$st);
echo '<div class="col-md-offset-3">';
echo form_label('Select image ',
	'upfile[]',array('class'=>'control-label'));
echo '&nbsp;';
echo form_upload('upfile[]','','multiple');
echo '&nbsp;';
echo form_submit(array('name'=>'send','value'=>'Send',
	'class'=>'btn btn-success'));
echo '</div>';
echo form_close();
$this->load->view('footer');