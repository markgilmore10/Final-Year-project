//local stoarage variable
if(localStorage.getItem("captureRange2") != null){

	$("#daterange-btn2 span").html(localStorage.getItem("captureRange2"));

}else{
	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Date Range')
}