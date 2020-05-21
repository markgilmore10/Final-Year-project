<?php

$item = null;
$value = null;
$order = "id";

$sales = SalesController::sumTotalSalesController();

$categories = ControllerCategories::ShowCategoriesController($item, $value);
$totalCategories = count($categories);

$customers = CustomerController::ShowCustomerController($item, $value);
$totalCustomers = count($customers);

$products = ProductsController::ShowProductsController($item, $value, $order); 
$totalProducts = count($products);

?>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-aqua">

        <div class="inner">

            <h3>$<?php echo number_format($sales["totalPrice"],2); ?></h3>

            <p>Sales</p>
        </div>

        <div class="icon">

            <i class="ion ion-social-euro"></i>

        </div>

        <a href="sales" class="small-box-footer">

            More info <i class="fa fa-arrow-circle-right"></i>
            
        </a>
</div>
</div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-green">

        <div class="inner">

            <h3><?php echo number_format($totalCategories); ?></h3>

            <p>Categories</ep>

        </div>
        
        <div class="icon">

            <i class="ion ion-clipboard"></i>

        </div>

        <a href="categories" class="small-box-footer">

        More info <i class="fa fa-arrow-circle-right"></i>
        
        </a>

    </div>

</div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-yellow">
        
        <div class="inner">

            <h3><?php echo number_format($totalCustomers); ?></h3>

            <p>Customers</p>

        </div>

        <div class="icon">

            <i class="ion ion-person-add"></i>
        </div>

        <a href="customers" class="small-box-footer">
        
        More info <i class="fa fa-arrow-circle-right"></i>
        
        </a>

    </div>

</div>


<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-red">

        <div class="inner">

            <h3><?php echo number_format($totalProducts); ?></h3>

            <p>Products</p>
        
        </div>

        <div class="icon">

            <i class="ion ion-ios-cart"></i>

        </div>

        <a href="products" class="small-box-footer">
        
        More info <i class="fa fa-arrow-circle-right"></i>
        
        </a>

    </div>

</div>


