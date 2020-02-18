// Dynamically Populate Products Page
$('.productsTable').DataTable({
	"ajax": "ajax/producttable.ajax.php", 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});
