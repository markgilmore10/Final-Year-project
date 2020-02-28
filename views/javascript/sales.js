$('.salesTable').DataTable({
	"ajax": "ajax/sales-table.ajax.php", 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});

$(".salesTable tbody").on("click", "button.addProductSale", function(){


    var idProduct = $(this).attr("idProduct");
   
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

          	$(".newProduct").append(

          	'<div class="row" style="padding:5px 15px">'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="' + idProduct + '"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control newProductDescription" idProduct="' + idProduct + '" name="addProductSale" value="' + product + '" readonly required>' +

	            '</div>'+

	          '</div>'+

	          '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-euro"></i></span>'+
	                 
	              '<input type="text" class="form-control newProductPrice" realPrice="' + price + '" name="newProductPrice" value="' + price + '" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

			'</div>')
			
			totalPrice()

      	}

     })

});

var idRemoveProduct = [];

localStorage.removeItem("removeProduct");

$(".saleForm").on("click", "button.removeProduct", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProduct = $(this).attr("idProduct");

	if(localStorage.getItem("removeProduct") == null){

		idRemoveProduct = [];
	
	}else{

		idRemoveProduct.concat(localStorage.getItem("removeProduct"))

	}

	idRemoveProduct.push({"idProduct":idProduct});

	localStorage.setItem("removeProduct", JSON.stringify(idRemoveProduct));

	totalPrice()

	

})

function totalPrice(){

	var priceItem = $(".newProductPrice");
	var priceArray = [];  

	for(var i = 0; i < priceItem.length; i++){

		priceArray.push(Number($(priceItem[i]).val()));
		 
	}

	function totalPriceArray(totalSale, numberArray){

		return totalSale + numberArray;

	}

	var totalPrices = priceArray.reduce(totalPriceArray);
	
	$("#newSaleTotal").val(totalPrices);
	$("#saleTotal").val(totalPrices);
	$("#newSaleTotal").attr("totalSale",totalPrices);


}

// todo: Adding Products from a Device -> Switch from till screen to buttons and back