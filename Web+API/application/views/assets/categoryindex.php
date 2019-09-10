<script type="text/javascript">
	

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#add_category_image')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#category_image')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

// $("#Addcategory").validate({
// 		rules: {
// 				category_title: {
// 						required: true
// 				},
// 				agree: "required"
// 			},

// 			submitHandler: function() {
// 			$.ajax({
// 				type: 'post',
// 	            url: '<?php echo base_url('category/add') ?>',
// 	            dataType: 'json',
// 	            data: $('#Addcategory').serialize(),
// 	            success: function (data) {
	            	
// 	            	if(data.status == true){
// 		              	toastr.success(data.message);
// 		            		 setTimeout(function(){
// 							     window.location.href = "<?php echo base_url('category/home'); ?>";
// 							  },1000);
// 	            	}else{
// 	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
// 	            	}
//             }
//         });
// 		}

// });


$('.edit_category').click(function(){
	var id = $(this).attr('id');

	$.ajax({
		type: 'post',
		url: '<?php echo base_url('category/getcategory_by_id/')?>'+id,
		dataType: 'json',
		success: function(data){
			$('#category_title').val(data['category_title']);
			$('#categoryId').val(data['category_id']);
			
			$('#category_image').attr('src','<?php echo base_url('/CategoryImages/')?>'+data['category_image']);
			$('#editcategory').modal('show');
		}
	})
});

/*$("#EditCategory").validate({
		rules: {
				category_title: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/updateCategory') ?>',
	            dataType: 'json',
	            data: $('#EditCategory').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});*/

