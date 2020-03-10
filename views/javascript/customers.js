// Edit Customer
$(".tables").on("click", "tbody .btnEditCustomer", function(){

	var idCustomer = $(this).attr("idCustomer");

	var datum = new FormData();
    datum.append("idCustomer", idCustomer);

    $.ajax({

      url:"ajax/customers.ajax.php",
      method: "POST",
      data: datum,
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