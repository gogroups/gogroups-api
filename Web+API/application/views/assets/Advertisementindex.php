<script src="<?php echo base_url('public/js/moment-2.2.1.js') ?>"></script>
<script type="text/javascript">


$(document).ready(function() {
    // Setup - add a text input to each footer cell
  
    // DataTable
    var table = $('#adsTable').DataTable();
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
			      	var startDate_record = new Date(data[4]);
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
			      	var startDate_record = new Date(data[5]);
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

var table = $('#adsTable').DataTable();
table
 .search( '' )
 .columns().search( '' )
 .draw();
});


});









$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
    	 

        if (input.files) {
            var filesAmount = input.files.length;
           
           // var count=filesAmount;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).width(100)
                    .height(100).appendTo(placeToInsertImagePreview);
                  
                }

                reader.readAsDataURL(input.files[i]);

            }
        }

    };

    $('#add_ads_image_btn').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});


// $.validator.setDefaults({
// 		submitHandler: function() {
// 			$.ajax({
// 				type: 'post',
// 	            url: '<?php echo base_url('advertisement/insert') ?>',
// 	            dataType: 'json',
// 	            data: $('#addAds').serialize(),
// 	            success: function (data) {
	            	
// 	            	if(data.result == true){
// 		              	toastr.success(data.message);
// 		             		 setTimeout(function(){
// 							     window.location.href = "<?php echo base_url('advertisement/home'); ?>";
// 							  },1000);
// 	            	}else{
// 	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
// 	            	}
//             }
//         });
// 		}
// 	});

$("#addAds").validate({
	errorElement:'span_error',
			rules: {
				ads_name: {
						required: true
				},
				ads_image: {
						required: true
				},
				users: {
						required: true
				},
				categories: {
						required: true
				},
				actual_price: {
						required: true
				},
				offer_price: {
						required: true
				},
				start_date: {
						required: true
				},
				end_date: {
						required: true
				},


				// users: {
				// 		required: true
				// },

				agree: "required"
			}
			
		});

