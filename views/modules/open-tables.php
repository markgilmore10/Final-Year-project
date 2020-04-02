<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Open Tables

    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
       
          <thead>
           
           <tr>
             
            <th style="width:10px">#</th>
            <th>Receipt Number</th>
            <th>Staff</th>
            <th>Table Number</th>
            <th>Products</th>
            <th>Net Price</th>
            <th>Date</th>
            <th>Actions</th>

           </tr> 

          </thead>

          <tbody>
            <?php
            $sr = 1;
            $data = OpenTableController::index();
            foreach ($data as $row) :?>
                <tr>
                    <td><?= $sr++ ?></td>
                    <td><?= $row->code ?></td>
                    <td><?= $row->idSeller ?></td>
                    <td><?= $row->tableNo ?></td>
                    <td><?php
                        $products = json_decode($row->products);
                        $str = "";
                        foreach ($products as $product){
                            $str .= $product->product. ", ";
                        }
                
                        echo $str;
                        ?></td>
                    <td><?= $row->netPrice ?></td>
                    <td><?= $row->date ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
    
            </tbody>

        </table>

      </div>
    
    </div>

  </section>

</div>