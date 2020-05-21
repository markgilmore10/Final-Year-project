//local stoarage variable
if(localStorage.getItem("captureRange") != null){

	$("#daterange-btn span").html(localStorage.getItem("captureRange"));

}else{
	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Date Range')
}

$('.salesTable').DataTable({
	"ajax": "ajax/sales-table.ajax.php", 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});

$(".salesTable tbody").on("click", "button.addProductSale", function(){

    var idProduct = $(this).attr("idProduct");
   
	var data = new FormData();

    data.append("idProduct", idProduct);
	
	$.ajax({
		url:"ajax/products.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(answer){

			var product = answer["product"];
			var category = answer["idCategory"];
			var price = answer["sellingPrice"];
			var stock = answer["stock"];

			if(stock == 0){

				swal({
					title: "Out of Stock",
					type: "error",
					confirmButtonText: "Close!"
				});

			  return;

			}

          	$(".newProduct").append(

          	'<div class="row" style="padding:5px 15px">'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="' + idProduct + '"><i class="fa fa-times"></i></button></span>'+

				  '<input type="text" class="form-control newProductDescription" idProduct="' + idProduct + '" name="addProductSale" value="' + product + '" readonly required>' +
				  '<input type="hidden" class="form-control newProductCategory" idProduct="' + idProduct + '" name="newProductCategory" value="' + category + '" readonly required>' +

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

	if($(".newProduct").children().length == 0){

		$("#newSaleTotal").val(0);
		$("#saleTotal").val(0);
		$("#newSaleTotal").attr("saleTotal",0);

	}else{

		totalPrice()
		listProducts()
		lessDiscount()

	}

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

$("#newSaleTotal").number(true, 2);

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

// Putting sale products into json data to save in the database
function listProducts(){

	var productsList = [];

	var product = $(".newProductDescription");

	var quantity = $(".newProductQuantity");

	var category = $(".newProductCategory");

	var price = $(".newProductPrice");

	for(var i = 0; i < product.length; i++){

		productsList.push({ "id" : $(product[i]).attr("idProduct"), 
							  "product" : $(product[i]).val(),
							  "category" : $(category[i]).val(),
							  "quantity" : $(quantity[i]).val(),
							  "stock" : $(quantity[i]).attr("newStock"),
							  "price" : $(price[i]).attr("realPrice"),
							  "totalPrice" : $(price[i]).val()})

	}

	$("#productsList").val(JSON.stringify(productsList)); 

}

// Updating stock and adding up price when quantity changes
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

// Select Product
$(".saleForm").on("change", "select.newProductDescription", function(){

	var productName = $(this).val();

	var newProductDescription = $(this).parent().parent().parent().children().children().children(".newProductDescription");

	var newProductCategory = $(this).parent().parent().parent().children().children().children(".newProductCategory");

	var newProductPrice = $(this).parent().parent().parent().children(".enterPrice").children().children(".newProductPrice");

	var newProductQuantity = $(this).val(); // need to fetch new quantity

	var data = new FormData();
    data.append("productName", productName);


	  $.ajax({

     	url:"ajax/products.ajax.php",
      	method: "POST",
      	data: data,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(answer){
      	    
			$(newProductDescription).attr("idProduct", answer["id"]);
			$(newProductCategory).attr("category", answer["idCategory"]);
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

	window.location = "index.php?route=resale&idSale="+idSale;

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

  $(".tables").on("click", ".btnDeleteTable", function(){

	var idSale = $(this).attr("idSale");
  
	swal({
		  title: 'Delete Table?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancel',
		  confirmButtonText: 'Yes'
		}).then(function(result){
		  if (result.value) {
			
			  window.location = "open-tables";
		  }
  
	})

})

$(".saleForm").on("change", "input#newCashValue", function(){
	
	var cash = $(this).val();

	var change =  Number(cash) - Number($('#saleTotal').val());
	
	$("#newCashChange").val(change);
	
})

$("#newCashChange").number(true, 2);

//Print receipt
$(".tables").on("click", ".btnPrintBill", function(){

	var saleCode = $(this).attr("saleCode");

	window.open("extensions/tcpdf/pdf/receipt.php?code="+saleCode, "_blank");

})

$(".tables").on("click", ".btnPrintOpenBill", function(){

	var saleCode = $(this).attr("saleCode");

	window.open("extensions/tcpdf/pdf/open_receipt.php?code="+saleCode, "_blank");

})

function food(saleCode){

	window.open('extensions/tcpdf/pdf/food_order.php?code='+saleCode);

}

function drink(saleCode){

	window.open('extensions/tcpdf/pdf/drink_order.php?code='+saleCode);

}

$(".saleForm").on("click", ".btnPrintOrder", function(){

    var saleCode = $(this).data("sale-code");

    food(saleCode);
    drink(saleCode);

})

// Date ranges 
$('#daterange-btn').daterangepicker(
	{
	  ranges   : {
		'Today'       : [moment(), moment()],
		'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Last 7 days' : [moment().subtract(6, 'days'), moment()],
		'Last 30 days': [moment().subtract(29, 'days'), moment()],
		'this month'  : [moment().startOf('month'), moment().endOf('month')],
		'Last month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  },
	  startDate: moment(),
	  endDate  : moment()
	},
	function (start, end) {
	  $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

	 var initialDate = start.format('YYYY-MM-DD');
	 //console.log("initialDate", initialDate);

     var finalDate = end.format('YYYY-MM-DD');
	 //console.log("finalDate", finalDate);

     var captureRange = $("#daterange-btn span").html();
   
   	 localStorage.setItem("captureRange", captureRange);
   	 console.log("localStorage", localStorage);

   	 window.location = "index.php?route=sales&initialDate="+initialDate+"&finalDate="+finalDate;

	}

	
)

//clear daterange*/
$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("captureRange");
	localStorage.clear();
	window.location = "sales";
})

//today
$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var todayButton = $(this).attr("data-range-key");

	if(todayButton == "Today"){

		var d = new Date();
		
		var day = d.getDate();
		var month= d.getMonth()+1;
		var year = d.getFullYear();

		if(month < 10 && day > 10){

			var initialDate = year+"-0"+month+"-"+day;
			var finalDate = year+"-0"+month+"-"+day;

		}else if(day < 10 && month > 10){

			var initialDate = year+"-"+month+"-0"+day;
			var finalDate = year+"-"+month+"-0"+day;

		}else if(month < 10 && day < 10){

			var initialDate = year+"-0"+month+"-0"+day;
			var finalDate = year+"-0"+month+"-0"+day;

		}else{

			var initialDate = year+"-"+month+"-"+day;
	    	var finalDate = year+"-"+month+"-"+day;

		}	

    	localStorage.setItem("captureRange", "Today");

    	window.location = "index.php?route=sales&initialDate="+initialDate+"&finalDate="+finalDate;

	}

})
