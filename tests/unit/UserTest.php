<?php

use PHPUnit\Framework\TestCase;

require_once "models/users.model.php";

class UserTest extends TestCase
{
    
    public function test_reset_table () {
        $stmt = Connection::connect()->prepare("TRUNCATE users");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }
    
    
    public function test_add () {
        $table = 'users';
    
        $crypt = crypt('123', '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    
        $data = array('name' => 'admin',
                      'user' => 'admin',
                      'password' => $crypt,
                      'profile' => 'administrator');
    
        $answer = UserModel::AddUserModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
    public function test_fetch_category () {
        $table = 'users';
    
        $item = 'user';
        $value = 'admin';
    
        $crypt = crypt('123', '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    
        $user = UserModel::ShowUsersModel($table, $item, $value);
        $this->assertTrue(is_array($user) && count($user));
    }
    
    public function test_edit () {
        
        $table = "users";
        $encryptpassword = "123456";
        $data = array('name' => 'New Name',
                      'user' => 'admin',
                      'password' => $encryptpassword,
                      'profile' => 'administrator');
    
        $answer = UserModel::EditUserModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
    public function test_search_and_update () {
        $table = "users";
        date_default_timezone_set("Europe/Dublin");
    
        $date = date('Y-m-d');
        $hour = date('H:i:s');
    
        $actualDate = $date.' '.$hour;
    
        $item1 = "lastLogin";
        $value1 = $actualDate;
    
        $item2 = "id";
        $value2 = '1';
    
        $answer = UserModel::UpdateUserModel($table, $item1, $value1, $item2, $value2);
        $this->assertEquals($answer, 'ok');
    }
 
    
    public function test_delete () {
        $table ="users";
        $data = 1;
        $answer = UserModel::DeleteUserModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
    
}
