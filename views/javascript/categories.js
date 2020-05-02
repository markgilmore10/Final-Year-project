// Edit Category
$(".tables").on("click", ".btnEditCategory", function(){

	var idCategory = $(this).attr("idCategory");

	var data = new FormData();
	data.append("idCategory", idCategory);

	$.ajax({
		url: "ajax/categories.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(answer){
     		
     		// console.log("answer", answer);

     		$("#editCategory").val(answer["Category"]);
			 $("#idCategory").val(answer["id"]);
			 $("#Vat").val(answer["Vat"]);
			 $("#Tax").val(answer["Tax"]);

     	}

	})

})

// Delete Category
$(".tables").on("click", ".btnDeleteCategory", function(){

    var idCategory = $(this).attr("idCategory");

    swal({
        title: 'Delete Category?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Confirm'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?route=categories&idCategory="+idCategory;

        }

    })

})