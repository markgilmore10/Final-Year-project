
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
	var editPercent = Number(($("#editBuyingPrice").val()*vatPercent/100))+Number(($("#editBuyingPrice").val()*taxPercent/100))+Number($("#editBuyingPrice").val());
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

		var editPercent = Number(($("#editBuyingPricePlus").val()*markupPercent/100))+Number($("#editBuyingPricePlus").val());

		$("#newSellingPrice").val(percent);

		$("#editSellingPrice").val(editPercent);
	}
})

//Changing percent
$(".newPercentage").change(function(){

	if($(".percentage").prop("checked")){

		var markupPercent = $(this).val();
		
		var percent = Number(($("#newBuyingPricePlus").val()*markupPercent/100))
		+Number($("#newBuyingPricePlus").val());

		var editPercent = Number(($("#editBuyingPricePlus").val()*markupPercent/100))
		+Number($("#editBuyingPricePlus").val());


		$("#newSellingPrice").val(percent);

		$("#editSellingPrice").val(editPercent);
	}
	
})

// Rounding numbers off
$("#newSellingPrice").number(true, 2);
$("#editSellingPrice").number(true, 2);

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

					$("#newVatPrice").val(answer["Vat"]);

					$("#newTaxPrice").val(answer["Tax"]);
					
				}
			 })

			  $("#editCode").val(answer["code"]);

			  $("#editProducts").val(answer["product"]);

			  $("#editStock").val(answer["stock"]);

			  $("#editBuyingPricePlus").val(answer["buyingPrice"]);

			  $("#editSellingPrice").val(answer["sellingPrice"]);


		}
	})
	
})

//Delete product
$(".productsTable tbody").on("click ", "button.btnDeleteProduct", function(){

	var idProduct = $(this).attr("idProduct");
	var code = $(this).attr("code");

	swal({

		title: 'Are you certain you want to delete the product?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancel',
		confirmButtonText: 'Delete'
		}).then(function(result){
        if (result.value) {

        	window.location = "index.php?route=products&idProduct="+idProduct+"&Code="+code;

        }

	})
})

	
