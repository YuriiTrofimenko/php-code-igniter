<?php
$this->load->view('header');
$st['class']='form-horizontal';
echo form_open('home/getItemInfo2',$st);
echo '<div class="">';
echo form_label('Select item','item_select',array('class'=>'control-label'));
echo '<select id="item_select" name="itemid">';
foreach ($list as $l){
	echo '<option value='.$l['id'].'>';
	echo $l['itemname'];
	echo '</option>';
}
echo '</select>';
echo form_submit(array('name'=>'send','value'=>'Send',
	'class'=>'btn btn-success'));
echo '</div>';
echo form_close();
$this->load->view('footer');
