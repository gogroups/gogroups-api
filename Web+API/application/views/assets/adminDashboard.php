<script type="text/javascript">

		function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#group_image')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);

                $('#group_image_btn').append('<button id="groupEditImageSaveBtn" style="margin-top:5px;">Save</button>')   
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

/********** get Details of seller *******/

    	$('#sellerTable tbody tr .seller_profile').click(function(){
    		var user_id  = $(this).attr('id');
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_pending_sellers_details/') ?>'+user_id,
	            success: function (data) {
	            	
	            	console.log(data);
	              	$('#full_name').html(data['name']);
	              	$('#company_name').html(data['seller_companyName']);
	              	$('#contact').html(data['seller_companyName']);
	              	$('#zipcode').html(data['zipcode']);
	              	$('#email').html(data['email']);
	              	$('#secondary_name').html(data['seller_secondary_name']);
	              	$('#location').html(data['location']);

	              	$('#address').html(data['address']);
	              	$('#account_number').html(data['account_number']);
	              	$('#ac_holder_name').html(data['ac_holder_name']);
	              	$('#bank_name').html(data['bank_name']);
	              	$('#ifsc').html(data['ifsc']);
	              	$('#paytm_no').html(data['paytm_no']);
	              	
	              	$('#secondary_contact').html(data['seller_secondary_contact']);
	              	$('#seller_gst').html(data['seller_tinNo']);
	              	$('#secondary_email').html(data['seller_secondary_email']);
	              	$('#seller_usp').html(data['seller_usp']);
	              	if(data['profile_image'] != null && data['profile_image'] != ''){
	              		$('#seller_image').attr('src','<?php echo base_url('userImages/');?>'+data['profile_image']);
	              	}else{
	              		$('#seller_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}
            }
    		});
    	});

    	//******** approve Seller Request ******/

    	$('#sellerTable tbody tr .approve_seller').click(function(){
    		var user_id = $(this).attr('id');
    		var div=$('.stats-atinder').html();
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/approve_seller_request/') ?>'+user_id,
	            success: function (data) {
	            	if(data.status == true){
	            		//$('.seller_messsage').html(data.message).addClass('alert alert-success');
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('admin/home'); ?>";
						  },1000);
	            		
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});

    	$("#RejectSeller").validate({
	errorElement:'span_error',
		rules: {
				reason: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('sellerController/reject_reason') ?>',
	            dataType: 'json',
	            data: $('#RejectSeller').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('admin/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});



$('.reasonReject').click(function(){
	var user_id = $(this).attr('id');
	
	$('#rejectPop').modal('show');
	$('#seller_id').val(user_id);
});

$("#RejectUser").validate({
	errorElement:'span_error',
		rules: {
				reason: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
				 url: '<?php echo base_url('admin/reject_seller_request/') ?>',
	            dataType: 'json',
	            data: $('#RejectUser').serialize(),
	            success: function (data) {
	            	alert('success');
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('admin/home'); ?>";
							  },1000);
	            	}else{
	            		alert('error');
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});


$('.reasonReject1').click(function(){
	
	var ads_id = $(this).attr('id');
	var seller_id = $(this).attr('seller');

	
	$('#rejectPop1').modal('show');
	$('#advertisement_id').val(ads_id);
	$('#seller_id_adv').val(seller_id);
});



$("#RejectAds").validate({
	errorElement:'span_error',
		rules: {
				reason: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
				 url: '<?php echo base_url('admin/reject_adv_request/') ?>',
	            dataType: 'json',
	            data: $('#RejectAds').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('admin/home'); ?>";
							  },1000);
	            	}else{
	            		alert('error');
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$('.reasonReject3').click(function(){
	var group_id = $(this).attr('id');
	var user_id = $(this).attr('user');
	
	$('#rejectPop2').modal('show');
	$('#group_id').val(group_id);
	$('#group_user_id').val(user_id);
});

$("#RejectGroup").validate({
	errorElement:'span_error',
		rules: {
				reason: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('admin/reject_group_request/') ?>',
	            dataType: 'json',
	            data: $('#RejectGroup').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('admin/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});


    	//******** approve Seller Request ******/

    	// $('#sellerTable tbody tr .reject_seller').click(function(){
    	// 	var user_id = $(this).attr('id');

    	// 	$.ajax({
    	// 		type: 'post',
    	// 		dataType:'json',
	    //         url: '<?php echo base_url('admin/reject_seller_request/') ?>'+user_id,
	    //         success: function (data) {
	    //         	if(data.status == true){
	    //         		toastr.success(data.message);
	    //         		 setTimeout(function(){
					// 	     window.location.href = "<?php echo base_url('admin/home'); ?>";
					// 	  },1000);
	    //         	}else{
	    //         		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	    //         	}
	    //         }
    	// 	})
    	// });

/******* seller details in Ads *******/

    	$('#adsTable tbody tr .seller_profile').click(function(){
    		//console.log("sgsg");
    		var user_id  = $(this).attr('id');
    		console.log(user_id);
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_pending_sellers_details/') ?>'+user_id,
	            success: function (data) {
	            	
	              	$('#full_name').html(data['name']);
	              	$('#company_name').html(data['seller_companyName']);
	              	$('#contact').html(data['seller_companyName']);
	              	$('#zipCode').html(data['zipcode']);
	              	$('#email').html(data['email']);
	              	$('#secondary_name').html(data['seller_secondary_name']);
	              	$('#location').html(data['location']);

	              	$('#address').html(data['address']);
	              	$('#account_number').html(data['account_number']);
	              	$('#ac_holder_name').html(data['ac_holder_name']);
	              	$('#bank_name').html(data['bank_name']);
	              	$('#ifsc').html(data['ifsc']);
	              	$('#paytm_no').html(data['paytm_no']);

	              	$('#secondary_contact').html(data['seller_secondary_contact']);
	              	$('#seller_gst').html(data['seller_tinNo']);
	              	$('#secondary_email').html(data['seller_secondary_email']);
	              	$('#seller_usp').html(data['seller_usp']);
	              	if(data['profile_image'] != null && data['profile_image'] != ''){
	              		$('#seller_image').attr('src','<?php echo base_url('userImages/');?>'+data['profile_image']);
	              	}else{
	              		$('#seller_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}

            }
    		});
    	});

/******** get advertisements details ********/

	$('#adsTable tbody tr .ads_details').click(function(){
		var adv_id = $(this).attr('id');
		$("#sub_category2").html("");
		$("#sub_category3").html("");
		$('#append_images').html("");
		$.ajax({
			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_advertisement_details_id/') ?>'+adv_id,
	            success: function (data) {
	            	//console.log(data[0]);
	            	console.log(data);
	            	$('#ad_name').html(data[0]['advertisement_name']);
	            	$('#created_by').html(data[0]['name']);
	              	$('#category').html(data[0]['category_title']);
	              	$('#sub_category').html(data[0]['subcategory_title']);
	              	$('#user_count').html(data[0]['user_count']);
	              	$('#actual_price').html('INR '+data[0]['actual_price']);
	              	$('#offer_price').html('INR '+data[0]['offer_price']);
	              	$('#offerfortwo').html(data[0]['offerfortwo']);
	              	$('#start_date').html(data[0]['start_date']);
	              	$('#end_date').html(data[0]['end_date']);
	              	$('#last_edited').html(data[0]['HistoryOfChange']);
	              	$('#ad_detail').html(data[0]['advertisement_details']);

	              	if( data[0]['subcategory_title2'] != '' && data[0]['subcategory_title2'] != null){
	              		$("#sub_category2").append("<div class='col-md-3'>Sub Category2:</div><div class='col-md-3'>"+ data[0]['subcategory_title2'] +"</div>").show();
	              	}
	              	if(data[0]['subcategory_title3'] != ''  && data[0]['subcategory_title3'] != null ){
	              		$("#sub_category2").append("<div class='col-md-3'>Sub Category3:</div><div class='col-md-3'>"+ data[0]['subcategory_title3'] +"</div>").show();
	              	}
	              	if(data[0]['subcategory_title4'] != ''  && data[0]['subcategory_title3'] != null){
	              		$("#sub_category3").append("<div class='col-md-3'>Sub Category4:</div><div class='col-md-3'>"+ data[0]['subcategory_title4'] +"</div>").show();
	              	}
	              	if(data[0]['subcategory_title5'] != ''  && data[0]['subcategory_title3'] != null){
	              		$("#sub_category3").append("<div class='col-md-3'>Sub Category5:</div><div class='col-md-3'>"+ data[0]['subcategory_title5'] +"</div>").show();
	              	}
	              	$.each(data, function(key,val) {
			           // $('#adv_images').attr('src', val.image_path);
			            var dom = "<img class='col-md-3' src='<?php echo base_url('advertisementImages/');?>"+val.image_path+"' id='adv_images'/>";

			            $('#append_images').append(dom);
			        });
	            }
		});
	});


	    	//******** approve Advertisement Request ******/

    	$('#adsTable tbody tr .approve_advertise').click(function(){
    		var adv_id = $(this).attr('id');
    		var seller_id = $(this).attr('seller');

    		$.ajax({
    			type: 'post',
    			dataType:'json',
    			data: {'seller_id': seller_id},
	            url: '<?php echo base_url('admin/approve_adv_request/') ?>'+adv_id,
	            success: function (data) {
	            	if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('admin/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});


    	/********* rejected Advertisement Request ******/
    	// $('#adsTable tbody tr .reject_advertise').click(function(){
    	// 	var adv_id = $(this).attr('id');
    	// 	var seller_id = $(this).attr('seller');

    	// 	$.ajax({
    	// 		type: 'post',
    	// 		dataType:'json',
    	// 		data: {'seller_id': seller_id},
	    //         url: '<?php echo base_url('admin/reject_adv_request/') ?>'+adv_id,
	    //         success: function (data) {
	    //         	if(data.status == true){
	    //         		toastr.success(data.message);
	    //         		setTimeout(function(){
					// 	     window.location.href = "<?php echo base_url('admin/home'); ?>";
					// 	  },1000);
	    //         	}else{
	    //         		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	    //         	}
	    //         }
    	// 	})
    	// });

/******* get group user details *******/
    	$('#groupTable tbody tr .user_group_profile').click(function(){
    		var user_id  = $(this).attr('id');
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_pending_sellers_details/') ?>'+user_id,
	            success: function (data) {
	              	$('#user_full_name').html(data['name']);
	              	$('#user_contact').html(data['contact_number']);
	              	$('#user_zipcode').html(data['zipcode']);
	              	$('#user_email').html(data['email']);
	              	$('#user_age').html(data['age']);
	              	$('#user_location').html(data['location']);
	              	if(data['profile_image'] != null && data['profile_image'] != ''){
	              		$('#user_image').attr('src','<?php echo base_url('userImages/');?>'+data['profile_image']);
	              	}else{
	              		$('#user_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}
            }
    		});
    	});

/*********** Group details by id *******/
$('#groupTable tbody tr .group_details').click(function(){
			if ($('#groupEditImageSaveBtn').length) {
				$('#groupEditImageSaveBtn').remove();
				}
				$('.group_edit_image_btn').val('');
    		var group_id  = $(this).attr('id');
    		$('#group2').html("");
    		$('#group3').html("");
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_group_details_id/') ?>'+group_id,
	            success: function (data) {
	            	console.log(data.group_details.group_id_name);

	              	$('#group_name').html(data['group_details']['group_name']);
	              	$('#group_location').html(data['group_details']['location']);
	              	$('#group_created_by').html(data['group_details']['name']);
	              	$('#group_category').html(data['group_details']['category_title']);
	              	$('#group_sub_category').html(data['group_details']['subcategory_title']);
	              	$('#member_count').html(data['group_details']['members_count']);
	              	$('#group_start_date').html(data['group_details']['start_date']);
	              	$('#group_end_date').html(data['group_details']['end_date']);
	              	$('#group_last_editied').html(data['group_details']['HistoryOfChange']);
	              	$('#group_descr').html(data['group_details']['description']);

	              	$('.group_edit_image_btn').attr("data-group-id",data['group_details']['group_id']);

	              	if(data['group_details']['group_image'] != null && data['group_details']['group_image'] != ''){
	              		$('#group_image').attr('src', '<?php echo base_url('groupImages/');?>'+data['group_details']['group_image']);
	              	}else{
	              		$('#group_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}

	              	if( data['group_details']['subcategory_title2'] != '' && data['group_details']['subcategory_title2'] != null){
	              		$("#group2").append("<div class='col-md-3'>Sub Category2:</div><div class='col-md-3'>"+ data['group_details']['subcategory_title2'] +"</div>").show();
	              	}
	              	if(data['group_details']['subcategory_title3'] != '' && data['group_details']['subcategory_title3'] != null){
	              		$("#group2").append("<div class='col-md-3'>Sub Category3:</div><div class='col-md-3'>"+ data['group_details']['subcategory_title3'] +"</div>").show();
	              	}
	              	if(data['group_details']['subcategory_title4'] != '' && data['group_details']['subcategory_title4'] != null){
	              		$("#group3").append("<div class='col-md-3'>Sub Category4:</div><div class='col-md-3'>"+ data['group_details']['subcategory_title4'] +"</div>").show();
	              	}
	              	if(data['group_details']['subcategory_title5'] != '' && data['group_details']['subcategory_title5'] != null){
	              		$("#group3").append("<div class='col-md-3'>Sub Category5:</div><div class='col-md-3'>"+ data['group_details']['subcategory_title5'] +"</div>").show();
	              	}
            }
    		});
    	});


    	//******** approve group Request ******/

    	$('#groupTable tbody tr .approve_group').click(function(){
    		var group_id = $(this).attr('id');
    		var user_id = $(this).attr('user');

    		$.ajax({
    			type: 'post',
    			dataType:'json',
    			data:{'user_id':user_id},
	            url: '<?php echo base_url('admin/approve_group_request/') ?>'+group_id,
	            success: function (data) {
	            	if(data.status == true){
	            		toastr.success(data.message);
	            		setTimeout(function(){
						     window.location.href = "<?php echo base_url('admin/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});

    $(document).on('click', '#groupEditImageSaveBtn', function (event) {
    	var group_id=$(this).siblings('.group_edit_image_btn').attr('data-group-id');
    	console.log(group_id);

     var fd = new FormData();
        var files = $('.group_edit_image_btn')[0].files[0];
        console.log(files);
        fd.append('file',files);
        console.log(fd);

	  $.ajax({
    			type: 'post',
    			dataType:'json',
    			processData: false,
				contentType: false,
    			data: fd,
	            url: '<?php echo base_url('admin/edit_group_image/') ?>'+group_id,
	            success: function (data) {
	            	console.log(data.message);
	            	if(data.status == true){
	            		toastr.success(data.message);
	       //      		
	            	}else{
	            		var str = "";
						(data.message).forEach(function(error){
						    str += '<li>' + error + '</li>' // build the list
						});
						console.log(str);
	            		toastr.warning('Check your image <ul>'+str+'</ul>').addClass('alert alert-warning');
	            	}
	            },
	            error: function()
	            {
	            	toastr.warning('Some error occur while approved the image edit request').addClass('alert alert-warning');
	            }
    		})
	});

 $('.select2-single').select2({

});

	$('#groupTable tbody tr .edit_group_view').click(function(){
	var startDate ;
    		var group_id  = $(this).attr('id');
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_group_details_id/') ?>'+group_id,
	            success: function (data) 
	            {
	            console.log(data);
                    $('#editgroupModal').modal('show');
                    
                    $('#__group_id').val(data.group_details.group_id);
 
                    $('#__edit_group_image').val(data.group_details.group_image);
                    
                    $("#edit_group_image").attr("src", '<?php echo base_url('./groupImages/')?>'+data.group_details.group_image);
 
                    $('#edit_group_name').val(data.group_details.group_name);
                    
                    $('#edit_group_created_by').val(data.group_details.user_id).trigger('change');
 
             
                    
                    $('#edit_member_count').val(data.group_details.members_count);
 
                    $('.edit_group_start_date').val(data.group_details.start_date);
 
                    $('.edit_group_start_date').datepicker('setDate', new Date(data.group_details.start_date));
     
 
                    $('.edit_group_end_date').val(data.group_details.end_date);
 
                    $('.edit_group_end_date').datepicker('setDate', new Date(data.group_details.end_date));
                 
                    $('#edit_ad_desc').val(data.group_details.description);
 
                     
	              
	            	
          		}
    		});
    	});

    	/********* rejected Group Request ******/
    	// $('#groupTable tbody tr .reject_group').click(function(){
    	// 	var adv_id = $(this).attr('id');
    	// 	var user_id = $(this).attr('user');

    	// 	$.ajax({
    	// 		type: 'post',
    	// 		dataType:'json',
    	// 		data:{'user_id':user_id},
	    //         url: '<?php echo base_url('admin/reject_group_request/') ?>'+adv_id,
	    //         success: function (data) {
	    //         	if(data.status == true){
	    //         		toastr.success(data.message);
	    //         		setTimeout(function(){
					// 	     window.location.href = "<?php echo base_url('admin/home'); ?>";
					// 	  },1000);
	    //         	}else{
	    //         		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	    //         	}
	    //         }
    	// 	})
    	// });

</script>