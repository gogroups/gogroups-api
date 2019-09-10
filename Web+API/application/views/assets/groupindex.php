<script type="text/javascript">

	
$(document).ready(function() {

    // DataTable
    var table = $('#groupTable').DataTable();

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




                $('#end_date_ends').change(function () {
                 $.fn.dataTable.ext.search.push(
         
			          function (settings, data, dataIndex) {
			        var min = $('#end_date_starts').val();        
			        var max = $('#end_date_ends').val();     

			      if(min != "" && max != ""){
			      	var startDate_record = new Date(data[6]);
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

var table = $('#groupTable').DataTable();
table
 .search( '' )
 .columns().search( '' )
 .draw();
});

});






	
		/******* seller details in Ads *******/
		function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.__group_profile_pic')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    	$('#groupTable tbody tr .user_profile').click(function(){
    		//console.log("sgsg");
    		var user_id  = $(this).attr('id');
    		console.log(user_id);
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_user_deatils/') ?>'+user_id,
	            success: function (data) {
	            	console.log(data);
	            	$("#user_image").attr("src", '<?php echo base_url('./userImages/')?>'+data['profile_image']); 
	           		$('#full_name').html(data['name']);
	              	$('#contact').html(data['contact_number']);
	              	$('#zipcode').html(data['zipcode']);
	              	$('#email').html(data['email']);
	               	$('#location').html(data['location']);
	              	$('#age').html(data['age']);
            }
    		});
    	});

$('.reasonReject').click(function(){
	var group_id = $(this).attr('id');
	var user_id = $(this).attr('user_id');
	
	$('#rejectPop').modal('show');
	$('#group_id').val(group_id);
	$('#user_id').val(user_id);
});

