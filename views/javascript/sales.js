$('.salesTable').DataTable({
	"ajax": "ajax/sales-table.ajax.php", 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});

$(".salesTable tbody").on("click", "button.addProductSale", function(){


    var idProduct = $(this).attr("idProduct");
    console.log("idProduct", idProduct);

	//$(this).removeClass("btn-primary addProductSale");

	//$(this).addClass("btn-default");

	var datum = new FormData();
    datum.append("idProduct", idProduct);
	
     $.ajax({

		url:"ajax/products.ajax.php",
		method: "POST",
		data: datum,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(answer){

			console.log("answer", answer);
      	    var product = answer["product"];
			var price = answer["sellingPrice"];
			console.log("product", product);
			console.log("price", price);

          	$(".newProduct").append(

          	'<div class="row" style="padding:5px 15px">'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="'+idProduct+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control newProductDescription" idProduct="'+idProduct+'" name="addProductSale" value="'+product+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-euro"></i></span>'+
	                 
	              '<input type="text" class="form-control newProductPrice" realPrice="'+price+'" name="newProductPrice" value="'+price+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>')

	    	

      	}

     })

});
