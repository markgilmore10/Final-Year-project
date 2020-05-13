// Edit Open Table
$(".tables").on("click", ".btnReopenTable", function(){
    
    var idSale = $(this).attr("idSale");
    
    window.location = "index.php?route=reopen-table&id="+idSale;
    
})