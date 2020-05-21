<?php

use PHPUnit\Framework\TestCase;

require_once "models/sales.model.php";

class SalesTest extends TestCase
{
    
    public function test_reset_table () {
        $stmt = Connection::connect()->prepare("TRUNCATE sales");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }
    
    
    public function test_add () {
    
        $table = "sales";
    
     
        $data = array("code"=>"12121",
                      "idSeller"=>'1',
                      "tableNo"=>'10001',
                      "idCustomer"=>1,
                      "products"=>'[{"id":"11","product":"BBQ Pork Ribs","quantity":"1","stock":"-4","price":"8.95","totalPrice":"8.95"}]',
                      "netPrice"=>'200',
                      "discount"=>'0',
                      "totalPrice"=>'200',
                      "paymentMethod"=>'cash');
    
        $answer = ModelSales::AddSaleModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
    public function test_fetch_all () {
        $sales = ModelSales::getAll();
        $this->assertTrue(is_array($sales) && count($sales));
        
        $sales = ModelSales::ShowSalesModel('sales',null,null);
        $this->assertTrue(is_array($sales) && count($sales));
    }
    
    public function test_fetch_category () {
        $sales = ModelSales::ShowSalesModel('sales','code','12121');
        $this->assertTrue(is_array($sales) && count($sales));
    }
    
    public function test_edit () {
        
        $table = "sales";
    
        $data = array("code"=>'12121',
                      "idSeller"=>'1',
                      "tableNo"=>'1231',
                      "idCustomer"=>'1',
                      "products"=>'',
                      "netPrice"=>'130',
                      "discount"=>'20',
                      "totalPrice"=>'150',
                      "paymentMethod"=>'Voucher');
    
        $answer = ModelSales::ReopenSaleModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
    public function test_search_and_update () {
        $answer = productsModel::UpdateProductModel('products', 'sales', '20', '1');
        $this->assertEquals($answer, 'ok');
    }
    
    public function test_sum () {
        $answer = ModelSales::sumTotalSalesModel('sales');
        $this->assertTrue(isset($answer['totalPrice']));
    }
    
    public function test_delete () {
        $answer = ModelSales::DeleteSalesModel("sales", 1);
        $this->assertEquals($answer, "ok");
    }
    
    
}