$("#subcategory").validate({
		rules: {
				category_title: {
						required: true
				},
				agree: "required"
			},
			submitHandler: function() {
				
				// var id=$('#__subcategory_title').attr('category_id');
			
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/addSubcategory') ?>',
	            dataType: 'json',
	            data: $('#subcategory').serialize(),
	            success: function (data) {
	            	//alert(data);
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
		            		 $('#subcategory1').show();

	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$("#subcategory2").validate({
		rules: {
				subcategory_title: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/addSubcategory2') ?>',
	            dataType: 'json',
	            data: $('#subcategory2').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
		            		 $('#subcategory1').show();

	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$("#subcategory3").validate({
		rules: {
				subcategory_title: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/addSubcategory3') ?>',
	            dataType: 'json',
	            data: $('#subcategory3').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
		            		 $('#subcategory1').show();

	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$("#subcategory4").validate({
		rules: {
				subcategory_title4: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/addSubcategory4') ?>',
	            dataType: 'json',
	            data: $('#subcategory4').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
		            		 $('#subcategory1').show();

	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$("#subcategory5").validate({
		rules: {
				subcategory_title5: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/addSubcategory5') ?>',
	            dataType: 'json',
	            data: $('#subcategory5').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
		            		 $('#subcategory1').show();

	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});


$('.showCategory').click(function(){
	var id = $(this).attr('id');
	//var cat_name=$(this).html();
	//alert(id);

	$('.__apend_box').html('');
	$.ajax({
		type: 'post',
	            url: '<?php echo base_url('category/subcategories/') ?>'+id,
	         //   data: {cat_name:cat_name},
	            dataType: 'json',
	            success: function (data) {
	            	//alert(data.category_id);
	            	console.log(data);
	            	if(data != null && data != ""){
	            		$('#subcategory1').show();
	            		$('#subcategory_2').hide();
	            		$('#subcategory_3').hide();
	            		$('#subcategory_4').hide();
	            		$('#subcategory_5').hide();

	            		$.each(data,function(key,value){
	            			var dom = '<li class="">\
	                                        <a href="#" id="'+value.subcategory_id
+'" class="subcategories">'  + value.subcategory_title + '</a><h5 class="pull-right"><a href="#" id="'+ value.subcategory_id+'" class="editsubcategory1"> <span class="fa fa-pencil-square-o"></span></a></h5>\
	                                    </li>';
	            			$('.__apend_box').append(dom);
	            			
	            			$('#__category_id').val(value.category_id);
	            			$('#__category_id').attr('disabled', 'disabled');
	            			$('#__subcategory_title').attr('value',value.category_id);
	            		});

	            		
	            		
	            	}else{
	            		$('#__category_id').val(id);
	            			$('#__category_id').attr('disabled', 'disabled');
	            			$('#__subcategory_title').attr('value',id);

	            		$('#subcategory1').show();
	            		$('#subcategory_2').hide();
	            		$('#subcategory_3').hide();
	            		$('#subcategory_4').hide();
	            		$('#subcategory_5').hide();
	            		

	            	}
            }
	})
});

$(document).on('click','.subcategories',function(){
	var id = $(this).attr('id');

console.log();
	$('.__apend_box2').html('');
	$.ajax({
		type: 'post',
	            url: '<?php echo base_url('category/subcategories2/') ?>'+id,
	            dataType: 'json',
	            success: function (data) {
	            	console.log(data);

	            	if(data != null && data != "" && data[0].check==null){
	            		$('#subcategory1').show();
	            		$('#subcategory_2').show();
	            			$('#subcategory_3').hide();
		            		$('#subcategory_4').hide();
		            		$('#subcategory_5').hide();

	            		$.each(data,function(key,value){
	            			var dom = '<li class="">\
	                                        <a href="#" id="'+value.subcategory2_id
+'" class="subcategories2">'  + value.subcategory_title2 + '</a><h5 class="pull-right"><a href="#" id="'+ value.subcategory2_id+'" class="editsubcategory2"> <span class="fa fa-pencil-square-o"></span></a></h5>\
	                                    </li>';
	            			$('.__apend_box2').append(dom);

	            			$('#__subcategory_id').val(value.subcategory_id);
	            			$('#__subcategory_id').attr('disabled', 'disabled');
	            			$('#__subcategory_title2').attr('value',value.subcategory_id);
	            		});
	            		
	            		}
		            	else{
		            			$('#__subcategory_id').val(data[0].subcategory_id);
		            			$('#__subcategory_id').attr('disabled', 'disabled');
		            			$('#__subcategory_title2').attr('value',data[0].subcategory_id);
		            		$('#subcategory_2').show();

		            		$('#subcategory_3').hide();
		            		$('#subcategory_4').hide();
		            		$('#subcategory_5').hide();
		            	}
            }
	});
});

$(document).on('click','.subcategories2',function(){
	var id = $(this).attr('id');
console.log();
	$('.__apend_box3').html('');
	$.ajax({
		type: 'post',
	            url: '<?php echo base_url('category/subcategories3/') ?>'+id,
	            dataType: 'json',
	            success: function (data) {
	            	console.log(data);
	            	if(data != null && data != "" && data[0].check==null){
	            		$('#subcategory1').show();
	            		$('#subcategory_2').show();
	            		$('#subcategory_3').show();
	            		$('#subcategory_4').hide();
		            		$('#subcategory_5').hide();

	            		$.each(data,function(key,value){
	            			var dom = '<li class="">\
	                                        <a href="#" id="'+value.subcategory3_id
+'" class="subcategories3">'  + value.subcategory_title3 + '</a><h5 class="pull-right"><a href="#" id="'+ value.subcategory3_id+'" class="editsubcategory3"> <span class="fa fa-pencil-square-o"></span></a></h5>\
	                                    </li>';
	            			$('.__apend_box3').append(dom);       			
	            			$('#__subcategory_id2').val(value.subcategory2_id);
	            			$('#__subcategory_id2').attr('disabled', 'disabled');
	            			$('#__subcategory_title3').attr('value',value.subcategory2_id);
	            		});
	            		
	            	}else{
	            		   $('#__subcategory_id2').val(data[0].subcategory_id);
	            			$('#__subcategory_id2').attr('disabled', 'disabled');
	            			$('#__subcategory_title3').attr('value',data[0].subcategory_id);
	            		//$('#subcategory1').hide();
	            		//$('#subcategory_2').hide();
	            		$('#subcategory_3').show();
	            		$('#subcategory_4').hide();
		            		$('#subcategory_5').hide();
	            	}
            }
	});
});

$(document).on('click','.subcategories3',function(){
	var id = $(this).attr('id');
console.log();
	$('.__apend_box4').html('');
	$.ajax({
		type: 'post',
	            url: '<?php echo base_url('category/subcategories4/') ?>'+id,
	            dataType: 'json',
	            success: function (data) {
	            	console.log(data);
	            	if(data != null && data != "" && data[0].check==null){
	            		$('#subcategory1').show();
	            		$('#subcategory_2').show();
	            		$('#subcategory_3').show();
	            		$('#subcategory_4').show();
	            		$('#subcategory_5').hide();
	            		$.each(data,function(key,value){
	            			var dom = '<li class="">\
	                                        <a href="#" id="'+value.subcategory4_id
+'" class="subcategories4">'  + value.subcategory_title4 + '</a><h5 class="pull-right"><a href="#" id="'+ value.subcategory4_id+'" class="editsubcategory4"> <span class="fa fa-pencil-square-o"></span></a></h5>\
	                                    </li>';
	            			$('.__apend_box4').append(dom);
	            			$('#__subcategory_id3').val(value.subcategory3_id);
	            			$('#__subcategory_id3').attr('disabled', 'disabled');
	            			$('#__subcategory_title4').attr('value',value.subcategory3_id);
	            		});
	            		
	            	}else{
	            		//$('#subcategory1').hide();
	            		//$('#subcategory_2').hide();
	            		//$('#subcategory_3').hide();
	            		   $('#__subcategory_id3').val(data[0].subcategory_id);
	            			$('#__subcategory_id3').attr('disabled', 'disabled');
	            			$('#__subcategory_title4').attr('value',data[0].subcategory_id);
	            		$('#subcategory_4').show();
	            		$('#subcategory_5').hide();
	            	}
            }
	});
});

$(document).on('click','.subcategories4',function(){
	var id = $(this).attr('id');
console.log();
	$('.__apend_box5').html('');
	$.ajax({
		type: 'post',
	            url: '<?php echo base_url('category/subcategories5/') ?>'+id,
	            dataType: 'json',
	            success: function (data) {
	            	console.log(data);
	            	if(data != null && data != "" && data[0].check==null){
	            		$('#subcategory1').show();
	            		$('#subcategory_2').show();
	            		$('#subcategory_3').show();
	            		$('#subcategory_4').show();
	            		$('#subcategory_5').show();
	            		$.each(data,function(key,value){
	            			var dom = '<li class="">\
	                                        <a href="#" id="'+value.subcategory5_id
+'" class="subcategories5">'  + value.subcategory_title5 + '</a><h5 class="pull-right"><a href="#" id="'+ value.subcategory5_id+'" class="editsubcategory5"> <span class="fa fa-pencil-square-o"></span></a></h5>\
	                                    </li>';
	            			$('.__apend_box5').append(dom);
	            			$('#__subcategory_id4').val(value.subcategory4_id);
	            			$('#__subcategory_id4').attr('disabled', 'disabled');
	            			$('#__subcategory_title5').attr('value',value.subcategory4_id);
	            		});
	            		
	            	}else{
	            		//$('#subcategory1').hide();
	            		//$('#subcategory_2').hide();
	            		//$('#subcategory_3').hide();
	            		//$('#subcategory_4').hide();

	            		   $('#__subcategory_id4').val(data[0].subcategory_id);
	            			$('#__subcategory_id4').attr('disabled', 'disabled');
	            			$('#__subcategory_title5').attr('value',data[0].subcategory_id);
	            		$('#subcategory_5').show();
	            	}
            }
	});
});

$(document).on('click','.editsubcategory1',function(){
	var id = $(this).attr('id');
	$.ajax({
		type: 'post',
		url: '<?php echo base_url('category/getsubcategory_by_id/')?>'+id,
		dataType: 'json',
		success: function(data){
			$('#subcategory_title').val(data['subcategory_title']);
			$('#subcategoryId').val(data['subcategory_id']);
			$('#editsubcategory').modal('show');
		}
	})
});

$(document).on('click','.editsubcategory2',function(){
	var id = $(this).attr('id');
	$.ajax({
		type: 'post',
		url: '<?php echo base_url('category/getsubcategory_by_id2/')?>'+id,
		dataType: 'json',
		success: function(data){
			$('#subcategory_title2').val(data['subcategory_title2']);
			$('#subcategoryId2').val(data['subcategory2_id']);
			$('#editsubcategory2').modal('show');
		}
	})
});

$(document).on('click','.editsubcategory3',function(){
	var id = $(this).attr('id');
	$.ajax({
		type: 'post',
		url: '<?php echo base_url('category/getsubcategory_by_id3/')?>'+id,
		dataType: 'json',
		success: function(data){
			$('#subcategory_title3').val(data['subcategory_title3']);
			$('#subcategoryId3').val(data['subcategory3_id']);
			$('#editsubcategory3').modal('show');
		}
	})
});

$(document).on('click','.editsubcategory4',function(){
	var id = $(this).attr('id');
	$.ajax({
		type: 'post',
		url: '<?php echo base_url('category/getsubcategory_by_id4/')?>'+id,
		dataType: 'json',
		success: function(data){
			$('#subcategory_title4').val(data['subcategory_title4']);
			$('#subcategoryId4').val(data['subcategory4_id']);
			$('#editsubcategory4').modal('show');
		}
	})
});

$(document).on('click','.editsubcategory5',function(){
	var id = $(this).attr('id');
	$.ajax({
		type: 'post',
		url: '<?php echo base_url('category/getsubcategory_by_id5/')?>'+id,
		dataType: 'json',
		success: function(data){
			$('#subcategory_title5').val(data['subcategory_title5']);
			$('#subcategoryId5').val(data['subcategory5_id']);
			$('#editsubcategory5').modal('show');
		}
	})
});

$("#EditsubCategory").validate({
		rules: {
				subcategory_title: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/updatesubCategory') ?>',
	            dataType: 'json',
	            data: $('#EditsubCategory').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$("#EditsubCategory2").validate({
		rules: {
				subcategory_title2: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/updatesubCategory2') ?>',
	            dataType: 'json',
	            data: $('#EditsubCategory2').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$("#EditsubCategory3").validate({
		rules: {
				subcategory_title3: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/updatesubCategory3') ?>',
	            dataType: 'json',
	            data: $('#EditsubCategory3').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$("#EditsubCategory4").validate({
		rules: {
				subcategory_title4: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/updatesubCategory4') ?>',
	            dataType: 'json',
	            data: $('#EditsubCategory4').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});

$("#EditsubCategory5").validate({
		rules: {
				subcategory_title5: {
						required: true
				},
				agree: "required"
			},

			submitHandler: function() {
			$.ajax({
				type: 'post',
	            url: '<?php echo base_url('category/updatesubCategory5') ?>',
	            dataType: 'json',
	            data: $('#EditsubCategory5').serialize(),
	            success: function (data) {
	            	
	            	if(data.status == true){
		              	toastr.success(data.message);
		            		 setTimeout(function(){
							     window.location.href = "<?php echo base_url('category/home'); ?>";
							  },1000);
	            	}else{
	            		toastr.warning('Some error occur while approved the seller request').addClass('alert alert-warning');
	            	}
            }
        });
		}

});





//$('.select2').select2();

</script>