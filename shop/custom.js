function goBack() {
  window.history.go(-1); 
  return false;
}


//Check for internet connection

(function ($) {
  'use strict';

  // :: Internet Connection Detect
  var internetStatus = $("#internetStatus"),
      onlineText = "Your internet connection is back",
      offlineText = "No Internet Connection!";

  if (window.navigator.onLine) {
      internetStatus.css("display", "none").text(onlineText).addClass("internet-is-back").removeClass("internet-is-lost");
  } else {
      internetStatus.css("display", "block").text(offlineText).addClass("internet-is-lost").removeClass("internet-is-back");
  }

  window.addEventListener('offline', function () {
      internetStatus.text(offlineText).addClass("internet-is-lost").removeClass("internet-is-back").fadeIn(500);
  });

  window.addEventListener('online', function () {
      internetStatus.text(onlineText).addClass("internet-is-back").removeClass("internet-is-lost").delay("5000").fadeOut(500);
  });

  $(".offline-detection").on("click", function () {
      internetStatus.text(offlineText).addClass("internet-is-lost").removeClass("internet-is-back").fadeIn(500).delay("3000").fadeOut(500);
  });

  $(".online-detection").on("click", function () {
      internetStatus.text(onlineText).addClass("internet-is-back").removeClass("internet-is-lost").fadeIn(500).delay("3000").fadeOut(500);
  });

})(jQuery);


$(document).ready(function(){
  

    // Load more data
    $('.load-more').click(function(){
        var row = Number($('#row').val());
        var allcount = Number($('#all').val());
        var rowperpage = 20;
        row = row + rowperpage;

        if(row <= allcount){
            $("#row").val(row);

            $.ajax({
                url: 'getStoreData.php',
                type: 'post',
                data: {row:row},
                beforeSend:function(){
                    $(".load-more").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".post:last").after(response).show().fadeIn("slow");

                        var rowno = row + rowperpage;

                        // checking row value is greater than allcount or not
                        if(rowno > allcount){

                            // Change the text and background
                            $('.load-more').hide();
                            $('.no-more').show();

                            
                        }else{
                            $(".load-more").text("Load more");
                        }
                    }, 2000);

                }
            });
        }else{
            $('.load-more').text("Loading...");

            // Setting little delay while removing contents
            setTimeout(function() {

                // When row is greater than allcount then remove all class='post' element after 3 element
                $('.post:nth-child(3)').nextAll('.post').remove();

                // Reset the value of row
                $("#row").val(0);

                // Change the text and background
                $('.load-more').text("Load more");
                $('.load-more').css("background","#15a9ce");
                
            }, 2000);


        }

    });

});


//Search products
$(document).ready(function(){
  $('.close-icon').hide();
    $("#searchme").keyup(function(){
       var query = $(this).val();
       $('.close-icon').addClass("input-icon").show();
       $('.search-icon').removeClass("input-icon").hide();
       if (query != "") {
         $.ajax({
           url: 'product-search.php',
          type:'GET',
           data: {query:query},
           success: function(data){

             $('#search-output').html(data);
              $("#search-output").css('display', 'block');
                 $("#search-output").css('background', '#f0f0f0');
                
             //$('#search-output').css('display', 'block');

             /*$("#searchme").focusout(function(){
                 $('#search-output').css('display', 'none');
             });
             $("#searchme").focusin(function(){
                $("#search-output").css('display', 'block');
             });*/
           }
         });
       } else {
       $('#search-output').css('display', 'none');
     }
   });

});//Search products


//Fetch product rating
$(document).ready(function(){

    $('.productinfo').click(function(){
      
      var productid = $(this).data('id');
   
      // AJAX request
      $.ajax({
       url: 'product_rating.php',
       type: 'post',
       data: {productid: productid},
       success: function(response){ 
         // Add response in Modal body
         $('.review_detail').html(response);
   
         // Display Modal
         //$('#empModal').modal('show'); 
       }
     });
    });
   });




  $('.p_detail').click(function(){
    
    var detailid = $(this).data('id');
 
    // AJAX request
    $.ajax({
     url: 'product_detail.php',
     type: 'post',
     data: {detailid: detailid},
     success: function(response){ 
       // Add response in Modal body
       $('.product_detail').html(response);

     }
   });
  });
 

