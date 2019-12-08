<script type="text/javascript">

	$('#couponCodeTable tbody tr .profile_view').click(function(){
		
    		var user_id  = $(this).attr('id');
    		
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('sellerController/getSellerDetails/') ?>'+user_id,
	            success: function (data) {
	            	$("#sellerModal #seller_image").attr("src", '<?php echo base_url('/userImages/')?>'+data['profile_image']);
	              	$('#sellerModal #full_name').html(data['name']);
	              	$('#sellerModal #company_name').html(data['seller_companyName']);
	              	$('#sellerModal #contact').html(data['contact_number']);
	              	$('#sellerModal #zipCode').html(data['zipcode']);
	              	$('#sellerModal #email').html(data['email']);
	              	$('#sellerModal #secondary_name').html(data['seller_secondary_name']);
	              	$('#sellerModal #location').html(data['location']);

	              	$('#address').html(data['address']);
	              	$('#account_number').html(data['account_number']);
	              	$('#ac_holder_name').html(data['ac_holder_name']);
	              	$('#bank_name').html(data['bank_name']);
	              	$('#ifsc').html(data['ifsc']);
	              	$('#paytm_no').html(data['paytm_no']);

	              	$('#sellerModal #secondary_contact').html(data['seller_secondary_contact']);
	              	$('#sellerModal #seller_gst').html(data['seller_tinNo']);
	              	$('#sellerModal #secondary_email').html(data['seller_secondary_email']);
	              	$('#sellerModal #seller_usp').html(data['seller_usp']);

	              	if(data['profile_image'] != null && data['profile_image'] != ''){
	              		$('#sellerModal #seller_image').attr('src','<?php echo base_url('userImages/');?>'+data['profile_image']);
	              	}else{
	              		$('#sellerModal #seller_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}
            }
    		});
    	})


$('#couponCodeTable tbody tr .user_profile').click(function(){
    		var user_id  = $(this).attr('id');
    		$('#reports').html("");
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('userController/getUserDetails/') ?>'+user_id,
	            success: function (data) {
	            	console.log(data['user_details']);
	            	$("#userModal #seller_image").attr("src", '<?php echo base_url('./userImages/')?>'+data['profile_image']);
	              	$('#userModal #full_name').html(data['user_details']['name']);
	              	$('#userModal #userModal #age').html(data['user_details']['age']);
	              	$('#userModal #contact').html(data['user_details']['contact_number']);
	              	$('#userModal #zipcode').html(data['user_details']['zipcode']);
	              	$('#userModal #location').html(data['user_details']['location']);
	              	$('#userModal #email').html(data['user_details']['email']);
	              	$('#userModal #paytm_no').html(data['user_details']['paytm_no']);

	              	if(data['user_details']['profile_image'] != null && data['user_details']['profile_image'] != ''){
	              		$('#userModal #user_image').attr('src','<?php echo base_url('userImages/');?>'+data['user_details']['profile_image']);
	              	}else{
	              		$('#user_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}

	              	$.each(data['other_details'], function(key,val) {
	              		
	              		$.each(val ,function(key,val){
	              		if(val.comments != '' && val.comments != null){
		              		$('#userModal #report_div').show();
		              		$('#userModal #reports').append('<li id="report_id">'+ val.comments +'<span class="badge badge-primary"><a href="#" style="color:white;">' + val.name +' '+ val.lastName +' - '+ val.contact_number+ ' </a></span></li>');
	              		}
	              	});
			        });

            }
    		});
    	});



$('#couponCodeTable tbody tr .ads_details').click(function(){
		$('#ads_reports').html("");
		//alert('a');
		var adv_id = $(this).attr('id');
		$('#reports').html("");
		$('#append_images').html("");
		$.ajax({
			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('advertisement/get_advertisement_details_id/') ?>'+adv_id,
	            success: function (data) {
	            	//console.log(data[0]);
	            	$('#ad_name').html(data['ads_details'][0]['advertisement_name']);
	            	$('#created_by').html(data['ads_details'][0]['name']);
	              	$('#category').html(data['ads_details'][0]['category_title']);
	              	$('#sub_category').html(data['ads_details'][0]['subcategory_title']);
	              	$('#total_views_adv').html(data['total_views']);
	              	$('#actual_price').html('INR '+data['ads_details'][0]['actual_price']);
	              	$('#offer_price').html('INR '+data['ads_details'][0]['offer_price']);
	              	$('#cashback_per_user').html(data['ads_details'][0]['cashback_per_user']);
	              	$('#start_date').html(data['ads_details'][0]['start_date']);
	              	$('#end_date').html(data['ads_details'][0]['end_date']);
	              	$('#ad_detail').html(data['ads_details'][0]['advertisement_details']);
	              	$('#last_editied').html(data['ads_details'][0]['HistoryOfChange']);
	              	// $("#images").attr("src", '<?php echo base_url('./advertisementImages/')?>'+data[0]['image_path']);

	              	if( data['ads_details'][0]['subcategory_title2'] != '' && data['ads_details'][0]['subcategory_title2'] != null){
	              		$("#group2").append("<div class='col-md-3'>Sub Category2:</div><div class='col-md-3'>"+ data['ads_details'][0]['subcategory_title2'] +"</div>").show();
	              	}
	              	if(data['ads_details'][0]['subcategory_title3'] != '' && data['ads_details'][0]['subcategory_title3'] != null){
	              		$("#group2").append("<div class='col-md-3'>Sub Category3:</div><div class='col-md-3'>"+ data['ads_details'][0]['subcategory_title3'] +"</div>").show();
	              	}
	              	if(data['ads_details'][0]['subcategory_title4'] != '' && data['ads_details'][0]['subcategory_title4'] != null){
	              		$("#group3").append("<div class='col-md-3'>Sub Category4:</div><div class='col-md-3'>"+ data['ads_details'][0]['subcategory_title4'] +"</div>").show();
	              	}
	              	if(data['ads_details'][0]['subcategory_title5'] != '' && data['ads_details'][0]['subcategory_title5'] != null){
	              		$("#group3").append("<div class='col-md-3'>Sub Category5:</div><div class='col-md-3'>"+ data['ads_details'][0]['subcategory_title5'] +"</div>").show();
	              	}


	              	 	$.each(data['other_details'], function(key,val) {

	              		$.each(val ,function(key,val){
	              			
	              		if(val.comments != '' && val.comments != null){
	              			//alert(val.comments);
		              		$('#ads_report_div').show();
		              		//$('#report_div').append('<span>Pawan</span>');
		              		$('#ads_reports').append('<li id="report_id">'+ val.comments +'<span class="badge badge-primary"><a href="#" style="color:white;">' + val.name +' '+ val.lastName +' - '+ val.contact_number+ ' - '+val.email + '</a></span></li>');
	              		}
	              	});
			        });
	              	 

	              	$.each(data['ads_details'], function(key,val) {
	              		

	              		var dom = "<img class='col-md-3' src='<?php echo base_url('advertisementImages/');?>"+val.image_path+"' id='adv_images'/>";

			            $('#append_images').append(dom);
			        });

	            }
		});
	});


