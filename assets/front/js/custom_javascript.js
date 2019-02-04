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
						setTimeout(function(){$("#msg").hide(); }, 5000);

					}
					else if(result==2){
						$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> User is not active.</b></div>');
						$("#msg").show();
						setTimeout(function(){$("#msg").hide(); }, 5000);
						
					}
					else{	
						window.location.href=baseurl+"login";

						
					}
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});

		});
$("#forgotform").submit(function(e){
			e.preventDefault();
			var value =$("#forgotform").serialize() ;
			$.ajax({
				url:baseurl+'Login/fpasssubmit',
				type:'POST',
				data:value,
				success:function(result){
					if(result==0){
						$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Error ! Invalid Email Address.</b></div>');
						$("#msg").show();

					}
					else{	
						$("#msg").html('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Successfully ! Check your mail.</b></div>');
						$("#msg").show();
						
					}
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});

		});
		
			$( "#usersignup" ).on( "submit", function(e){
		e.preventDefault();
			var pass=$('#password').val();
			var cpass=$('#cpassword').val();
			if(pass != cpass){
				$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Password Not Matched</b></div>');
			}
			else{
			var value =$("#usersignup").serialize() ;
			$.ajax({
				url:baseurl+'Signup/InsertRecord',
				type:'POST',
				data:value,
				success:function(result){
					if(result==0){
						$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Email Address Already Exists</b></div>');
						$("#msg").show();
						setTimeout(function(){$("#msg").hide(); }, 3000);

					}
					else{	
						
						$("#msg").html('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Successfully Registered ! Check your mail</b></div>');
						$("#msg").show();
						setTimeout(function(){location.href=baseurl+"login"} , 5000);  
						
					}
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});
		 }

		});
		$("#changepasswordform").submit(function(e){
			e.preventDefault();
			var pass=$('#password').val();
			var cpass=$('#cpassword').val();
			if(pass != cpass){
				$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Password Not Matched</b></div>');
			}
			else{
			var value =$("#changepasswordform").serialize() ;
			$.ajax({
				url:baseurl+'Login/changepasssubmit',
				type:'POST',
				data:value,
				success:function(result){
					if(result==0){
						$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Error ! Password Not Changed</b></div>');
						$("#msg").show();
						setTimeout(function(){$("#msg").hide(); }, 3000);

					}
					else{	
						
						$("#msg").html('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Succesfully Password Changed ! Login with new credentials</b></div>');
						$("#msg").show();
						setTimeout(function(){location.href=baseurl+"login"} , 3000);  
						
					}
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});
		 }

		});
	$("#newchangepasswordform").submit(function(e){
			e.preventDefault();
			var pass=$('#password').val();
			var cpass=$('#cpassword').val();
			if(pass != cpass){
				$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Password Not Matched</b></div>');
			}
			else{
			var value =$("#newchangepasswordform").serialize() ;
			$.ajax({
				url:baseurl+'ChangePassword/changepasssubmit',
				type:'POST',
				data:value,
				success:function(result){
					if(result==0){
						$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Old Password Incorrect</b></div>');
						$("#msg").show();
						setTimeout(function(){$("#msg").hide(); }, 3000);

					}
					else{	
						
						$("#msg").html('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Succesfully Password Changed ! Login with new credentials</b></div>');
						$("#msg").show();
						setTimeout(function(){location.href=baseurl+"logout"} , 3000);  
						
					}
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});
		 }

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
				$.dialog({
		    title: 'Successfully Added',
		    content: 'Added to your cart',
		});
				location.reload();
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
			   
				if(data==1){
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
			  $('#discount').val(promo.code);
			  $('#promo-rate').html(promo.price+'%');
			  $('#subtotalshow').html('$'+subtotal+'.00');
			  $('#amount').val(subtotal);
			  $('#pckg_amount').val(subtotal);
			  
			}
		  },
		  error: function (xhr, textStatus, errorThrown) 
		  {
			console.log(xhr.responseText);
		  }
		});
		
	
	
}

function weekClick(id,no){
	$('.weeks').removeClass('active_week');
	$('#week'+id).addClass('active_week');
	$('#weekid').html('Week '+no+' Nutritions');
		$.ajax({
		  url : baseurl+'Dashboard/weekShow',
		  type: "POST",
		  data: {weekid: id} ,
		  success: function (data) {
			if(data !=""){
			  $('.planshow').html(data);			  
			}
			
			else{
			  $('.planshow').html('<h5 class="text-center">No Result Found</h5>');
			}
		  },
		  error: function (xhr, textStatus, errorThrown) 
		  {
			console.log(xhr.responseText);
		  }
		});		$.ajax({
		  url : baseurl+'Dashboard/weekdetails',
		  type: "POST",
		  data: {weekid: id} ,
		  success: function (data) {
			if(data !=""){
			  $('#nutritioncontent').html(data);			  
			}			else{			  $('#nutritioncontent').html('<h5 class="text-center">No Result Found</h5>');
			}
		  },
		  error: function (xhr, textStatus, errorThrown) 
		  {
			console.log(xhr.responseText);
		  }
		});
	
	
}


function EndStartWorkout(id){
	if(confirm("Are you sure you want to end this workout ? ")){
		$.ajax({
		  url : baseurl+'DashboardWorkout/EndWorkout',
		  type: "POST",
		  data: {id: id} ,
		  success: function (data) {
			if(data == 1){
			setTimeout(function(){ location.href=baseurl+'thank-you'; }, 1000);
			  $('#workoutmsg').html('<b style="color: green;">Successfully Submitted</b>');
			}
			else{
				setTimeout(function(){ location.reload(); }, 1000);
			  $('#workoutmsg').html('<b style="color: error;">Error Submitting your request. Please Try Again. </b>');
			}
		  },
		  error: function (xhr, textStatus, errorThrown) 
		  {
			console.log(xhr.responseText);
		  }
		});
	}else{
		
		return false;
	}
}
$(document).on("click", ".chk_week_day", function () {
	var weekid = $(this).attr("weekid");
	var dayno = $(this).attr("dayno");
	var userid = $(this).attr("userid");
	var coursid = $(this).attr("coursid");
	var slg = $(this).attr("slg");
	$.ajax({
        url: baseurl+'Dashboard/check_workout',
        data: {weekid: weekid, dayno: dayno, userid: userid, coursid: coursid, slg: slg},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
        	window.location.href = baseurl+'dashboard-workout/'+slg;
        },
        error: function () {
        }
    });
});

function worout_finished(weekid,dayno,userid,courseid,slg,divid){
	var weekid = weekid;
	var dayno = dayno;
	var userid = userid;
	var coursid = courseid;
	var slg = slg;
	var divid = divid;
	$.ajax({
        url: baseurl+'Dashboard/check_workout_finished',
        data: {weekid: weekid, dayno: dayno, userid: userid, coursid: coursid, slg: slg},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
        	if(result == 'finished'){
        		$("#"+divid).addClass( "finish" );
        	}else{}
        	//window.location.href = baseurl+'dashboard-workout/'+slg;
        },
        error: function () {
        }
    });
}

