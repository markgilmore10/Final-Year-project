<?php

use PHPUnit\Framework\TestCase;

require_once "models/categories.model.php";

class CategoryTest extends TestCase
{
    
    public function test_reset_table () {
        $stmt = Connection::connect()->prepare("TRUNCATE categories");
        $ok = $stmt->execute();
        $this->assertTrue($ok);
    }
    
    
    public function test_add_category () {
        $table = 'categories';
        $data = array("category" => "test",
                      "vat"      => "5",
                      "tax"      => "5");
        $result = CategoriesModel::AddCategoryModel($table, $data);
        $this->assertEquals($result,"ok");
    }
    
    public function test_fetch_all_categories() {
        $result = CategoriesModel::ShowCategoriesModel('categories', '', '');
        $this->assertTrue(is_array($result) && count($result));
    }
    public function test_fetch_category() {
        $result = CategoriesModel::ShowCategoriesModel('categories','Category','test');
        $this->assertTrue(is_array($result) && count($result));
        
        $result = CategoriesModel::ShowCategoriesModel('categories','id','1');
        $this->assertTrue(is_array($result) && count($result));
    }
    
    public function test_edit_category () {
        
        $table = "categories";
        $data = array("Category"=>"test-change",
                      "id"=>1,
                      "Vat"=>"20",
                      "Tax"=>"17");
    
        $answer = CategoriesModel::EditCategoryModel($table, $data);
        $this->assertEquals($answer,"ok");
    }
    
    public function test_delete_category () {
        $answer = CategoriesModel::DeleteCategoryModel("categories", "1");
        $this->assertEquals($answer,"ok");
    }
    

}