$("#reset").click(function() { 
	window.location.href = "<?php echo base_url('advertisement/home'); ?>";
});

	    	//******** approve Advertisement Request ******/

    	$('#adsTable tbody tr .approve_advertise').click(function(){
    		var adv_id = $(this).attr('id');
    		var seller_id = $(this).attr('seller_id');

console.log(adv_id);
    		$.ajax({
    			type: 'post',
    			dataType:'json',
    			data: {'seller_id': seller_id},
	            url: '<?php echo base_url('advertisement/approve_advise_request/') ?>'+adv_id,
	            success: function (data) {
	            	if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('advertisement/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the advertisements request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});

$('.reasonReject').click(function(){
	var ads_id = $(this).attr('id');
	var seller_id = $(this).attr('seller_id');
	
	$('#rejectPop').modal('show');
	$('#advertisement_id').val(ads_id);
	$('#seller_id').val(seller_id);
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
	            url: '<?php echo base_url('advertisement/reject_reason') ?>',
	            dataType: 'json',
	            data: $('#RejectAds').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('advertisement/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});


    	//$( ".select2-single" ).select2();
    	$(document).ready(function() {
              var startDate ;
    		$("th").filter(".input_filter");

    		 $('[data-toggle="datepicker"],#start_date_filter,#end_date_filter').datepicker({
    		 	 dateFormat: 'yyyy-mm-dd' ,
    		 	 startDate: new Date(),
		        autoHide: true,
		        zIndex: 2048,
		      })
    		  .on('change', function (selected) {
    		 	// debugger;
     		 	  startDate = $('[data-toggle="datepicker"]').val();
     		 	  $('.end_date').val('');
     		 	   $('[data-toggle="datepicker1"]').datepicker('setStartDate', startDate);
    		   // startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
    		  // console.log(startDate);

    		  
              
    })
    		 $('[data-toggle="datepicker1"]').datepicker({
    		 	 dateFormat: 'yyyy-mm-dd' ,
    		 	   startDate: new Date(),  
    		 	 // endDate: FromEndDate,
		        autoHide: true,
		        zIndex: 2048,
		      })

    		 $('[data-toggle="datepicker2"],#start_date_filter,#end_date_filter').datepicker({
    		 	 dateFormat: 'yyyy-mm-dd' ,
    		 	 startDate: new Date(), 
    		 	 // endDate: FromEndDate,
		        autoHide: true,
		        zIndex: 2048,
		        
                          
		      })
    		 .on('change', function (selected) {
    		 	// debugger;
     		 	  startDate = $('[data-toggle="datepicker2"]').val();
     		 	  $('#edit_end_date').val('');
     		 	   $('[data-toggle="datepicker3"]').datepicker('setStartDate', startDate);
    		   // startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
    		  // console.log(startDate);

    		  
              
    })
    		 $('[data-toggle="datepicker3"]').datepicker({
    		 	 dateFormat: 'yyyy-mm-dd' ,
    		 	  startDate: startDate, 
    		 	 // endDate: FromEndDate,
    		 	 defaultDate: startDate,
		        autoHide: true,
		        zIndex: 2048,
		      })

		    $('.select2-categories, .select2-single, .subcategories_lvl_1,.subcategories_lvl_2,.subcategories_lvl_3,.subcategories_lvl_4,.subcategories_lvl_5').select2({
		});

		     $('.select2-categories').on("change",function () {
			        var categoryId = $(this).find('option:selected').val();
			        $('.__appendOption').html("");
			        var dom1 = "<option value=''>Select..</option>";
			        $('.__appendOption').append(dom1);
			        $.ajax({
			            url: "<?php echo base_url('advertisement/sub_categories');?>",
			            type: "POST",
			            data: "categoryId="+categoryId,
			            dataType:'json',
			            success: function (response) {

			                $.each(response, function(key,val) {
			                	
			                	var dom = "<option id='values' value='"+val.subcategory_id+"'>"+ val.subcategory_title +"</option>"
	              	
			              $('.__appendOption').append(dom);

			        });
			                
			            },
			        });
			    }); 

		     $('.subcategories_lvl_1').on("change",function () {
			        var categoryId = $(this).find('option:selected').val();
			        $('.__appendOption2').html("");
			        var dom1 = "<option value=''>Select..</option>";
			        $('.__appendOption2').append(dom1);
			        $.ajax({
			            url: "<?php echo base_url('advertisement/sub_categories2');?>",
			            type: "POST",
			            data: "categoryId="+categoryId,
			            dataType:'json',
			            success: function (response) {

			                $.each(response, function(key,val) {
			                	var dom = "<option id='values' value='"+val.subcategory2_id+"'>"+ val.subcategory_title2 +"</option>"
	              	
			              		$('.__appendOption2').append(dom);   

			        });
			                
			            },
			        });
			    });

		     $('.subcategories_lvl_2').on("change",function () {
			        var categoryId = $(this).find('option:selected').val();
			        $('.__appendOption3').html("");
			        var dom1 = "<option value=''>Select..</option>";
			        $('.__appendOption3').append(dom1);
			        $.ajax({
			            url: "<?php echo base_url('advertisement/sub_categories3');?>",
			            type: "POST",
			            data: "categoryId="+categoryId,
			            dataType:'json',
			            success: function (response) {
			                $.each(response, function(key,val) {
			                	var dom = "<option id='values' value='"+val.subcategory3_id+"'>"+ val.subcategory_title3 +"</option>"
	              	
			              		$('.__appendOption3').append(dom);   

			        });
			                
			            },
			        });
			    });

		       $('.subcategories_lvl_3').on("change",function () {
			        var categoryId = $(this).find('option:selected').val();
			        $('.__appendOption4').html("");
			        var dom1 = "<option value=''>Select..</option>";
			        $('.__appendOption4').append(dom1);
			        $.ajax({
			            url: "<?php echo base_url('advertisement/sub_categories4');?>",
			            type: "POST",
			            data: "categoryId="+categoryId,
			            dataType:'json',
			            success: function (response) {
			                $.each(response, function(key,val) {
			                	var dom = "<option id='values' value='"+val.subcategory4_id+"'>"+ val.subcategory_title4 +"</option>"
	              	
			              		$('.__appendOption4').append(dom);   

			        });
			                
			            },
			        });
			    });

		         $('.subcategories_lvl_4').on("change",function () {
			        var categoryId = $(this).find('option:selected').val();
			        $('.__appendOption5').html("");
			        var dom1 = "<option value=''>Select..</option>";
			        $('.__appendOption5').append(dom1);
			        $.ajax({
			            url: "<?php echo base_url('advertisement/sub_categories5');?>",
			            type: "POST",
			            data: "categoryId="+categoryId,
			            dataType:'json',
			            success: function (response) {
			                $.each(response, function(key,val) {
			                	var dom = "<option id='values' value='"+val.subcategory5_id+"'>"+ val.subcategory_title5 +"</option>"
	              	
			              		$('.__appendOption5').append(dom);   

			        });
			                
			            },
			        });
			    });

			});

    	/********* rejected Advertisement Request ******/
    	$('#adsTable tbody tr .reject_advertise').click(function(){
    		var adv_id = $(this).attr('id');

    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('advertisement/reject_adv_request/') ?>'+adv_id,
	            success: function (data) {
	            	if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('advertisement/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the advertisement request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});

    	/******** get advertisements details ********/

	$('#adsTable tbody tr .ads_details').click(function(){
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
	            	$('#advertisement_name').html(data['ads_details'][0]['advertisement_name']);
	            	$('#created_by').html(data['ads_details'][0]['name']);
	              	$('#category').html(data['ads_details'][0]['category_title']);
	              	$('#sub_category').html(data['ads_details'][0]['subcategory_title']);
	              	$('#total_views_adv').html(data['total_views']);
	              	$('#actual_price').html('INR '+data['ads_details'][0]['actual_price']);
	              	$('#offer_price').html('INR '+data['ads_details'][0]['offer_price']);
	              	$('#offerfortwo').html(data['ads_details'][0]['offerfortwo']);
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


	$('#adsTable tbody tr .edit_ads_view').click(function(){
		var adv_id = $(this).attr('id');
		$('#report_div').html("");
		$('#reports').html("");
		$('#append_images').html("");
		$.ajax({
			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('advertisement/get_advertisement_details_id/') ?>'+adv_id,
	            success: function (data) {
	            	
                    console.log(data);
 
                    $('#__ads_id').val(data.ads_details[0].advertisement_id);

                     $('#edit_ad_name').val(data.ads_details[0].advertisement_name);
                    
                    $('#edit_ads_created_by').select2('val', data.ads_details[0].createdby_userid, true);

                    $('#edit_actual_price').val(data.ads_details[0].actual_price);
 
                    $('#edit_offer_price').val(data.ads_details[0].offer_price);//tried as a trou

                    
                    $('#edit_start_date').val(data.ads_details[0].start_date);
 
                    $('#edit_start_date').datepicker('setDate', new Date(data.ads_details[0].start_date) );//tried as a trouble shooting step...no value
                
                    $('#edit_end_date').val(data.ads_details[0].end_date);
 
                    $('#edit_end_date').datepicker('setDate', new Date(data.ads_details[0].end_date) );
 
                    $('#edit_ad_detail').val(data.ads_details[0].advertisement_details);
                    

	            	
	            	$('#editadsModal').modal('show');
	            	//console.log(data[0]);    

	            }
		});
	});

	/******* seller details in Ads *******/

    	$('#adsTable tbody tr .seller_profile').click(function(){
    		//console.log("sgsg");
    		var user_id  = $(this).attr('id');
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_pending_sellers_details/') ?>'+user_id,
	            success: function (data) {
	            	console.log(data);
	            	$('#seller_image_display').attr("src", '<?php echo base_url('./userImages/')?>'+data['profile_image']);
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
            }
    		});
    	});


</script>