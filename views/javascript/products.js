// Dynamically Populate Products Page
$('.productsTable').DataTable({
	"ajax": "ajax/product-table.ajax.php", 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});

// Assigning Product a Category Code
$("#newCategory").change(function(){

	var idCategory = $(this).val();

	var datum = new FormData();
  	datum.append("idCategory", idCategory);

  	$.ajax({

      url:"ajax/products.ajax.php",
      method: "POST",
      data: datum,
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



// todo: VAT calculation
$("#newBuyingPrice, #editBuyingPrice").change(function(){

	if($(".percentage").prop("checked")){

		var vatPercent = $(".newPercentage").val();
		
		var percent = Number(($("#newBuyingPrice").val()*vatPercent/100))+Number($("#newBuyingPrice").val());

		var editPercent = Number(($("#editBuyingPrice").val()*vatPercent/100))+Number($("#editSellingPrice").val());

		$("#newSellingPrice").val(percent);
		$("#newSellingPrice").prop("readonly", true);

		$("#editSellingPrice").val(editPercent);
		$("#editSellingPrice").prop("readonly",true);
	}
})

//changing percent
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
$(".productsTable tbody").on("click ", "button.btnEditProduct", function(){

	var idProduct = $(this).attr("idProduct");
	//console.log("idProduct", idProduct);
	var tData = new FormData();
	tData.append("idProduct", idProduct);

	$.ajax({

		url:"ajax/products.ajax.php",
		method: "POST",
		data: tData,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(answer){
			//console.log("answer",answer);
			var categoryData = new FormData();
			categoryData.append("idCategory", answer["id_category"]);
			 
			 $.ajax({

				url:"ajax/categories.ajax.php",
				method: "POST",
				data: categoryData,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(answer){
					//console.log("answer", answer);

					$("#editCategory").val(answer["id"]);
					$("#editCategory").html(answer["category"]);
				}
			 })

			  $("#editCode").val(answer["code"]);

			  $("#editProduct").val(answer["product"]);

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

	