$("#reset").click(function() { 
	window.location.href = "<?php echo base_url('group/home'); ?>";
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
	            url: '<?php echo base_url('group/reject_reason') ?>',
	            dataType: 'json',
	            data: $('#RejectGroup').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('group/home'); ?>";
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
// 	            url: '<?php echo base_url('group/insert') ?>',
// 	            dataType: 'json',
// 	            data: $('#addGroup').serialize(),
// 	            success: function (data) {
	            	
// 	            	if(data.result == true){
// 		              	toastr.success(data.message);
// 		             		 setTimeout(function(){
// 							     window.location.href = "<?php echo base_url('group/home'); ?>";
// 							  },1000);
// 	            	}else{
// 	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
// 	            	}
//             }
//         });
// 		}
// 	});

$("#addGroup").validate({
	errorElement:'span_error',
			rules: {
				users: {
						required: true
				},
				group_image: {
						required: true
				},
				group_name: {
						required: true
				},
				users: {
						required: true
				},
				categories: {
						required: true
				},
				start_date: {
						required: true
				},
				end_date: {
						required: true
				},
				agree: "required"
			}
			
		});


$("#editGroup").validate({
	errorElement:'span_error',
			rules: {
				users: {
						required: true
				},
				
				group_name: {
						required: true
				},
				users: {
						required: true
				},
				categories: {
						required: true
				},
				start_date: {
						required: true
				},
				end_date: {
						required: true
				},
				agree: "required"
			}
			
		});

    	//$( ".select2-single" ).select2();
    	$(document).ready(function() {
    		var startDate ;
    		var FromEndDate = new Date();
    		var ToEndDate = new Date();
    		 $('[data-toggle="datepicker"],#start_date_filter,#end_date_filter').datepicker({
    		 	 dateFormat: 'yyyy-mm-dd' ,
    		 	 startDate: new Date(), 
    		 	 // endDate: FromEndDate,
		        autoHide: true,
		        zIndex: 2048,
		        
                          
		      })
    		 .on('change', function (selected) {
    		 	// debugger;
     		 	  startDate = $('[data-toggle="datepicker"]').val();
     		 	  // $('[data-toggle="datepicker1"]').val()='';
     		 	  $('#end_date').val('');
     		 	   $('[data-toggle="datepicker1"]').datepicker('setStartDate', startDate);
    		   // startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
    		  // console.log(startDate);

    		  
              
    })
    		 $('[data-toggle="datepicker1"]').datepicker({
    		 	 dateFormat: 'yyyy-mm-dd' ,
    		 	  startDate: new Date(), 
    		 	 // endDate: FromEndDate,
    		 	 defaultDate: startDate,
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
     		 	  $('.edit_group_end_date').val('');
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
			            url: "<?php echo base_url('group/sub_categories');?>",
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
			            url: "<?php echo base_url('group/sub_categories2');?>",
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
			            url: "<?php echo base_url('group/sub_categories3');?>",
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
			            url: "<?php echo base_url('group/sub_categories4');?>",
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
			            url: "<?php echo base_url('group/sub_categories5');?>",
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




/*********** Group details by id *******/
$('#groupTable tbody tr .group_details').click(function(){
    		var group_id  = $(this).attr('id');
    		$('#reports').html("");
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('admin/get_group_details_id/') ?>'+group_id,
	            success: function (data) {
	            	//alert('a');
	            	//console.log(data['group_details']);
	            	$("#group_image").attr("src", '<?php echo base_url('./groupImages/')?>'+data['group_details']['group_image']);
	              	$('#group_name').html(data['group_details']['group_name']);
	              	$('#group_location').html(data['group_details']['location']);
	              	$('#group_created_by').html(data['group_details']['name'] + ' ' + data['group_details']['lastName']);
	              	$('#group_category').html(data['group_details']['category_title']);
	              	$('#group_sub_category').html(data['group_details']['subcategory_title']);
	              	$('#member_count').html(data['group_details']['members_count']);
	              	$('#group_start_date').html(data['group_details']['start_date']);
	              	$('#group_end_date').html(data['group_details']['end_date']);
	              	$('#group_last_editied').html(data['group_details']['HistoryOfChange']);
	              	$('#group_descr').html(data['group_details']['description']);
	              	$('#total_joined_users_count').html(data['total_joined_memebers']);

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

	              	if(data['group_details']['group_image'] != null && data['group_details']['group_image'] != ''){
	              		$('#group_image').attr('src', '<?php echo base_url('groupImages/');?>'+data['group_details']['group_image']);
	              	}else{
	              		$('#group_image').attr('src','<?php echo base_url("public/images/a.png") ?>');
	              	}

	              	 	$.each(data['other_details'], function(key,val) {

	              		$.each(val ,function(key,val){
	              		if(val.comments != '' && val.comments != null){
	              			//alert(val.comments);
		              		$('#report_div').show();
		              		$('#reports').append('<li id="report_id">'+ val.comments +'<span class="badge badge-primary"><a href="#" style="color:white;">' + val.name +' '+ val.lastName +' - '+ val.contact_number +' - '+ val.email+ ' </a></span></li>');
	              		}
	              	});
			        });
            }
    		});
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
	            	                    // console.log(data);
                    $('#editgroupModal').modal('show');
                    
                    $('#__group_id').val(data.group_details.group_id);
 
                    $('#__edit_group_image').val(data.group_details.group_image);
                    
                    $("#edit_group_image").attr("src", '<?php echo base_url('./groupImages/')?>'+data.group_details.group_image);
 
                    $('#edit_group_name').val(data.group_details.group_name);
                    
                    $('#edit_group_created_by').val(data.group_details.user_id).trigger('change');
 
                    // $("#edit_group_category").on('change',function () {
                 //        $(".select2-categories").trigger("change");
                 //    });
                    
                    // $('#edit_group_category').val(data.category_id).trigger('change');
 
                        
                   
                 //     $('#edit_subcategories').val(data.subcategory_id).trigger('change');
                   
                 //     $('#edit_subcategories2').val(data.subcategory2_id).trigger('change');
                   
                 //     $('#edit_subcategories3').val(data.subcategory3_id).trigger('change');
                    
                    $('#edit_member_count').val(data.group_details.members_count);
 
                    $('.edit_group_start_date').val(data.group_details.start_date);
 
                    $('.edit_group_start_date').datepicker('setDate', new Date(data.group_details.start_date));
        //             $('.edit_group_start_date,[data-toggle="datepicker2"],#start_date_filter').datepicker({
    		 	//  dateFormat: 'yyyy-mm-dd' ,
    		 	//  startDate: new Date(data.group_details.start_date), 
    		 	//  // endDate: FromEndDate,
		      //   autoHide: true,
		      //   zIndex: 2048
		        
                          
		      // })
 
                    $('.edit_group_end_date').val(data.group_details.end_date);
 
                    $('.edit_group_end_date').datepicker('setDate', new Date(data.group_details.end_date));
                 
                    $('#edit_ad_desc').val(data.group_details.description);
 
                     
	              
	            	
          		}
    		});
    	});



	    	//******** approve group Request ******/

    	$('#groupTable tbody tr .approve_advertise').click(function(){
    		var group_id = $(this).attr('id');

    		var user_id =$(this).attr('user_id'); 
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('group/approve_group_request/') ?>'+group_id,
	            data:{'user_id':user_id},
	            success: function (data) {
	            	if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('group/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the Group request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});


    	/********* rejected group Request ******/
    	$('#groupTable tbody tr .reject_advertise').click(function(){
    		var group_id = $(this).attr('id');
    		var user_id =$(this).attr('user_id');
    		$.ajax({
    			type: 'post',
    			dataType:'json',
	            url: '<?php echo base_url('group/reject_group_request/') ?>'+group_id,
	            data:{'user_id':user_id},
	            success: function (data) {
	            	if(data.status == true){
	            		toastr.success(data.message);
	            		 setTimeout(function(){
						     window.location.href = "<?php echo base_url('group/home'); ?>";
						  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the group request').addClass('alert alert-warning');
	            	}
	            }
    		})
    	});

</script>