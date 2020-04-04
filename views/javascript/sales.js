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
			var stock = answer["stock"];

          	$(".newProduct").append(

          	'<div class="row" style="padding:5px 15px">'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="' + idProduct + '"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control newProductDescription" idProduct="' + idProduct + '" name="addProductSale" value="' + product + '" readonly required>' +

	            '</div>'+

			  '</div>'+
			  
			  '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="1" stock="' + stock + '" newStock="' + Number(stock-1) + '" required>'+

	          '</div>' +

	          '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-euro"></i></span>'+
	                 
	              '<input type="text" class="form-control newProductPrice" realPrice="' + price + '" name="newProductPrice" value="' + price + '" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

			'</div>')
			
			totalPrice()
			listProducts()
			lessDiscount()

			$(".newProductPrice").number(true, 2);

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

	//if($(".newProductTotal").children().length == 0){

		$("#newTotalSale").val(0);
		$("#saleTotal").val(0);
		$("#newTotalSale").attr("totalSale",0);

	//}else{

		totalPrice()
		listProducts()
		lessDiscount()

	//}

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

$("#newSaleTotal").number(true, 2); // jQuery number plugin trying to format total - not working

// Sale Less Discount

function lessDiscount(){

	var discount = $("#newDiscountSale").val();

	var totalPrice = $("#newSaleTotal").attr("totalSale");

	var discountPrice = Number(1 - discount/100);

	var totalLessDiscount = Number(totalPrice) * Number(discountPrice);
	
	$("#newSaleTotal").val(totalLessDiscount);

	$("#saleTotal").val(totalLessDiscount);

	$("#newDiscountPrice").val(discountPrice);

	$("#newNetPrice").val(totalPrice);

}

$("#newDiscountSale").change(function(){

	lessDiscount();

});

function listProducts(){

	var productsList = [];

	var product = $(".newProductDescription");

	var quantity = $(".newProductQuantity");

	var price = $(".newProductPrice");

	for(var i = 0; i < product.length; i++){

		productsList.push({ "id" : $(product[i]).attr("idProduct"), 
							  "product" : $(product[i]).val(),
							  "quantity" : $(quantity[i]).val(),
							  "stock" : $(quantity[i]).attr("newStock"),
							  "price" : $(price[i]).attr("realPrice"),
							  "totalPrice" : $(price[i]).val()})

	}

	$("#productsList").val(JSON.stringify(productsList)); 

}

$(".saleForm").on("change", "input.newProductQuantity", function(){

	var price = $(this).parent().parent().children(".enterPrice").children().children(".newProductPrice");

	var finalPrice = $(this).val() * price.attr("realPrice");
	
	price.val(finalPrice);

	var newStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("newStock", newStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		$(this).val(0);

		var finalPrice = $(this).val() * price.attr("realPrice");

		price.val(finalPrice);

		totalPrice()

		swal({
	      title: "Not enough stock !!!",
	      type: "error",
	      confirmButtonText: "Close"
	    });

	    return;

	}

	totalPrice()
	listProducts()
	lessDiscount()

})

$(".saleForm").on("change", "select.newProductDescription", function(){

	var productName = $(this).val();

	var newProductDescription = $(this).parent().parent().parent().children().children().children(".newProductDescription");

	var newProductPrice = $(this).parent().parent().parent().children(".enterPrice").children().children(".newProductPrice");

	var newProductQuantity = $(this).val(); // need to fetch new quantity

	var datum = new FormData();
    datum.append("productName", productName);


	  $.ajax({

     	url:"ajax/products.ajax.php",
      	method: "POST",
      	data: datum,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(answer){
      	    
      	    $(newProductDescription).attr("idProduct", answer["id"]);
      	    $(newProductQuantity).attr("stock", answer["stock"]);
      	    $(newProductQuantity).attr("newStock", Number(answer["stock"])-1);
      	    $(newProductPrice).val(answer["sellingPrice"]);
      	    $(newProductPrice).attr("realPrice", answer["sellingPrice"]);

	        listProducts()

      	}

      })
})

// Edit Sale
$(".tables").on("click", ".btnReopenSale", function(){

	var idSale = $(this).attr("idSale");

	window.location = "index.php?route=reopen-table&idSale="+idSale;


})

$(".tables").on("click", ".btnDeleteSale", function(){

	var idSale = $(this).attr("idSale");
  
	swal({
		  title: 'Delete Sale?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancel',
		  confirmButtonText: 'Yes'
		}).then(function(result){
		  if (result.value) {
			
			  window.location = "index.php?route=sales&idSale="+idSale;
		  }
  
	})
  
  })

// todo: Changing stock number after sale

// todo: Adding Products from a Device -> Switch from till screen to buttons and back

//Print receipt
$(".tables").on("click", ".btnPrintBill", function(){

	var saleCode = $(this).attr("saleCode");

	window.open("extensions/tcpdf/pdf/receipt.php?code="+saleCode, "_blank");

})
