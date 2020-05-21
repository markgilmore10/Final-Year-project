<?php

use PHPUnit\Framework\TestCase;

require_once "models/opentables.model.php";

class OpenTableTest extends TestCase
{
    
    public function test_reset_table () {
        $stmt = Connection::connect()->prepare("TRUNCATE open_tables");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }
    
    
    public function test_add () {
        $table = "open_tables";
        
        $data = array("code"       => '1122',
                      "idSeller"   => 1,
                      "tableNo"    => '123141',
                      "idCustomer" => 1,
                      "products"   => '[{"id":"11","product":"BBQ Pork Ribs","quantity":"1","stock":"-4","price":"8.95","totalPrice":"8.95"}]',
                      "netPrice"   => '8.95',
        );
        
        $answer = ModelTables::AddTableModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
    public function test_fetch_all () {
        $answer = ModelTables::all();
        $this->assertTrue(is_array($answer) && count($answer));
       
        $table = "open_tables";
        
        $answer = ModelTables::ShowTablesModel($table, null, null);
        $this->assertTrue(is_array($answer) && count($answer));
    }
    
    public function test_fetch () {
        $table = "open_tables";
        $answer = ModelTables::ShowTablesModel($table, 'code', '1122');
        $this->assertTrue(is_array($answer) && count($answer));
    }
    
    public function test_edit () {
    
        $table = "open_tables";
        
        $data = array("code"       => '12121',
                      "idSeller"   => '1',
                      "tableNo"    => '1231',
                      "products"   => '',
                      "netPrice"   => '130',
                      "discount"   => '20',
                      "totalPrice" => '150',
        );
        
        $answer = ModelTables::UpdateTableModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
   
    public function test_getCode () {
        $codeObj = ModelTables::getCode();
        $this->assertTrue(isset($codeObj));
    }
 
    
}
