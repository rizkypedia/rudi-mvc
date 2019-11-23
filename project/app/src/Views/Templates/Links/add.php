<?php
$this->layout('shared::rudi_template', array('title' => 'Add new Link'));
echo "<h2>" . $message . "</h2>";

echo (isset($form_message) ? $form_message : "");

echo $form;