//Add to wishlist
 function addToWishlist(product_id){
    $.post('../inc/api.php',{product_id:product_id},
      function(res){
      if(res.trim() == "Done"){
        $.toast({ 
          text : '<b><ion-icon name="checkmark-circle"></ion-icon> &nbsp;Item successfully added to your wishlist</b>', 
          showHideTransition : 'fade',  
          bgColor : 'green',              
          textColor : '#fff',       
          allowToastClose : false,    
          hideAfter : 4000,
          loader: false,                               
          textAlign : 'center',           
          position : 'top-right'  
        });


      }else if(res.trim() == "failed"){

        $.toast({ 
          text : '<b><ion-icon name="sad"></ion-icon> &nbsp;Unable to add to your wishlist.</b>', 
          showHideTransition : 'fade',
          bgColor : 'red',            
          textColor : '#fff',
          allowToastClose : false,
          hideAfter : 4000,
          loader: false,            
          stack : 5,                     
          textAlign : 'center', 
          position : 'top-right'  
        });

      }
      else{

        $.toast({ 
          text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+res+'</b>', 
          showHideTransition : 'fade',
          bgColor : 'red',            
          textColor : '#fff',
          allowToastClose : false,
          hideAfter : 4000,
          loader: false,            
          stack : 5,                     
          textAlign : 'center', 
          position : 'top-right'  
        });


      }

  });
  }

  function deleteFromWishlist(product_id){
  
    $.post('../inc/api2.php',{product_id:product_id, act:"<?php echo substr(md5('delete-from-wishlist'), 3,15); ?>"},function(res){
      if(res){
        document.location.href = document.location.href;
      }

  });
  } 





  $(document).ready(function() {
      /* Quatity buttons */
      $('#q_up').click(function(){
        var q_val_up=parseInt($("#quantity_wanted").val());
        if(isNaN(q_val_up)) {
          q_val_up=0;
        }
        $("#quantity_wanted").val(q_val_up+1).keyup(); 
        return false; 
      });
      
      $('#q_down').click(function(){
        var q_val_up=parseInt($("#quantity_wanted").val());
        if(isNaN(q_val_up)) {
          q_val_up=0;
        }
        
        if(q_val_up>1) {
          $("#quantity_wanted").val(q_val_up-1).keyup();
        } 
        return false; 
      });
    
      });



//Fetch product detail
$(document).ready(function(){
//Watch for checkbutton clicked
$( ".iradio-type-button2 input:radio" ).on( "change", function() {
  $('.iradio-type-button2 input:not(:checked)').parent().removeClass("color-active");
  $('.iradio-type-button2 input:checked').parent().addClass("color-active");
 });


  $( ".iradio-pay input:radio" ).on( "change", function() {
  $('.iradio-pay input:not(:checked)').parent().removeClass("color-active");
  $('.iradio-pay input:checked').parent().addClass("color-active");
 });

 $( "#input-option input:radio" ).on( "change", function() {
  function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$('#input-option input:not(:checked)').parent().removeClass("size-active");
$('#input-option input:checked').parent().addClass("size-active");

var id = $("#input-option").find(":radio:checked").first().attr('id');
var  price = $( 'input[name=product_price]:checked' ).val();
$("#price-old").html("Amount for this variant: "+numberWithCommas(price));
var data = 'id=' + id;
$.ajax({
    type: "POST",
    url: "process.php",
    data: data,
    dataType: 'json',
    success: function (data) {
        if (data) {
            for (var i = 0; i < data.length; i++) { //for each user in the json response
                $("#product_id").val(data[i].product_id);
                $("#size").val(data[i].size);
                $("#prize").val(data[i].amount);
                $("#imgy").val(data[i].image);
            } // for

        } // if
    } // success
}); // ajax



});


}); 