$(document).ready(function() {
    // Setup - add a text input to each footer cell
  
    // DataTable
    var table = $('#couponCodeTable').DataTable();
    $("#start_date_starts").datepicker({dateFormat: 'mm-dd-yyyy'});
    $("#start_date_ends").datepicker({dateFormat: 'mm-dd-yyyy'});
 	$("#end_date_starts").datepicker({dateFormat: 'mm-dd-yyyy'});
    $("#end_date_ends").datepicker({dateFormat: 'mm-dd-yyyy'});
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        });
    });


 $('#start_date_ends').change(function () {
                 $.fn.dataTable.ext.search.push(
         
			          function (settings, data, dataIndex) {
			        var min = $('#start_date_starts').val();        
			        var max = $('#start_date_ends').val();     

			      if(min != "" && max != ""){
			      	var startDate_record = new Date(data[9]);
			        var month = ((startDate_record.getMonth() + 1) < 10) ? '0' + (startDate_record.getMonth() + 1) : (startDate_record.getMonth() + 1);
			        var startDate=month + '/' + startDate_record.getDate() + '/' +  startDate_record.getFullYear();
			        if (min == '' && max == '') { return true; }
			        if (min == '' && startDate <= max) { return true;}
			        if(max == '' && startDate >= min) {return true;}
			        if (startDate <= max && startDate >= min) { return true; }

			      }


     			 return false;

    					}
    				);
            
            	table.draw();
       });




                $('#end_date_ends').change(function () {
                 $.fn.dataTable.ext.search.push(
         
			          function (settings, data, dataIndex) {
			        var min = $('#end_date_starts').val();        
			        var max = $('#end_date_ends').val();     

			      if(min != "" && max != ""){
			      	var startDate_record = new Date(data[10]);
			        var month = ((startDate_record.getMonth() + 1) < 10) ? '0' + (startDate_record.getMonth() + 1) : (startDate_record.getMonth() + 1);
			        var startDate=month + '/' + startDate_record.getDate() + '/' +  startDate_record.getFullYear();
			        if (min == '' && max == '') { return true; }
			        if (min == '' && startDate <= max) { return true;}
			        if(max == '' && startDate >= min) {return true;}
			        if (startDate <= max && startDate >= min) { return true; }

			      }


     			 return false;

    					}
    				);
            
            	table.draw();
       });


   $('#clear').click(function(){

$('input[type=text]').val('');

$.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(function (settings, data, dataIndex){}, 1));

var table = $('#couponCodeTable').DataTable();
table
 .search( '' )
 .columns().search( '' )
 .draw();
});


});




$('body').on('click', '#coupons_remarks .remarks', function(e) {
	
	$(".modal-body #recordId").attr('data-coupon-id',$(this).parent().attr('data-coupon-id') );
    $(".modal-body #recordId").val($(this).parent().attr('data-remarks'));
    $('#remarks_modal').modal('show');
	
});

$('body').on('click', '#btn-remarks-submit', function(e) {

	

	var coupon_id=$('#recordId').attr('data-coupon-id');
	var remarks = $('#recordId').val();
	$('#remarks_modal').modal('hide');
	  $.ajax({
            url:'<?php echo base_url('couponCode/update_remarks/') ?>'+coupon_id,
            data:{remarks:$('#recordId').val()},
            type: 'POST',
            dataType: 'JSON',
            error:function(err){

               toastr.warning('Some error occur while updating the remarks').addClass('alert alert-warning');
                },

              success: function (data) {
	            	if(data.status == true){
	            		toastr.success('Remarks Updated successfully').addClass('alert alert-success');

        				if(data.redirect)
        				{
        					window.location = data.redirect;
        				}
	            		
	            	}else{
	            		toastr.warning('Some error occur while updating the remarks').addClass('alert alert-warning');
	            	}
	            }
    });   

	 
	});

</script>