$("#userlog").submit(function(e){
			e.preventDefault();
			var value =$("#userlog").serialize() ;
			$.ajax({
				url:baseurl+'Login/login_auth',
				type:'POST',
				data:value,
				success:function(result){
					if(result==0){
						$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Invalid UserName/Password.</b></div>');
						$("#msg").show();
						setTimeout(function(){$("#msg").hide(); }, 3000);

					}
					else{	
						window.location.href=baseurl+"dashboard";
						
					}
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});

		});

function Addtocart(id){

		$.ajax({
		  url : baseurl+'Products/AddtoCart',
		  type: "POST",
		  data: {id: id} ,
		  success: function (data) {
			if(data == 2){
			  alert('Error ! Something Wrong in your Cart');
			}
			else{
			  $('#profilemsg').html('<b style="color: error;">Error Submitting your request. Please Try Again. </b>');
			}
		  },
		  error: function (xhr, textStatus, errorThrown) 
		  {
			console.log(xhr.responseText);
		  }
		});
		
	
	
}
function RemovetoCart(id){
if(confirm("Are you sure you want to remove this from cart?")){
        	$.ajax({
		  url : baseurl+'Products/RemovetoCart',
		  type: "POST",
		  data: {rowid: id} ,
		  success: function (data) {
			if(data == 1){
			  $('#cartmsg').html('<p><b style="color: green;">Product Successfully Deleted </b></p>');setTimeout(function(){location.reload(); }, 1000);
			}
			
			else{
			  $('#cartmsg').html('<b style="color: error;">Error Submitting your request. Please Try Again. </b>');
			}
		  },
		  error: function (xhr, textStatus, errorThrown) 
		  {
			console.log(xhr.responseText);
		  }
		});
    }
    else{
        return false;
    }
	
		
	
	
}

function PromoApply(){


var code=$('#promo_code').val();

		$.ajax({
		  url : baseurl+'Products/CheckPromo',
		  type: "POST",
		  data: {code: code} ,
		  success: function (data) {
			  if(data==0){
				  $('#promomsg').html('<p style="color:red;">Code Already In Use.</p>');
				  $('#promo_show').show();
			  } 
				else if(data==1){
				  $('#promomsg').html('<p style="color:red;">Limit Exceeded ! Try Another Code.</p>');
			  }
			else if(data == 2){
				$('#promo_show').hide();
			  $('#promomsg').html('<p style="color:red;">Invalid Code ! Try Another Code</p>');
			}
			
			else{
				$('#promo_show').hide();
			  $('#promomsg').html('<p style="color:green;">Code Sucessfully Applied</p>');
				var promo=JSON.parse(data);
				var sub=$('#subtotal').val();
				var subtotal=sub*(promo.price/100);
				var subtotal = Math.ceil(subtotal);
				var subtotal = sub-subtotal;
			  $('#promo_show').show();
			  $('#promo-code').html(promo.code);
			  $('#promo_id').val(promo.id);
			  $('#promo-rate').html(promo.price+'%');
			  $('#subtotalshow').html('$'+subtotal+'.00');
			  
			}
		  },
		  error: function (xhr, textStatus, errorThrown) 
		  {
			console.log(xhr.responseText);
		  }
		});
		
	
	
}


