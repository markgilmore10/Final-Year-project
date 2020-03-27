<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Sales

    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="till">

          <button class="btn btn-primary" >
        
            Add sale
  
          </button>

        </a>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
       
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Receipt Number</th>
             <th>Staff</th>
             <th>Table Number</th>
             <th>Customer</th>
             <th>Products</th>
             <th>Net Price</th>
             <th>Discount</th>
             <th>Total Price</th>
             <th>Payment Method</th>
             <th>Date</th>
             <th>Actions</th>

           </tr> 

          </thead>

          <tbody>
                    <?php
                    $sr = 1;
                    $sales = SalesController::index();
                    foreach ($sales as $sale) :?>
                        <tr>
                            <td><?= $sr++ ?></td>
                            <td><?= $sale->code ?></td>
                            <td><?= $sale->idSeller ?></td>
                            <td><?= $sale->tableNo ?></td>
                            <td><?= $sale->idCustomer ?></td>
                            <td><?php
                                $products = json_decode($sale->products);
                                $str = "";
                                foreach ($products as $product){
                                    $str .= $product->product. ", ";
                                }
                                
                                echo $str;
                                ?></td>
                            <td><?= $sale->netPrice ?></td>
                            <td><?= $sale->discount ?></td>
                            <td><?= $sale->totalPrice ?></td>
                            <td><?= $sale->paymentMethod ?></td>
                            <td><?= $sale->saledate ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                    
                    </tbody>

        </table>

      </div>
    
    </div>

  </section>

</div>