function menuResponsive() {
  	var x = document.getElementById("myTopnav");
  	if (x.className === "topnav") {
    	x.className += " responsive";
  	} else {
    	x.className = "topnav";
  	}
}

function filter(){
	var str = $("#search").val();
	var dep = $('#department option:selected').val();
	// /alert(dep);
	$.ajaxSetup({
      	headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      	}
    });
    $.ajax({
      	type: "GET",
      	url: '/filter',
      	data: {
		    str: str,
		    dep: dep,
      	},
      	success: function(data){
      		console.log(data);
        	$('#filter').html(data);
      	},
    });
}

$(document).ready(function(){
	$("#search").on('input', function(){
    	filter();
  	});
  	$("#department").change(function () {
  		filter();
    });
});