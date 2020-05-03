
var hiddenProfile = $('#hiddenProfile').val();;


// Dynamically Populate Products Page
$('.productsTable').DataTable({
	"ajax": "ajax/product-table.ajax.php?hiddenProfile="+hiddenProfile, 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});

// Assigning Product a Category Code
$("#newCategory").change(function(){

	var idCategory = $(this).val();

	var data = new FormData();
	data.append("idCategory", idCategory);

  	var Vat = $(this).find(':selected').attr('data-Vat');
  	var Tax = $(this).find(':selected').attr('data-Tax');
	
  	$("#newVatPrice").val(Vat);
  	$("#newTaxPrice").val(Tax);
  	
  	$.ajax({

      url:"ajax/products.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
	  dataType:"json",
      success:function(answer){

      	if(!answer){

      		var newCode = idCategory+"01";
      		$("#newCode").val(newCode);

      	}else{

      		var newCode = Number(answer["code"]) + 1;
            $("#newCode").val(newCode);

      	}
                
      }

  	})

})
var taxing = function(){
	var vatPercent = $("#newVatPrice").val();
	var taxPercent = $("#newTaxPrice").val();
	var percent = Number(($("#newBuyingPrice").val()*vatPercent/100))+Number(($("#newBuyingPrice").val()*taxPercent/100))+Number($("#newBuyingPrice").val());
	var editPercent = Number(($("#editBuyingPrice").val()*vatPercent/100))+Number(($("#editBuyingPrice").val()*taxPercent/100))+Number($("#editSellingPrice").val());
	$("#newBuyingPricePlus").val(percent);
	$("#newBuyingPricePlus").prop("readonly", true);
	$("#editBuyingPricePlus").val(editPercent);
	$("#editBuyingPricePlus").prop("readonly",true);
}
$("#newBuyingPrice, #editBuyingPrice, #newCategory").change(function(){
	taxing()
})



// Markup calculation
$("#newBuyingPricePlus, #editBuyingPricePlus").change(function(){

	if($(".percentage").prop("checked")){

		var markupPercent = $(".newPercentage").val();
		
		var percent = Number(($("#newBuyingPricePlus").val()*markupPercent/100))+Number($("#newBuyingPricePlus").val());

		var editPercent = Number(($("#editBuyingPricePlus").val()*markupPercent/100))+Number($("#editSellingPrice").val());

		$("#newSellingPrice").val(percent);
		$("#newSellingPrice").prop("readonly", true);

		$("#editSellingPrice").val(editPercent);
		$("#editSellingPrice").prop("readonly",true);
	}
})

//Changing percent
$("#newPercentage").change(function(){

	if($(".percentage").prop("checked")){

		var vatPercent = $(this).val();
		
		var percent = Number(($("#newBuyingPrice").val()*vatPercent/100))
		+Number($("#newBuyingPrice").val());

		var editPercent = Number(($("#editBuyingPrice").val()*vatPercent/100))
		+Number($("#editBuyingPrice").val());


		$("#newSellingPrice").val(percent);
		$("#newSellingPrice").prop("readonly",true);

		$("#editSellingPrice").val(editPercent);
		$("#editSellingPrice").prop("readonly",true);
	}
	
})

$(".percent").on("ifUnchecked",function(){
	
	$("#newSellingPrice").prop("readonly",false);
	$("#editSellingPrice").prop("readonly",false);

})

$(".percent").on("ifChecked",function(){
	
	$("#newSellingPrice").prop("readonly",true);
	$("#editSellingPrice").prop("readonly",true);

})

//Edit product
$(".productsTable tbody").on("click", "button.btnEditProduct", function(){

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

			var categoryData = new FormData();
			categoryData.append("idCategory", answer["idCategory"]);
			 
			 $.ajax({
				url:"ajax/categories.ajax.php",
				method: "POST",
				data: categoryData,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(answer){

					$("#editCategory").val(answer["id"]);
					$("#editCategory").html(answer["Category"]);
				}
			 })

			  $("#editCode").val(answer["code"]);

			  $("#editProducts").val(answer["product"]);

			  $("#editStock").val(answer["stock"]);

			  $("#editBuyingPrice").val(answer["buyingPrice"]);

			  $("#editSellingPrice").val(answer["sellingPrice"]);


		}
	})
	
})

//Delete product
$(".productsTable tbody").on("click ", "button.btnDeleteProduct", function(){

	var idProduct = $(this).attr("idProduct");
	var code = $(this).attr("code");
	//console.log("idProduct", idProduct);

	swal({

		title: 'Are you certain you want to delete the product?',
		text: "If not you can cancel this action!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancel',
		confirmButtonText: 'Yes, Delete Product'
		}).then(function(result){
        if (result.value) {

        	window.location = "index.php?route=products&idProduct="+idProduct+"&Code="+code;

        }

	})
})

	
