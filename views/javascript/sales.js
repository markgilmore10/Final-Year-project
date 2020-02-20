$('.salesTable').DataTable({
	"ajax": "ajax/sales-table.ajax.php", 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});

$(".salesTable tbody").on("click", "button.addProductSale", function(){


	var idProduct = $(this).attr("idProduct");

	$(this).removeClass("btn-primary addProductSale");

	$(this).addClass("btn-default");

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

      	    var product = answer["product"];
          	var price = answer["sellingPrice"];

          	
      	}

     })

});