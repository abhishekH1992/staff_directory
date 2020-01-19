/*error messages in validations*/
function validationError(msg){
  html = "<ul class='parsley-errors-list filled' id='parsley-id-7' style='color:red;'><li class='parsley-required'>"+msg+"</li></ul>";
  return html;
}

/*clear error message*/
function clearError(){
  $(".parsley-errors-list.filled").each(function(){
    $(this).empty();
  });
}

function menuResponsive() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function filter(url){
  var str = $("#search").val();
  var dep = $('#department option:selected').val();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: url,
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
      filter('/');
    });
    $("#department").change(function () {
      filter('/');
    });
    $('body').on('click', '.pagination a', function(event) {
      event.preventDefault();
      var url = $(this).attr('href');  //alert(url);
      filter(url);
      window.history.pushState("", "", url);
    });
});

//Staff
$(document).on("submit", "#new-staff-form", function(event){
  event.preventDefault();
  $.ajax({
    type: "POST",
    url: '/staff',
    data: new FormData(this),
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#wait").css("display", "block");
    },
    complete: function () {
      $("#wait").css("display", "none");
    },
    success: function(data){
      clearError();
      if(data=='success'){
        location.href = '/';
      } else {
        var result = JSON.parse(data);
        var html = "";
        if(result["fname"]){
            html = validationError(result["fname"]);
            $("#fnameErr").parent().append(html);
        }
        if(result["lname"]){
            html = validationError(result["lname"]);
            $("#lnameErr").parent().append(html);
        }
        if(result["image"]){
            html = validationError(result["image"]);
            $("#imageErr").parent().append(html);
        }
        if(result["department"]){
            html = validationError(result["department"]);
            $("#departmentErr").parent().append(html);
        }
        if(result["profile"]){
            html = validationError(result["profile"]);
            $("#profileErr").parent().append(html);
        }
      }
    },
  });
});

$(document).on("submit", "#edit-staff-form", function(event){
  var form = $('#edit-staff-form');
  event.preventDefault();
  $.ajax({
    type: "POST",
    url: form.attr('action'),
    data: new FormData(this),
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#wait").css("display", "block");
    },
    complete: function () {
      $("#wait").css("display", "none");
    },
    success: function(data){
      clearError();
      if(data=='success'){
        location.href = '/';
      } else {
        var result = JSON.parse(data);
        var html = "";
        if(result["fname"]){
            html = validationError(result["fname"]);
            $("#fnameErr").parent().append(html);
        }
        if(result["lname"]){
            html = validationError(result["lname"]);
            $("#lnameErr").parent().append(html);
        }
        if(result["image"]){
            html = validationError(result["image"]);
            $("#imageErr").parent().append(html);
        }
        if(result["department"]){
            html = validationError(result["department"]);
            $("#departmentErr").parent().append(html);
        }
        if(result["profile"]){
            html = validationError(result["profile"]);
            $("#profileErr").parent().append(html);
        }
      }
    },
  });
});


//Department
$(document).on("submit", "#new-department-form", function(event){
  event.preventDefault();
  $.ajax({
    type: "POST",
    url: '/department',
    data: new FormData(this),
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#wait").css("display", "block");
    },
    complete: function () {
      $("#wait").css("display", "none");
    },
    success: function(data){
      clearError();
      if(data=='success'){
        location.href = '/';
      } else {
        var result = JSON.parse(data);
        var html = "";
        if(result["name"]){
            html = validationError(result["name"]);
            $("#nameErr").parent().append(html);
        }
      }
    },
  });
});

//csv
$(document).on("submit", "#new-csv-form", function(event){
  event.preventDefault();
  $.ajax({
    type: "POST",
    url: '/uploadFile',
    data: new FormData(this),
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#wait").css("display", "block");
    },
    complete: function () {
      $("#wait").css("display", "none");
    },
    success: function(data){
      clearError();
      if(data=='success'){
        location.href = '/';
      } else {
        var result = JSON.parse(data);
        var html = "";
        if(result["file"]){
            html = validationError(result["file"]);
            $("#fileErr").parent().append(html);
        }
      }
    },
  });
});