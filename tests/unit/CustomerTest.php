<?php

use PHPUnit\Framework\TestCase;

require_once "models/customer.model.php";

class CustomerTest extends TestCase
{
    
    public function test_reset_table () {
        $stmt = Connection::connect()->prepare("TRUNCATE customers");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }
    
    public function test_add () {
        $table = "customers";
    
        $data = array("name"=>"John Doe",
                      "idNumber"=>"222333444",
                      "email"=>"john@example.com",
                      "mobile"=>"1234567",
                      "address"=>"lorem ipsum",
                      "dob"=>"2020-12-31",
                      "discount"=>"20");
        $answer = CustomersModel::AddCustomerModel($table,$data);
        $this->assertEquals($answer,"ok");
    }
    
    public function test_fetch_all() {
        $result = CustomersModel::ShowCustomersModel('customers','','');
        $this->assertTrue(is_array($result) && count($result));
    }
    
    public function test_fetch() {
        $result = CustomersModel::ShowCustomersModel('customers','id','1');
        $this->assertTrue(is_array($result) && count($result));
        
        $result = CustomersModel::ShowCustomersModel('customers','name','John Doe');
        $this->assertTrue(is_array($result) && count($result));
        
        $result = CustomersModel::ShowCustomersModel('customers','idNumber','222333444');
        $this->assertTrue(is_array($result) && count($result));
    }
    
    public function test_edit () {
    
        $table = "customers";
    
        $data = array("id"=>"1",
                      "name"=>'NAME',
                      "idNumber"=>"123444",
                      "email"=>"test@example.co",
                      "mobile"=>"00000",
                      "address"=>"lorem ipsum",
                      "dob"=>"1990-12-31",
                      "discount"=>'5');
    
        $answer = CustomersModel::EditCustomerModel($table, $data);
        $this->assertEquals($answer,"ok");
    }
    
    public function test_search_by_number () {
        $result = CustomersModel::searchByNumberId("444");
        $this->assertTrue(is_array($result) && count($result));
    }
    
    public function test_search_and_update () {
        $value_2 = '123444';
        $item1b_2 = "lastPurchase";
        date_default_timezone_set("Europe/Dublin");
        $date = date('Y-m-d');
        $hour = date('H:i:s');
        $value1b_2 = $date.' '.$hour;
        $answer = CustomersModel::UpdateCustomerModel("customers", $item1b_2, $value1b_2, $value_2);
        $this->assertEquals($answer, 'ok');
    }
    
    public function test_delete () {
        $answer = CustomersModel::DeleteCustomerModel("customers", "1");
        $this->assertEquals($answer,"ok");
    }
    
 
    
    
}
