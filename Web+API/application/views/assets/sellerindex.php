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

	$('#profile_view').click(function(){
		var user_id  = $('#profile_view').attr('href');
		console.log(user_id);
	});

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.__seller_profile_pic')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

  
      


	// just for the demos, avoids form submit

// $(document).ready(function (e) {
//     $('#AddSeller').on('submit',(function(e) {
//         e.preventDefault();
//         var formData = new FormData(this);

//         $.ajax({
//             type:'POST',
//             url: $(this).attr('action'),
//             data:formData,
//             cache:false,
//             contentType: false,
//             processData: false,
//             success:function(data){
//                 console.log("success");
//                 console.log(data);
//             },
//             error: function(data){
//                 console.log("error");
//                 console.log(data);
//             }
//         });
//     }));

//     $("#ImageBrowse").on("change", function() {
//         $("#imageUploadForm").submit();
//     });
// });





 // $.validator.setDefaults({
 // 		submitHandler: function(data) {
 // 			alert(data);
 // 		// 	var file_name=$("#add_seller_image_btn").files[0];
 		// 	console.log(file_name);

			
			// $.ajax({
			// 	type: 'post',
	  //           url: '<?php echo base_url('sellerController/insert') ?>',
	  //           dataType: 'json',
	  //           data: $('#AddSeller').serialize() + "&seller_image=" +file_name,
	  //           success: function (data) {
	            	
	  //           	if(data.result == true){
		 //              	toastr.success(data.message);
		 //            		 setTimeout(function(){
			// 				     //window.location.href = "<?php echo base_url('sellerController/home'); ?>";
			// 				  },1000);
	  //           	}else{
	  //           		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	  //           	}
   //          }
   //      });
	 // 	}
	 // });



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
							     window.location.href = "<?php echo base_url('sellerController/home'); ?>";
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



$("#AddSeller").validate({
	errorElement:'span_error',
	
			rules: {
				seller_image: {
						required: true
				},
				country_code: {
						required: true
				},

				full_name: {
						required: true
				},
				company_name: {
					required: true,
				},
				contact:{
					required: true,
					number: true,
					maxlength: 10
				},
				secondary_contact: {
					number : true,
					maxlength: 12,
				},
				secondary_email: {
					email: true
				},
				email: {
					required: true,
					email: true
				},
				location:{
					required: true
				},

				paytm_no:{
					required: true
				},
				ifsc:{
					required: true
				},
				address:{
					required: true
				},
				account_number:{
					required: true
				},
				ac_holder_name:{
					required: true
				},
				bank_name:{
					required: true
				},


				secondary_gst: {
					required: true
				},
				seller_usp:{
					required: true
				},
				agree: "required"
			}
			
		});




$("#UpdateSeller").validate({
	errorElement:'span_error',
	
			rules: {
				

				full_name: {
						required: true
				},
				company_name: {
					required: true,
				},
				contact:{
					required: true,
					number: true,
					maxlength: 10
				},
				secondary_contact: {
					number : true,
					maxlength: 12,
				},
				secondary_email: {
					email: true
				},
				email: {
					required: true,
					email: true
				},
				location:{
					required: true
				},

				paytm_no:{
					required: true
				},
				ifsc:{
					required: true
				},
				address:{
					required: true
				},
				account_number:{
					required: true
				},
				ac_holder_name:{
					required: true
				},
				bank_name:{
					required: true
				},

				secondary_gst: {
					required: true
				},
				seller_usp:{
					required: true
				},
				agree: "required"
			}
			
		});



/********** get Details of seller *******/

	
    //console.log($(this).attr('id'));

    	$('#sellerTable tbody tr .profile_view').click(function(){
    		var user_id  = $(this).attr('id');

    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('sellerController/getSellerDetails/') ?>'+user_id,
	            success: function (data) {
	            	$("#seller_image").attr("src", '<?php echo base_url('/userImages/')?>'+data['profile_image']);
	              	$('#full_name').html(data['name']);
	              	$('#company_name').html(data['seller_companyName']);
	              	$('#contact').html(data['contact_number']);
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
    	})


	$('#sellerTable tbody tr .edit_view').click(function(){
		
    		var user_id  = $(this).attr('id');
    		

    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('sellerController/getSellerDetails/') ?>'+user_id,
	            success: function (data) {
	            	$('#__seller_id').val(data['user_id']);
	            	$('#__edit_seller_image').val(data['profile_image']);

	            	$('#edit_seller_full_name').val(data['name']);
	            	$('#edit_seller_company_name').val(data['seller_companyName']);
	            	$('#edit_seller_contact').val(data['contact_number']);
	            	$('#edit_seller_zip_code').val(data['zipcode']);
	            	$('#edit_seller_email').val(data['email']);
	            	$('#edit_seller_secondary_name').val(data['seller_secondary_name']);
	            	$('#edit_seller_location').val(data['location']);

	            	$('#edit_seller_address').val(data['address']);
	            	$('#edit_seller_account_number').val(data['account_number']);
	            	$('#edit_seller_ac_holder_name').val(data['ac_holder_name']);
	            	$('#edit_seller_bank_name').val(data['bank_name']);
	            	$('#edit_seller_ifsc').val(data['ifsc']);
	            	$('#edit_seller_paytm_no').val(data['paytm_no']);

	            	$('#edit_seller_secondary_contact').val(data['seller_secondary_contact']);
	            	$('#edit_seller_gst_pan').val(data['seller_tinNo']);
	            	$('#edit_seller_secondary_email').val(data['seller_secondary_email']);
	            	$('#edit_seller_usp').val(data['seller_usp']);
	            	
	            	 	if(data['profile_image'] != null && data['profile_image'] != ''){
	              		$('.edit_seller_image').attr('src','<?php echo base_url('userImages/');?>'+data['profile_image']);
	              	}else{
	              		$('.edit_seller_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}

	            	$('#sellerEditModal').modal('show');
            	}
    		});
    	})

    //******** approve Seller Request ******/

    	$('#sellerTable tbody tr .approve_user').click(function(){
    		var user_id = $(this).attr('id');

    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/approve_seller_request/') ?>'+user_id,
	            success: function (data) {
	            	if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('sellerController/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the user request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});


    	    	//******** approve Seller Request ******/

    	$('#sellerTable tbody tr .reject_user').click(function(){
    		var user_id = $(this).attr('id');

    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/reject_seller_request/') ?>'+user_id,
	            success: function (data) {
	            		if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('sellerController/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the user request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});


</script>