//Add cart
$(document).ready(function() {

  $("#addToCart").click(function(e) {
     e.preventDefault();
       
     $("#addToCart").html('Adding Item...');
       var serializedData = $("#productForm").serialize();
       var cat = $("#cat_type").val();
      
       var size = $("#product_size").val();

       if(cat == "single" && $('input[name=color]:checked').length < 1){

        $.toast({ 
          text : '<b><ion-icon name="sad"></ion-icon> &nbsp;Select product color to continue.</b>', 
          showHideTransition : 'fade',
          bgColor : 'red',            
          textColor : '#fff',
          allowToastClose : false,
          hideAfter : 4000,
          loader: false,            
          stack : 5,                     
          textAlign : 'center', 
          position : 'top-right'  
        });
        
        $("#addToCart").html('<ion-icon name="cart"></ion-icon> Add to Cart');
        //location.reload(true);

       }
       else if(cat == "single" && $('input[name=product_size]:checked').length < 1){

        $.toast({ 
          text : '<b><ion-icon name="sad"></ion-icon> &nbsp;Select product size to continue.</b>', 
          showHideTransition : 'fade',
          bgColor : 'red',            
          textColor : '#fff',
          allowToastClose : false,
          hideAfter : 4000,
          loader: false,            
          stack : 5,                     
          textAlign : 'center', 
          position : 'top-right'  
        });
        $("#addToCart").html('<ion-icon name="cart"></ion-icon> Add to Cart');
       }

       else if(cat == "different" && $('input[name=color]:checked').length < 1){
        $.toast({ 
          text : '<b><ion-icon name="sad"></ion-icon> &nbsp;Select product color to continue.</b>', 
          showHideTransition : 'fade',
          bgColor : 'red',            
          textColor : '#fff',
          allowToastClose : false,
          hideAfter : 4000,
          loader: false,            
          stack : 5,                     
          textAlign : 'center', 
          position : 'top-right'  
        });
        $("#addToCart").html('<ion-icon name="cart"></ion-icon> Add to Cart');
       
       }
     else if(cat == "different" && $('input[name=product_price]:checked').length < 1){

      $.toast({ 
        text : '<b><ion-icon name="sad"></ion-icon> &nbsp;Select product size to continue.</b>', 
        showHideTransition : 'fade',
        bgColor : 'red',            
        textColor : '#fff',
        allowToastClose : false,
        hideAfter : 4000,
        loader: false,            
        stack : 5,                     
        textAlign : 'center', 
        position : 'top-right'  
      });
      $("#addToCart").html('<ion-icon name="cart"></ion-icon> Add to Cart');
       }
       
else{
  $("#addToCart").html('Adding Item...');
      $.ajax({

           type : 'POST',
           url  : '../inc/createCart.php',
           data : serializedData,
           success :  function(res)
           {
               if(res.trim() == 1)
               {
                $.toast({ 
                  text : '<b><ion-icon name="checkmark-circle"></ion-icon> &nbsp;Item added to cart Successfully</b>', 
                  showHideTransition : 'fade',  
                  bgColor : 'green',              
                  textColor : '#fff',       
                  allowToastClose : false,    
                  hideAfter : 4000,
                  loader: false,                               
                  textAlign : 'center',           
                  position : 'top-right'  
                });
                 $(".icart").load(location.href + " .icart");
                 $("#addToCart").html('<ion-icon name="cart"></ion-icon> Add to Cart');
                 //$("#PanelLeft").modal('hide');
                 $("#actionSheetForm").modal("hide");
                 //$("#actionSheetForm").modal('hide');
                 //$('.modal').modal('toggle');
                 // $('.modal-backdrop').removeClass('modal-backdrop');
                  //$('.action-sheet').removeClass('action-sheet');
          
     }else{
              $.toast({ 
                text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+res+'</b>', 
                showHideTransition : 'fade',
                bgColor : 'red',            
                textColor : '#fff',
                allowToastClose : false,
                hideAfter : 4000,
                loader: false,            
                stack : 5,                     
                textAlign : 'center', 
                position : 'top-right'  
              });

              $("#addToCart").html('<ion-icon name="cart"></ion-icon> Add to Cart').addClass('btn-block btn-lg');

     }
           }
       });
       
     }

 return false;
   });
});

//Product quick shop
$(document).ready(function(){
  $(".quickShop").click(function() {
   
   var pid = $(this).attr('id'); // get id of clicked row
   $("#product_contents").addClass('loadingOverlay'); // leave this div blank
   
   //var buttonId = $(this).attr('id');
   $('#modal-container').removeAttr('class').addClass('seven');
   $('body').addClass('modal-active');

   $.ajax({

    type : 'POST',
    url  : 'getAddCart.php',
    data: 'id='+pid,
    dataType: 'html',
    cache: false,
    success :  function(data)
    {
     
        $('#product_contents').html(data).removeClass('loadingOverlay');

    }
    });//ajax
 

  

  });


  $(".closeMe").click(function(e) { 
   // e.preventDefault();
    $('#modal-container').addClass('out');
    $('body').removeClass('modal-active');
  });

});



