// Edit Open Table
$(".tables").on("click", ".btnReopenTable", function(){
    
    var idSale = $(this).attr("idSale");
    
    window.location = "index.php?route=reopen-table&id="+idSale;
    
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
			
			  window.location = "index.php?route=open-tables&idSale="+idSale;
		  }
  
	})
  
  })