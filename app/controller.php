<?php

require_once __DIR__ . '/model.php';

$players = new Players();

  /*if($_POST['action'] == 'delete'):
    if($usersModel->delete_user($_POST['id']) == 1):
      $arrayName = array('status' => 'true' );
      echo json_encode($arrayName);
    endif;
  endif;


  if($_POST['action'] == 'view'):
    $user = $usersModel->view_user($_POST['id']);
    $data = array('action' =>'update','id' =>$user['id'],'name' =>$user['firstname'],'lastname' =>$user['lastname'],'email' =>$user['email'],'password' =>$user['password']);
      echo json_encode($data);
  endif;

  if($_POST['action'] == 'new'):
    $data = array($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['password']);
    if($usersModel->new_user($data) == 1):
      $arrayName = array('status' => 'true' );
      echo json_encode($arrayName);
    endif;
  endif;

  if($_POST['action'] == 'update'):
    $data = array($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['password']);
    if($usersModel->update_user($data) == 1):
      $arrayName = array('status' => 'true' );
      echo json_encode($arrayName);
    endif;
  endif;*/

?>