/////////////////// product +/-
$(document).ready(function() {
  $('.num-in span').click(function () {
   
      var $input = $(this).parents('.num-block').find('input.in-num');
    if($(this).hasClass('minus')) {
      var count = parseFloat($input.val()) - 1;
      count = count < 1 ? 1 : count;

       //get parent of the button
     var row = $(this).parent().parent();
     var minus = 'minus';
     var id  = row.find(".mid").val();
     var qty  = row.find(".qty").val();
      
      $.ajax({

        type : 'POST',
        url  : 'updateCart.php',
        data : { id: id, cat: minus, qty: qty},
        cache: false,
        success :  function(res)
        {
          if(res.trim() == 1)
          {

            /*$.toast({ 
              text : '<b><ion-icon name="checkmark-circle"></ion-icon> &nbsp;Cart updated successfully</b>', 
              showHideTransition : 'fade',  
              bgColor : 'green',              
              textColor : '#fff',       
              allowToastClose : false,    
              hideAfter : 4000,
              loader: false,                               
              textAlign : 'center',           
              position : 'top-right'  
            });*/

            location.reload(true);

         // $(".refreshme").load(location.href + " .refreshme");

          }else if(res.trim() == 2)
          {
          }
          else{
            $.toast({ 
              text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+res+'</b>', 
              showHideTransition : 'fade',
              bgColor : 'red',            
              textColor : '#fff',
              allowToastClose : false,
              hideAfter : 4000,
              loader: false,            
              stack : 5,                     
              textAlign : 'center', 
              position : 'top-right'  
            });

          }
          }
          });//ajax
    

      if (count < 2) {
        $(this).addClass('dis');
        //alert(count);
      }
      else {
        $(this).removeClass('dis');
        
      }
      $input.val(count);
    }
    else {
      var count = parseFloat($input.val()) + 1
      $input.val(count);

       //get parent of the button
     var row = $(this).parent().parent();
     var minus = 'plus';
     var id  = row.find(".mid").val();
     var qty  = row.find(".qty").val();
      
      $.ajax({

        type : 'POST',
        url  : 'updateCart.php',
        data : { id: id, cat: minus, qty: qty},
        cache: false,
        success :  function(res)
        {
          if(res.trim() == 1)
          {

            /*$.toast({ 
              text : '<b><ion-icon name="checkmark-circle"></ion-icon> &nbsp;Cart updated successfully</b>', 
              showHideTransition : 'fade',  
              bgColor : 'green',              
              textColor : '#fff',       
              allowToastClose : false,    
              hideAfter : 4000,
              loader: false,                               
              textAlign : 'center',           
              position : 'top-right'  
            });*/

            location.reload(true);

         // $(".refreshme").load(location.href + " .refreshme");

          }else if(res.trim() == 2)
          {
          }
          else{
            $.toast({ 
              text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+res+'</b>', 
              showHideTransition : 'fade',
              bgColor : 'red',            
              textColor : '#fff',
              allowToastClose : false,
              hideAfter : 4000,
              loader: false,            
              stack : 5,                     
              textAlign : 'center', 
              position : 'top-right'  
            });

          }
          }
          });




      if (count > 1) {
        $(this).parents('.num-block').find(('.minus')).removeClass('dis');
      }
    }
    
    $input.change();
    return false;
  });
  
});
// product +/-



//delete cart

