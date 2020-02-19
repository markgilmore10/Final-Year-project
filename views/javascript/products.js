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
$("#newBuyingPrice").change(function(){

	if($(".percentage").prop("checked")){

		var vatPercent = $(".newPercentage").val();
		
		var percent = Number(($("#newBuyingPrice").val()*vatPercent/100))+Number($("#newSellingPrice").val());


		$("#newSellingPrice").val(percent);
		$("#newSellingPrice").prop("readonly", true);
	}
	

	


})



$("#newBuyingPrice").change(function(){

	if($(".percentage").prop("checked")){

		var vatPercent = $(".newPercentage").val();
		
		var percentage = Number(($("#newBuyingPrice").val()*vatPercent/100))
		+Number($("#newBuyingPrice").val());


		$("#newSellingPrice").val(percentage);
		$("#newSellingPrice").prop("readonly",true);
	}
	
})

$(".percentage").on("ifUnchecked",function(){
	
	$("#newSellingPrice").prop("readonly",false);

})

$(".percentage").on("ifChecked",function(){
	
	$("#newSellingPrice").prop("readonly",true);

})

//Edit product

	
