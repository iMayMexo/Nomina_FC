<?php
    require_once __DIR__ . '/helpers.php';

    class Players 
    {
        public function __construct()
        {
            $json = file_get_contents(__DIR__ . "/data.json");
	        $json = json_encode($json);
            $json = json_decode($json, true);
            ___($json,true,true);
        }

        /*public function get_users()
        {
            $users = $this->_db->prepare('SELECT * FROM user ORDER BY id ASC');
            $users->execute();
            $users = $users->fetchAll();
            return $users;
        }

        public function new_user($data)
        {
            if (is_object($this->_db)){
                $insert = $this->_db->prepare('INSERT INTO user (firstname,lastname,email,password)
            values (:firstname,:lastname,:email,:password) ');
                $insert->execute(array(
                    ':firstname'=> $data[0],
                    ':lastname'=> $data[1],
                    ':email'=> $data[2],
                    ':password'=> $data[3],
                ));
                $insert = $insert->rowCount();
            }
            else{
                var_dump($this->_db);
                exit();
            }
            return $insert;
        }

        public function update_user($data)
        {
            $update = $this->_db->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id');
            $update->execute(array(':id'=> $data[0],':firstname'=> $data[1],':lastname'=> $data[2],':email'=> $data[3],':password'=> $data[4]));
            $update = $update->rowCount();
            return $update;
        }

        public function delete_user($data)
        {
            $delete = $this->_db->prepare('DELETE FROM user WHERE id = :data');
            $delete->execute(array(':data'=>$data));
            $delete = $delete->rowCount();
            return $delete;
        }

        public function view_user($data)
        {
            $view = $this->_db->prepare('SELECT * FROM user WHERE id = :data');
            $view->execute(array(':data'=>$data));
            $view = $view->fetch();
            return $view;
        }*/
}
?>
