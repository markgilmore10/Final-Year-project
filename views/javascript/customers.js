// Edit Customer
$(".tables").on("click", "tbody .btnEditCustomer", function(){

	var idCustomer = $(this).attr("idCustomer");

	var data = new FormData();
    data.append("idCustomer", idCustomer);

    $.ajax({

      url:"ajax/customers.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(answer){
      
      	$("#idCustomer").val(answer["id"]);
        $("#editCustomer").val(answer["name"]);
        $("#editIdNumber").val(answer["idNumber"]);
        $("#editEmail").val(answer["email"]);
        $("#editMobile").val(answer["mobile"]);
        $("#editAddress").val(answer["address"]);
        $("#editDob").val(answer["dob"]);
        $("#editDiscount").val(answer["discount"]);
	  }

  	})

})

$(".tables").on("click", "tbody .btnDeleteCustomer", function(){

	var idCustomer = $(this).attr("idCustomer");
	
	swal({
        title: 'Delete this customer?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Delete'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?route=customers&idCustomer="+idCustomer;
        }

  })

})