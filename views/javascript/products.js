// Dynamically Populate Products Page
$('.productsTable').DataTable({
	"ajax": "ajax/product-table.ajax.php", 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});
