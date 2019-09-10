<script>

$(document).ready(function() {
     $('#add_banner_image_btn').on('change', function() {
        
        imagesPreview(this, 'div.gallery');
    });
});


    var imagesPreview = function(input, placeToInsertImagePreview) {
    	 

        if (input.files) {
            var filesAmount = input.files.length;
           
           // var count=filesAmount;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                  //  $($.parseHTML('<img>')).attr('src', event.target.result).width(100)
                   // .height(100).html(placeToInsertImagePreview);

                    $(placeToInsertImagePreview).html('<img src="'+event.target.result+'">');
                  
                }

                reader.readAsDataURL(input.files[i]);

            }
        }

    };


$("#bannerAddModal").validate({
    errorElement:'span_error',
            rules: {
                banner_image: {
                        required: true
                },
               
            }
            
        });
 

</script>