<script type="text/javascript">

		$(document).ready(function() {

    // DataTable
    var table = $('#sellerTable').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });
});

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.__user_image')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


$('.reasonReject').click(function(){
	var user_id = $(this).attr('id');
	
	$('#rejectPop').modal('show');
	$('#user_id').val(user_id);
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
	            url: '<?php echo base_url('userController/reject_reason') ?>',
	            dataType: 'json',
	            data: $('#RejectUser').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('userController/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

		// just for the demos, avoids form submit
// $.validator.setDefaults({
// 		submitHandler: function() {
// 			$.ajax({
// 				type: 'post',
// 	            url: '<?php echo base_url('userController/insert') ?>',
// 	            dataType:'json',
// 	            data: $('#AddUser').serialize(),
// 	            success: function (data) {
// 	            	console.log(data);
// 	              	if(data.result == true){
// 		              	toastr.success(data.message);
// 		            		 setTimeout(function(){
// 							     window.location.href = "<?php echo base_url('userController/home'); ?>";
// 							  },1000);
// 	            	}else{
// 	            		toastr.warning('Some error occur while approved the user request').addClass('alert alert-warning');
// 	            	}
//             }
//         });
// 		}
// 	});

$("#AddUser").validate({
	errorElement:'span_error',
			rules: {
				user_image: {
						required: true
				},
				country_code: {
						required: true
				},
				full_name: {
						required: true
				},
				age: {
					required: true,
					number: true,
				},
				contact:{
					required: true,
					number: true,
					maxlength: 10
				},
				location:{
					required: true,
				},
				email: {
					required: true,
					email: true
				},
				zipcode:{
					required: true,
					number: true
				},
				paytm_no:{
					required: true,
					number: true
				},
				agree: "required"
			}
			
		});


$("#EditUser").validate({
	errorElement:'span_error',
			rules: {
				full_name: {
						required: true
				},
				age: {
					required: true,
					number: true,
				},
				contact:{
					required: true,
					number: true,
					maxlength: 10
				},
				location:{
					required: true,
				},
				email: {
					required: true,
					email: true
				},
				zipcode:{
					required: true,
					number: true
				},
				paytm_no:{
					required: true,
					number: true
				},
				agree: "required"
			}
			
		});


	
	/********** get Details of user *******/

    	$('#sellerTable tbody tr .user_profile').click(function(){
    		var user_id  = $(this).attr('id');
    		$('#reports').html("");
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('userController/getUserDetails/') ?>'+user_id,
	            success: function (data) {
	            	console.log(data['user_details']);
	            	$("#seller_image").attr("src", '<?php echo base_url('./userImages/')?>'+data['profile_image']);
	              	$('#full_name').html(data['user_details']['name']);
	              	$('#paytm_no').html(data['user_details']['paytm_no']);
	              	$('#age').html(data['user_details']['age']);
	              	$('#contact').html(data['user_details']['contact_number']);
	              	$('#zipcode').html(data['user_details']['zipcode']);
	              	$('#location').html(data['user_details']['location']);
	              	$('#email').html(data['user_details']['email']);

	              	if(data['user_details']['profile_image'] != null && data['user_details']['profile_image'] != ''){
	              		$('#user_image').attr('src','<?php echo base_url('userImages/');?>'+data['user_details']['profile_image']);
	              	}else{
	              		$('#user_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}

	              	$.each(data['other_details'], function(key,val) {
	              		
	              		$.each(val ,function(key,val){
	              		if(val.comments != '' && val.comments != null){
		              		$('#report_div').show();
		              		$('#reports').append('<li id="report_id">'+ val.comments +'<span class="badge badge-primary"><a href="#" style="color:white;">' + val.name +' '+ val.lastName +' - '+ val.contact_number+ ' </a></span></li>');
	              		}
	              	});
			        });

            }
    		});
    	});


	$('#sellerTable tbody tr .edit_user_view').click(function(){
		
    		var user_id  = $(this).attr('id');
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('userController/getUserDetails/') ?>'+user_id,
	            success: function (data) {

	            	$('#__user_id').val(data['user_details']['user_id']);
	            	$('#__edit_user_image').val(data['user_details']['profile_image']);

	            	$('#edit_user_full_name').val(data['user_details']['name']);
	            	$('#edit_user_age').val(data['user_details']['age']);
	            	$('#edit_user_contact').val(data['user_details']['contact_number']);
	            	$('#edit_user_location').val(data['user_details']['location']);
	            	$('#edit_user_email').val(data['user_details']['email']);
					$('#edit_user_zip_code').val(data['user_details']['zipcode']);
					$('#edit_user_paytm_no').val(data['user_details']['paytm_no']);


	              	if(data['user_details']['profile_image'] != null && data['user_details']['profile_image'] != ''){
	              		$('#edit_user_image').attr('src','<?php echo base_url('userImages/');?>'+data['user_details']['profile_image']);
	              	}else{
	              		$('#edit_user_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}

	            	$('#userEditModal').modal('show');
	            

            }
    		});
    	});

    //******** approve User Request ******/

    	$('#sellerTable tbody tr .approve_user').click(function(){
    		var user_id = $(this).attr('id');

    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('userController/approve_user_request/') ?>'+user_id,
	            success: function (data) {
	            	if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('userController/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the user request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});


    	    	//******** approve user Request ******/

    	$('#sellerTable tbody tr .reject_user').click(function(){
    		var user_id = $(this).attr('id');

    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('userController/reject_user_request/') ?>'+user_id,
	            success: function (data) {
	            		if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('userController/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the user request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});
</script>