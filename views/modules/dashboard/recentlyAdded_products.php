<?php

$item = null;
$value = null;
$order = "id";

$products = ProductsController::ShowProductsController($item, $value, $order); 

 ?>

<div class="box box-primary">

    <div class="box-header with-border">

        <h3 class="box-title">Recently Added Products</h3>

        <div class="box-tools pull-right">

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>

            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <div class="box-body">

        <ul class="products-list product-list-in-box">

        <?php

        for($i = 0; $i < 10; $i++){

            echo '<li class="item">

                <div class="product-info">

                    <a href="" class="product-title">

                        '.$products[$i]["product"].'

                        <span class="label label-warning pull-right">€'.$products[$i]["sellingPrice"].'</span>
                        
                    </a>

                </div>

            </li>';
        }
        ?>

        </ul>
    </div>

    <div class="box-footer text-center">
    
    <a href="products" class="uppercase">View All Products</a>
    
    </div>

</div>

</div>

</div>