$(document).ready(function(){
  $(".btn-delete").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row 
     var title = $(this).attr("datatitle");
     var color = $(this).attr("datacolor");
     
 
   //confirm("Are you sure you want to delete "+pid+"? There is no undo."); 
   $.post("../inc/deleteCart.php", {"id": pid, }, 
  function(res) {
      if(res.trim() == 1)
              {
                $.toast({ 
                  text : '<b><ion-icon name="checkmark-circle"></ion-icon> &nbsp;Item deleted from cart successfully</b>', 
                  showHideTransition : 'fade',  
                  bgColor : 'green',              
                  textColor : '#fff',       
                  allowToastClose : false,    
                  hideAfter : 4000,
                  loader: false,                               
                  textAlign : 'center',           
                  position : 'top-right'  
                });
        
      location.reload(true);
    }else{
      $.toast({ 
        text : '<b><ion-icon name="sad"></ion-icon> &nbsp;'+res+'</b>', 
        showHideTransition : 'fade',
        bgColor : 'red',            
        textColor : '#fff',
        allowToastClose : false,
        hideAfter : 4000,
        loader: false,            
        stack : 5,                     
        textAlign : 'center', 
        position : 'top-right'  
      });
    }
      
  });
 



  });
});



//Country select

$(document).ready(function()
{
$("#mcountry").change(function()
{
var country_id=$(this).val();
var post_id = 'country_id='+ country_id;
//alert(post_id);
 
$.ajax
({
type: "POST",
url: "../inc/country.php",
data: post_id,
cache: false,
success: function(cities)
{
$("#mstates").html(cities);
} 
});
 
}).trigger('change');
});

//Get tax state from the selected country
$(document).ready(function()
{
$("#taxcountry").change(function()
{
var country_id=$(this).val();
var post_id = 'country_id='+ country_id;
 
$.ajax
({
type: "POST",
url: "inc/tax/states.php",
data: post_id,
cache: false,
success: function(cities)
{
$('#mstates').empty();
$("#taxstates").html(cities);
} 
});
 
}).trigger('change');
});




//Registration from checkout
$('.regFormBtns').click(function(e){ 
  e.preventDefault(); 
  
        var formElem = $("#regForms");
        var formdata = new FormData(formElem[0]);
  
  
             $.ajax({  
                  url:"../inc/user/addUser.php",  
                  method:"POST",  
                  data: formdata, 
                  processData: false,
                  contentType: false, 
                  success:function(data)  
                  {  
  
                    if(data.trim() == 1){

                  
                   // $('#productForm')[0].reset();  
                   location.href = 'checkout';
                   
                    }else{
                      $.toast({ 
                        text : data, 
                        showHideTransition : 'fade',
                        bgColor : 'red',            
                        textColor : '#fff',
                        allowToastClose : false,
                        hideAfter : 4000,
                        loader: false,            
                        stack : 5,                     
                        textAlign : 'center', 
                        position : 'top-right'  
                      });
                    }
                       //alert(data);  
                       
                  }  
             }); 
  
  
        }); 


//Registration

$('.regFormBtn').click(function(e){ 
  e.preventDefault(); 
  
        var formElem = $("#regForm");
        var formdata = new FormData(formElem[0]);
  
  
             $.ajax({  
                  url:"../inc/user/addUser.php",  
                  method:"POST",  
                  data: formdata, 
                  processData: false,
                  contentType: false, 
                  success:function(data)  
                  {  
  
                    if(data.trim() == 1){

                      $.toast({ 
                        text : '<b><ion-icon name="checkmark-circle"></ion-icon> &nbsp;Successfully registered. You can Proceed with your shopping from your page. <br/>Thank you for shopping with us.</b>', 
                        showHideTransition : 'fade',  
                        bgColor : 'green',              
                        textColor : '#fff',       
                        allowToastClose : false,    
                        hideAfter : 4000,
                        loader: false,                               
                        textAlign : 'center',           
                        position : 'top-right'  
                      });


                   // $('#productForm')[0].reset();  
                   location.href = 'index';
                   
                    }else{
                      $.toast({ 
                        text : data, 
                        showHideTransition : 'fade',
                        bgColor : 'red',            
                        textColor : '#fff',
                        allowToastClose : false,
                        hideAfter : 4000,
                        loader: false,            
                        stack : 5,                     
                        textAlign : 'center', 
                        position : 'top-right'  
                      });
                    }
                       //alert(data);  
                       
                  }  
             }); 
  
  
        }); 
  
  $('#addAddrForm').click(function(e){ 
  e.preventDefault(); 
  
        var formElem = $("#newAddrForm");
        var formdata = new FormData(formElem[0]);
  
  
             $.ajax({  
                  url:"../inc/addShippingAddress.php",  
                  method:"POST",  
                  data: formdata, 
                  processData: false,
                  contentType: false, 
                  success:function(data)  
                  {  
  
                    if(data.trim() == 1){
                     $(".mymsg").html('<div class="alert alert-success">Successfully added.</div>').show();
            setTimeout(function() {
                $(".mymsg").fadeOut(1500);
            }, 10000);
   
                   // $('#productForm')[0].reset();  
                   //location.href = 'checkout';
                    document.location.href = document.location.href;
                   
                    }else{
                      $(".mymsg").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
            setTimeout(function() {
                $(".mymsg").fadeOut(1500);
            }, 10000);
                    }
                       //alert(data);  
                       
                  }  
             }); 
  
  
        }); 






        
