jQuery(function($) {
	function is_shipping() {
	var check = $('#ship-to-different-address-checkbox').is(":checked");
	    if(check) {
	    	$('#checkbox-dropship').val(1);
	        console.log("Checkbox is checked.");
	        $.ajax({
	            url: "https://dev.boseva.id/my-ajax.php",
	            type: "GET"
	        }).done(function(data) {
	            console.log( data );
	        });
	    } else {
	    	$('#checkbox-dropship').val(0);
	        console.log("Checkbox is unchecked.");
	    }
	}
	$("#ship-to-different-address-checkbox").on("click", function(){
	is_shipping();	    
	});
	is_shipping();	
	$("#copyCoupon").on("click", function(){
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($("#promo-coupon").text()).select();
		document.execCommand("copy");
		$temp.remove();
		alert("Kode Kupon disalin.");
	});
	$(".fa").on("click", function() {
	  var type = $("#password").attr("type");
	if (type == "text"){ 
	  $(this).toggleClass("fa-eye-slash");
	  $(this).removeClass("fa-eye");
	  $("#password").prop('type','password');}
	else{ 
	  $(this).toggleClass("fa-eye");
	  $(this).removeClass("fa-eye-slash");
	  $("#password").prop('type','text'); }
	});
});