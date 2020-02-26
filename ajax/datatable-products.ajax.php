<?php

class ProductsTable{

    public function showProductTable(){
        echo '{
            "data": [
              [
                "1",
                "101",
                "Steak and Chips",
                "1",
                "20",
                "12.65",
                "18.95",
                "",
                "2020-02-18 00:03:23",
                "buttons"


              ],
              [
                "2",
                "102",
                "Chicken and Chips",
                "1",
                "20",
                "7.5",
                "12.95",
                "",
                "2020-02-18 00:03:03",
                "buttons"


              ]
            ]
          }';
    }


}


$activateProducts = new ProductTable();
$activateProducts -> showProductTable();