$(function() {
    
  var $formLogin = $('#login-form');
  var $formLost = $('#lost-form');
  var $formRegister = $('#register-form');
  var $divForms = $('#div-forms');
  var $modalAnimateTime = 300;
  var $msgAnimateTime = 150;
  var $msgShowTime = 2000;

  $("form").submit(function () {
      switch(this.id) {
          case "login-form":
              var $lg_username=$('#login_username').val();
              var $lg_password=$('#login_password').val();
              if ($lg_username == "ERROR") {
                  msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "Login error");
              } else {
                  msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "glyphicon-ok", "Login OK");
              }
              return false;
              break;
          case "lost-form":
              var $ls_email=$('#lost_email').val();
              if ($ls_email == "ERROR") {
                  msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
              } else {
                  msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
              }
              return false;
              break;
          case "register-form":
              var $rg_username=$('#register_username').val();
              var $rg_email=$('#register_email').val();
              var $rg_password=$('#register_password').val();
              if ($rg_username == "ERROR") {
                  msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Register error");
              } else {
                  msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Register OK");
              }
              return false;
              break;
          default:
              return false;
      }
      return false;
  });
  
  $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
  $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });
  $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
  $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
  $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
  $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });
  
  function modalAnimate ($oldForm, $newForm) {
      var $oldH = $oldForm.height();
      var $newH = $newForm.height();
      $divForms.css("height",$oldH);
      $oldForm.fadeToggle($modalAnimateTime, function(){
          $divForms.animate({height: $newH}, $modalAnimateTime, function(){
              $newForm.fadeToggle($modalAnimateTime);
          });
      });
  }
  
  function msgFade ($msgId, $msgText) {
      $msgId.fadeOut($msgAnimateTime, function() {
          $(this).text($msgText).fadeIn($msgAnimateTime);
      });
  }
  
  function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
      var $msgOld = $divTag.text();
      msgFade($textTag, $msgText);
      $divTag.addClass($divClass);
      $iconTag.removeClass("glyphicon-chevron-right");
      $iconTag.addClass($iconClass + " " + $divClass);
      setTimeout(function() {
          msgFade($textTag, $msgOld);
          $divTag.removeClass($divClass);
          $iconTag.addClass("glyphicon-chevron-right");
          $iconTag.removeClass($iconClass + " " + $divClass);
    }, $msgShowTime);
  }
});




$(document).ready(function() {
  // Open active tab based on button clicked
   $('.btn-modal').on('click', function() {
     var switchTab = $(this).data('tab');   
     activaTab(switchTab);
     function activaTab(switchTab) {
         $('.nav-tabs a[href="#' + switchTab + '"]').tab('show');
     };
   });
  
  // Toggle New/Existing Customer
   var custType = $('#customer-type'),
       newCust = $('.new-customer'),
       existCust = $('.existing-customer'),
       createAccBtn = $('.create-account'),
       verifyAccBtn = $('.verify-account');
  
   custType.val($(this).is(':checked'))
           .change(function() {
   if ($(this).is(':checked')) {
         newCust.fadeToggle(400, function() { // Hide Full form when checked
           existCust.fadeToggle(500); //Display Small form when checked
           createAccBtn.toggleClass('hide');
           verifyAccBtn.toggleClass('hide');
         });
         
       } else {
         existCust.fadeToggle(400, function() { //Hide Small form when unchecked
           newCust.fadeToggle(500); //Display Full form when unchecked
           createAccBtn.toggleClass('hide');
           verifyAccBtn.toggleClass('hide');
         });
         
       }
  });
 });






