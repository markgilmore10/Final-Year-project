<?php

use PHPUnit\Framework\TestCase;

require_once "models/products.model.php";

class ProductTest extends TestCase
{
    
    public function test_reset_table () {
        $stmt = Connection::connect()->prepare("TRUNCATE products");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }
    
    
    public function test_add () {
        
        $table = "products";
        
        $data = array("idCategory"   => '1',
                      "code"         => "1122",
                      "product"      => "pizza",
                      "stock"        => '5',
                      "buyingPrice"  => '20',
                      "sellingPrice" => '22');
        
        $answer = productsModel::AddProductModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
    public function test_fetch_all () {
        $item = null;
        $value = null;
        $order = "idCategory";
        $table = "products";
        $products = productsModel::ShowProductsModel($table, $item, $value, $order);
        $this->assertTrue(is_array($products) && count($products));
    }
    
    public function test_fetch_category () {
        $item = 'id';
        $value = 1;
        $order = null;
        $table = "products";
        $products = productsModel::ShowProductsModel($table, $item, $value, $order);
        $this->assertTrue(is_array($products) && count($products));
        
        $item = 'code';
        $value = '1122';
        $order = null;
        $table = "products";
        $products = productsModel::ShowProductsModel($table, $item, $value, $order);
        $this->assertTrue(is_array($products) && count($products));
    }
    
    public function test_edit () {
        
        $table = "products";
        
        $data = array("idCategory"   => '1',
                      "code"         => '234',
                      "product"      => 'test',
                      "stock"        => '25',
                      "buyingPrice"  => '23',
                      "sellingPrice" => '25');
        
        $answer = productsModel::EditProductModel($table, $data);
        $this->assertEquals($answer, "ok");
    }
    
    public function test_search_and_update () {
        $answer = productsModel::UpdateProductModel('products', 'sales', '20', '1');
        $this->assertEquals($answer, 'ok');
    }
    
    public function test_sum () {
        $answer = productsModel::sumOfSalesModel('products');
        $this->assertTrue(isset($answer['totalPrice']));
    }
    
    public function test_delete () {
        $answer = productsModel::DeleteProductModel("products", 1);
        $this->assertEquals($answer, "ok");
    }
    
    
}
