var branchTable;

$(document).ready(function() {
	branchTable = $("#branchTable").DataTable({
		"ajax": "../inc/branch/retrieve.php",
		"scrollY": 330,
        "scrollX": true,
		"pageLength": 150,
		"order": []
	});
	

});

 // Insert class
 $('#branchFormsss').submit(function(event){
	event.preventDefault();
	//var data = $("#register-form").serialize();
	$.ajax({
	  url: "../inc/branch/insert.php",
	  method: "post",
	  data: $('form').serialize(),
	  success: function(data){
		//$('#message').html(strMessage);
		//$('#menuform')[0].reset();
		//branchTable.ajax.reload(null, false);
		if(data==1){
		$("#message").fadeIn(1000, function(){
     	$("#message").html('<div class="alert alert-danger"> <span class="fa fa-info-circle"></span> &nbsp; Duplicate entry. Menu already exist in the database! </div>');
		});

		}else if(data=="added")
		{
			    $('#branchForm')[0].reset();
					$("#branchTable").DataTable().ajax.reload();

					//$(".stas").load(location.href + " .stas");
					M.toast({html: "Operation was successful"});
          window.location.href = "branches";
		}else if(data=="updated")
		{     
          $("#branchTable").DataTable().ajax.reload();
					M.toast({html: "Updated successfully"});
          location.reload(true);
		}
		else{

			  $("#message").fadeIn(1000, function(){
				$("#message").html('<div class="alert red col-white"><span class="fa fa-info-circle"></span> &nbsp; '+data+' !</div>');
				//$("#btn-submit").html('<i class="fa fa-plus"></i> Add Menu');
			});

		}

	  }
	})
  })

$(document).ready(function(){
        //Menu's status update
$('.menuDetails').on('click', function() {
      var checkStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
     
    $.post("../inc/menus/menu_status_updates.php", {"id": id, "sta":checkStatus }, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "Menu Activated"});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "Menu Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
    });

});


function removeMenu(id = null) {
  if(id) {
    // click on remove button
    
    $("#removeBtn").unbind('click').bind('click', function() {
      $.ajax({
        url: '../inc/branch/remove.php',
        type: 'post',
        data: {member_id : id},
        dataType: 'json',
        success:function(response) {
          if(response.success == true) {        
             M.toast({html: response.messages});

         // refresh the table
           $("#branchTable").DataTable().ajax.reload();
           $('.removeMessages').slideDown('slow');

            // close the modal
            $(".modal").modal('hide');
            $("#clomeMe").click();
            $("#clomeMe").bind('click');
            location.reload(true);

          } else {
            $(".removeMessages").html('<div class="card-alert card red" ><div class="card-content white-text">'+
                '<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">'+
                  '<span aria-hidden="true">×</span></button>'+
                '<strong> <i class="material-icons left">insert_emoticon</i> </strong>'+response.messages+
              '</div></div>');
          }
        }
      });
    }); // click remove btn
  } else {
    alert('Error: Refresh the page again');
  }
}


function activateMenu(id = null) {
  if(id) {
    //alert(id);
    // click on remove button
    
    $("#activateBtn").unbind('click').bind('click', function() {
        var checkStatus = this.checked ? 1 : 0;
      $.ajax({
        url: '../inc/menus/menu_status_updates.php',
        type: 'post',
        data: {id : id, sta : checkStatus},
        ///dataType: 'json',
        success:function(data) {
         if(data == 1){
           // $('#email_status').prop( "checked", true );
           $("#branchTable").DataTable().ajax.reload();
             M.toast({html: "Menu Activated"});

            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
            $("#branchTable").DataTable().ajax.reload();
             M.toast({html: "Menu Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        }
      });
    }); // click remove btn
  } else {
    alert('Error: Refresh the page again');
  }
}



   