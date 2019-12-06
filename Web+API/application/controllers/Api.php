<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {
   
    public  $user_id;

	public function __construct()
	{
		parent::__construct();
        $this->load->model('ApiModel');
        $this->load->model('BuyerModel');
        $this->load->model('SellerModel');
        $this->load->model('Email');

        if (!$this->token_check()) {
            die;
        }


		
        
    }

/******* Token Check api *********/
	public function token_check(){
		 //Allowed methods without TOKEN
        $allowed_routes = array('login','forgotPassword','register','verify_otp','updateotp','getAllCategories','UpdateGroupexpire');

        if (!in_array($this->router->method, $allowed_routes)) {

            $headers = $this->input->request_headers();
            if (!empty($headers['token'])){
                try{     

                    $data = $this->jwt_decode($headers['token']);
                    
                    if (!$this->ApiModel->is_token($headers['token']) || !$this->ApiModel->is_user($data)){

                        $response[$this->config->item('rest_status_field_name')] = false;
                        $response[$this->config->item('rest_message_field_name')] = "Invalid User";
                        $this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
                        return false;
                    }else{
                        $this->user_id = $data['user_id'];
                        return true;
                    }
                }
                catch (Exception $e)
                {
                    $response[$this->config->item('rest_status_field_name')]  = false;
                    $response[$this->config->item('rest_message_field_name')] = $e->getMessage();
                    $this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
                }    
            }else{
                $response[$this->config->item('rest_status_field_name')] = false;
                $response[$this->config->item('rest_message_field_name')] = "No page Found";
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
            }

            return false;           
        }

        return true;
	}

/*******  Login & Token Genereate api  ********/
    public function login_post(){
    	$dataPost = $this->input->post();

    	 log_message('debug',print_r($dataPost,TRUE));

    	$this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE)
        {
        	$check_user = $this->ApiModel->check_user_exits($dataPost['username']);
        	if($check_user){

	        $user = $this->ApiModel->login($dataPost);
	        if ($user != null) {

	        	$device_token =$dataPost['device_token'];

	        	
	        	$details = array();
	        	$user_details = $this->ApiModel->get_user_details($user->user_id);
	        	if($user_details){

	        		$inserttoken = $this->ApiModel->insert_token($user->user_id,$user_details->user_type,$device_token);

	        		if($user_details->user_type == 'Seller'){
	        			
	        				$details = array(
	        						'user_id' => $user_details->user_id,
	        						'name' => $user_details->name,
	        						'age' => $user_details->age,
	        						'email' => $user_details->email,
	        						'isActive'=>$user->Status,
	        						'contact_number' => $user_details->contact_number,
	        						'location' => $user_details->location,
	        						'address'=>$user_details->address,
	        						'profile_image' =>$user_details->profile_image==''?'':base_url().'userImages/'.$user_details->profile_image,
	        						'seller_tinNo' => $user_details->seller_tinNo,
	        						'seller_companyName' => $user_details->seller_companyName,
	        						'seller_usp' => $user_details->seller_usp,
	        						'seller_secondary_name' => $user_details->seller_secondary_name,
	        						'seller_secondary_contact' => $user_details->seller_secondary_contact,
	        						'seller_secondary_email' => $user_details->seller_secondary_email,
	        						'notify_status' => $user_details->notify_status,
	        						'user_type' => $user_details->user_type,
	        						'zipCode' => $user_details->zipcode,
	        						'isVerifyOtp'=>$user->opt_verify_status==1?'true':'false'
	        					);
	        		
	        		
	        	}
	        		else{
	        			$details = array(
	        						'user_id' => $user_details->user_id,
	        						'name' => $user_details->name,
	        						'age' => $user_details->age,
	        						'email' => $user_details->email,
	        						'contact_number' => $user_details->contact_number,
	        						'address'=>$user_details->address,
	        						'location' => $user_details->location,
	        						'profile_image' =>$user_details->profile_image==''?'':base_url().'userImages/'.$user_details->profile_image,
	        						'notify_status' => $user_details->notify_status,
	        						'user_type' => $user_details->user_type,
	        						'zipCode' => $user_details->zipcode,
	        						'isVerifyOtp'=>$user->opt_verify_status==1?'true':'false'
	        					);
	        		}
	        	}
	            $token['username'] = $this->input->post('username');
                $token['user_id'] = $user->user_id;
                $date = new DateTime();
                $tokenData = array();
	            $tokenData['user_id'] =$user->user_id;
	            $token = $this->jwt_encode($tokenData);

	            log_message('debug',print_r($token,TRUE));

	             $this->db->where('user_id',$user->user_id)->update('login', array(
                           'device_token' => $token
                       )
	             );


                $response = array(
		                $this->config->item('rest_status_field_name') => true,
		                $this->config->item('rest_message_field_name') => 'Login successfully',
		                'data' => array('user_details' => $details,'token' => $token )
		                	);
               
                $this->response($response, REST_Controller::HTTP_OK);
		    }else{
		    	$response[$this->config->item('rest_status_field_name')] = false;
	            $response[$this->config->item('rest_message_field_name')] = "Please enter valid username or password";
	                $this->response($response, REST_Controller::HTTP_OK);
		    }

		    }
		    else{
		    	$response[$this->config->item('rest_status_field_name')] = false;
	            $response[$this->config->item('rest_message_field_name')] = "Account doesn't exist";
	                $this->response($response, REST_Controller::HTTP_OK);
		    }
		}

	    else{
	    	$response[$this->config->item('rest_status_field_name')] = false;
            $response[$this->config->item('rest_message_field_name')] =  $this->form_validation->error_array();
            $this->response($response, REST_Controller::HTTP_OK);
	    }
	}


/*******  Register api for  ********/
	public function register_post(){
	  	$data = $this->input->post();
      /* form validation */
	  	$this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required|numeric|is_unique[users.contact_number]|regex_match[/^[0-9]{10,13}$/]',array('is_unique' => 'the contact number is already existing, please login or use different contact no.'));
       // $this->form_validation->set_message('contact_number');
        // $this->form_validation->set_message('is_unique[users.contact_number]','Primary Contact Number Must be Unique');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]',array('is_unique' => 'the email is already existing, please login or use different email'));
        $this->form_validation->set_rules('password','Password','trim|required');
        $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[password]');
        if($this->form_validation->run() == TRUE){
        	$result = array();

        	if (count($_FILES) == 0)
            {
            	$data['file_name'] = '';
            	
	  			$result = $this->ApiModel->insert($data);
	  		}else{

	  			log_message('debug',print_r($data,TRUE));

	  			$ext = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_EXTENSION);           
	            $target_folder="userImages/";        
	            $file_path = $target_folder;           
	            $file_name =time().'.'.$ext; 
	            $file_tmp_name = $_FILES['uploaded_file']['tmp_name'];
	            move_uploaded_file($file_tmp_name, $file_path.$file_name);
	            $data['file_name'] = $file_name;

	            $result = $this->ApiModel->insert($data);

	  		}
	  		if(!empty($result)){

	  			log_message('debug',print_r($result,TRUE));
	  			$user_id = $result;
	  			$tokenData = array();
	            $tokenData['user_id'] = $user_id;
	            $token = $this->jwt_encode($tokenData);

	            $user_details = $this->ApiModel->get_user_details($user_id);
	            $user_details->token = $token;
	            $user_details->user_id = $user_id;

	            $user_details->password = $this->encryption->encrypt($data['password']);

	             $details = $this->ApiModel->login_insert($user_details);




              $this->sendotp($details['opt'],$user_details->email,'OTP');



		  			$response = [
		            $this->config->item('rest_status_field_name') => 'true',
		            $this->config->item('rest_message_field_name') => 'OTP has been sent to your email ID',
		            'data' => $details 

		        ];



	        	$this->response($response, REST_Controller::HTTP_OK);
	        	log_message('debug',print_r($response,TRUE));
	  		}
	  		else{
	  			$response = [
		            $this->config->item('rest_status_field_name') => 'false',
		            $this->config->item('rest_message_field_name') => 'User not created successfully',
		        ];
		    	$this->response($response, REST_Controller::HTTP_OK);
		    	log_message('debug',print_r($response,TRUE));
	  		}
	  	}
	  	else
        {
            $response[$this->config->item('rest_status_field_name')] = 'false';
            $response[$this->config->item('rest_message_field_name')] =  $this->form_validation->error_array();
            $this->set_response($response, REST_Controller::HTTP_OK);
        }

	}

	public function send_mail_post()
	{
		$email = $this->input->post('email');
		
		$buyer=$this->ApiModel->get_buyer_details($this->user_id);
		$advertisement=$this->BuyerModel->get_advertisement_by_id($this->input->post('advertisement_id'));

		$seller=$this->ApiModel->get_seller_details_by_email($email);

		$message=$buyer->name." viewed your advertisement - ".$advertisement[0]->advertisement_name;
		$subject="View Advertisement";	

		$this->sendotp($message,$email,$subject);

		//-------------------SuperAdmin Email-----------------
		$messageSuperAdmin=$buyer->name." viewed ".$seller->name." advertisement - ".$advertisement[0]->advertisement_name;
		$subjectSuperADmin="View Seller Advertisement";	
		$this->send_mail_superadmin($messageSuperAdmin,$subjectSuperADmin);
		//-------------------SuperAdmin Email-----------------
		

		$response = [
		            $this->config->item('rest_status_field_name') => 'true',
		            $this->config->item('rest_message_field_name') => 'Email Sent Successfully',
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
	}



	public function sendotp($message,$to,$subject){
			
			$this->load->library('email');    
            $config = $this->config->item('email');

            $this->email->initialize($config);
                // Load email library and passing configured values to email library
              //$this->load->library('email', $config);
              $this->email->set_newline("\r\n");

              // Sender email address
              $this->email->from('pawan.gulati@zabius.com', 'GoGroup');
              // Receiver email address
              $this->email->to($to);
              
              // Subject of email
              $this->email->subject($subject);
              // Message in email
              $this->email->message($message);

              log_message('debug',print_r($message,TRUE));

              $result = $this->email->send();

			  log_message('debug',print_r($to,TRUE));
			  log_message('debug_smtp',print_r($result,TRUE));



	}

	public function send_mail_superadmin($message,$subject)
	{				
			$this->load->library('email');    
            $config = $this->config->item('email');

            $this->email->initialize($config);
                // Load email library and passing configured values to email library
              //$this->load->library('email', $config);
            $this->email->set_newline("\r\n");

              // Sender email address
            $this->email->from('pawan.gulati@zabius.com', 'GoGroup');
              // Receiver email address
            $this->email->to('pawan.gulati@zabius.com');
              
              // Subject of email
            $this->email->subject($subject);
              // Message in email
            $this->email->message($message);

            log_message('debug',print_r($message,TRUE));

            $this->email->send();
	}


/*******  Verify opt api for  ********/
	public function verify_otp_post(){
		
		$data = $this->input->post();

		  log_message('debug',print_r($data,TRUE));

		/* form validation */
		$this->load->library('form_validation');
		$this->form_validation->set_rules('otp_text', 'OTP', 'required|numeric|min_length[4]|max_length[4]');
		$this->form_validation->set_rules('token', 'Token', 'trim|required');

		if($this->form_validation->run() == TRUE){
			$result = $this->ApiModel->verify_otp($data);

			log_message('debug',print_r($result,TRUE));
			if(!empty($result)){
				$response = [
		            $this->config->item('rest_status_field_name') => 'true',
		            $this->config->item('rest_message_field_name') => 'OTP is verified',
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
          
              log_message('debug',print_r($response,TRUE));
			}
			else{
				$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'Please enter correct OTP ',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);

		    	log_message('debug',print_r($response,TRUE));
	  			}
			}
			else{
				$response[$this->config->item('rest_status_field_name')] = 'false';
            	$response[$this->config->item('rest_message_field_name')] =  $this->form_validation->error_array();

            	log_message('debug',print_r($response,TRUE));
            	$this->response($response, REST_Controller::HTTP_OK);
			}
	}



	public function updateotp_post(){
		
		$data = $this->input->post();

		$result = $this->ApiModel->getotpdetails($data['id']);

			log_message('debug',print_r($result,TRUE));	
			if($result){

				$this->sendotp($result['opt'],$data['email'],'OTP');

				$response = [
		            $this->config->item('rest_status_field_name') => 'true',
		            $this->config->item('rest_message_field_name') => 'OTP has been sent to your email ID',
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
          
              log_message('debug',print_r($response,TRUE));
			}
			else{
				$response[$this->config->item('rest_status_field_name')] = 'false';
            	$response[$this->config->item('rest_message_field_name')] =  'Invalid EmailID';

            	log_message('debug',print_r($response,TRUE));
            	$this->response($response, REST_Controller::HTTP_OK);
			}
	}






/**************** Get User profile api *************/
	public function profile_get(){

		$data = $this->ApiModel->get_buyer_details($this->user_id);
		if(!empty($data)){

			$array = array(
						'user_id' => $data->user_id,
						'name' => $data->name,
						'age' => $data->age,
						'email' => $data->email,
						'contact_number' => $data->contact_number,
						'location' => $data->location,
						'zipCode' => $data->zipcode,
						'pan_gst' => $data->seller_tinNo,
						'company_name' => $data->seller_companyName,
						'usp' => $data->seller_usp,
						'profile_image' =>$data->profile_image==''?'': base_url().'userImages/'.$data->profile_image,

						'account_number'	=>$data->account_number,
						'ac_holder_name' 	=>$data->ac_holder_name,
						'ifsc'				=>$data->ifsc,
						'bank_name'			=>$data->bank_name,
						'paytm_no'			=>$data->paytm_no,
						'address'			=>$data->address,
						'created_date' => $data->created_date
				); 
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting User Profile Details Successfully",
		            'data' => $array
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'No Data Found',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}

/****************** Edit User's profile api ******************/
	public function editProfile_post(){
		$data = $this->input->post();
		/* form validation */

		log_message('debug',print_r($data,TRUE));
	  	$this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
       $this->form_validation->set_rules('contact_number', 'Contact Number', 'required|numeric|regex_match[/^[0-9]{10,13}$/]');
        //$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
        if($this->form_validation->run() == TRUE){
        	$data['user_id'] = $this->user_id;
        	$result = array();
        	if(count($_FILES) == 0){
        		$file_path = $data['image_path'];
                $file_name = substr($file_path, strrpos($file_path, '/')+1 );
                $data['file_name'] = $file_name;
        		$result = $this->ApiModel->updateProfile($data);
        	}else{
        		$ext = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_EXTENSION);
		        //print_r($_FILES);die();
		        $target_folder="userImages/";	      
		        $file_path = $target_folder;	       
		        $file_name =time().'.'.$ext;
		        
		        $file_tmp_name = $_FILES['uploaded_file']['tmp_name'];
		        move_uploaded_file($file_tmp_name, $file_path.$file_name);
		        $data['file_name'] = $file_name;
		        $result = $this->ApiModel->updateProfile($data);
        	}

 				if(!empty($result)){


$data = $this->ApiModel->get_buyer_details($this->user_id);
		if(!empty($data)){

			$array = array(
						'user_id' => $data->user_id,
						'name' => $data->name,
						'age' => $data->age,
						'email' => $data->email,
						'contact_number' => $data->contact_number,
						'location' => $data->location,
						'address'	=>$data->address,
						'profile_image' =>$data->profile_image==''?'': base_url().'userImages/'.$data->profile_image,
						'created_date' => $data->created_date
				);
				} 


 					$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => 'Profile updated Successfully',
		             'data' => $array
			        ];
		        	$this->set_response($response, REST_Controller::HTTP_OK);

		        	log_message('debug',print_r($response,TRUE));
 				}else{
 					$response[$this->config->item('rest_status_field_name')] = false;
		            $response[$this->config->item('rest_message_field_name')] =  "Profile not updated Successfully";
		            $this->set_response($response, REST_Controller::HTTP_OK);
 				}
        }
	  	else
        {
            $response[$this->config->item('rest_status_field_name')] = false;
            $response[$this->config->item('rest_message_field_name')] =  $this->form_validation->error_array();
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
	}


	public function editContact_post(){
		$data = $this->input->post();


		$email=$data['email'];
		$contact_number=$data['contact_number'];

		$data['user_id'] = $this->user_id;
        	$result = array();	

		$isemail=$this->ApiModel->isemail($email,$this->user_id);

		$iscontact=$this->ApiModel->iscontact($contact_number,$this->user_id);


			if($isemail==0)
			{			
			if($iscontact==0)
			{
				
		        $result = $this->ApiModel->updateContact($data);     	

 				if(!empty($result)){

		$output = $this->ApiModel->getotpdetails($this->user_id);

			if($output){

				$this->sendotp($output['opt'],$data['email'],'OTP');
			}
		
 					$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => 'Contact updated Successfully'
		             
			        ];
		        	$this->set_response($response, REST_Controller::HTTP_OK);

		        	log_message('debug',print_r($response,TRUE));
 				}else{
 					$response[$this->config->item('rest_status_field_name')] = false;
		            $response[$this->config->item('rest_message_field_name')] =  "Something Went Wrong";
		            $this->set_response($response, REST_Controller::HTTP_OK);
 				}
 				}
			else
			{
		$response[$this->config->item('rest_status_field_name')] = false;
		            $response[$this->config->item('rest_message_field_name')] =  "the contact number is already existing, please login or use different contact no.";
		            $this->set_response($response, REST_Controller::HTTP_OK);
			}
			}
			else
			{
				$response[$this->config->item('rest_status_field_name')] = false;
		            $response[$this->config->item('rest_message_field_name')] =  "the Email is already existing, please login or use different email";
		            $this->set_response($response, REST_Controller::HTTP_OK);
			}
			}
        
	


/************* get all categories api ***********/
	public function getCategories_get(){
		$categories = $this->ApiModel->get_categories();
		if(!empty($categories)){
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting Categories Successfully",
		            'data' => $categories
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'No Data Found',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}

/********* get all Sub categories api **********/
	public function getSubcategories_post(){
		$category_id = $this->input->post('category_id');

		if(!is_numeric($category_id)){
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'Invalid Category ID',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
		    	return false;
		}
		
		$subcategories = $this->ApiModel->get_subcategories($category_id);

		if(!empty($subcategories)){
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting Sub Categories Successfully",
		            'data' => $subcategories
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => 'No Data Found',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}


/********* get all Sub categories2 api ************/
	public function getSubcategories2_post(){
		$subcategory_id = $this->input->post('subcategory_id');

		if(!is_numeric($subcategory_id)){
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'Invalid Subcategory Id',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
		    	return false;
		}
		
		$subcategories = $this->ApiModel->get_subcategories2($subcategory_id);

		if(!empty($subcategories)){
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting Sub Categories Successfully",
		            'data' => $subcategories
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'No Data Found',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}

	public function getGroupByID_post(){
		$category_id = $this->input->post('category_id');

		if(!is_numeric($category_id)){
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'Invalid Subcategory Id',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
		    	return false;
		}
		
		$groups = $this->ApiModel->get_groupbyID($category_id);

		if(!empty($groups)){
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting Groups Successfully",
		            'data' => $groups
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => '',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}

	public function getAdsByID_post(){
		$category_id = $this->input->post('category_id');

		if(!is_numeric($category_id)){
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'Invalid Subcategory Id',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
		    	return false;
		}
		
		$Ads = $this->ApiModel->get_groupbyAdsID($category_id);

		if(!empty($Ads)){
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting Advertisemnet Successfully",
		            'data' => $Ads
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'No Data Found',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}

/******** get all sub categories3 api **********/
		public function getSubcategories3_post(){
		$subcategory_id2 = $this->input->post('subcategory_id2');

		if(!is_numeric($subcategory_id2)){
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'Invalid Subcategory ID',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
		    	return false;
		}
		
		$subcategories = $this->ApiModel->get_subcategories3($subcategory_id2);

		if(!empty($subcategories)){
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting Sub Categories Successfully",
		            'data' => $subcategories
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'No Data Found',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}

/********* get All subcatgorie4 api **********/
	public function getSubcategories4_post(){
		$subcategory_id3 = $this->input->post('subcategory_id3');

		if(!is_numeric($subcategory_id3)){
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'Invalid Subcategory ID',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
		    	return false;
		}
		
		$subcategories = $this->ApiModel->get_subcategories4($subcategory_id3);

		if(!empty($subcategories)){
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting Sub Categories Successfully",
		            'data' => $subcategories
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'No Data Found',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}

/************* get all subcategories5's details api **************/
	public function getSubcategories5_post(){
		$subcategory_id4 = $this->input->post('subcategory_id4');

		if(!is_numeric($subcategory_id4)){
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'Invalid Subcategory ID',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
		    	return false;
		}
		
		$subcategories = $this->ApiModel->get_subcategories5($subcategory_id4);

		if(!empty($subcategories)){
			$response = [
		            $this->config->item('rest_status_field_name') => true,
		            $this->config->item('rest_message_field_name') => "Getting Sub Categories Successfully",
		            'data' => $subcategories
		        ];
	        $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
		            $this->config->item('rest_status_field_name') => false,
		            $this->config->item('rest_message_field_name') => 'No Data Found',
		        ];
		    	$this->set_response($response, REST_Controller::HTTP_OK);
	  	}
	}


/************ Change Notification Setting Api ***********/
    public function changeSetting_post(){
        $user_id = $this->user_id;
        $notify_status = $this->input->post('notify_status');

        $result = $this->ApiModel->change_notification_settings($user_id,$notify_status);
        if($result){
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Notification updated successfully"
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Something Went Wrong',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }

/********** user's change password api ************/
    public function changePassword_post(){
    	$this->load->library('form_validation');
        $user_id = $this->user_id;
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_new_password');
        /* Form validations */
        $this->form_validation->set_rules('old_password','Password','trim|required');
        $this->form_validation->set_rules('new_password','New Password','trim|required');
        $this->form_validation->set_rules('confirm_new_password','Confirm Password','trim|required|matches[new_password]');

        if($this->form_validation->run() == TRUE){
	        $check_old_password = $this->ApiModel->get_check_old_password($user_id,$old_password);
	        if(!$check_old_password){
	        	$response = [
	                    $this->config->item('rest_status_field_name') => false,
	                    $this->config->item('rest_message_field_name') => 'Please enter correct old password',
	                ];
	            $this->set_response($response, REST_Controller::HTTP_OK);
	            return false;
	        }

	        $result  = $this->ApiModel->change_password($user_id,$new_password);
	        if($result){
	        	$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Password updated successfully"
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
        	$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Password not updated successfully',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    	}else{
    		$response[$this->config->item('rest_status_field_name')] = false;
            $response[$this->config->item('rest_message_field_name')] =  $this->form_validation->error_array();
            $this->response($response, REST_Controller::HTTP_OK);
    	}	
    }

/********** get filtered groups details api ************/
	public function getFilteredGroupDetails_post(){
		 $id = $this->input->post('category_id');
		$data = $this->input->post();
		$data['user_id'] = $this->user_id;
		$result = $this->ApiModel->get_filtered_group_details($id);
		$resultArray = array();
		if($result){
			foreach($result as $row){
				$resultArray[] = array(
						'group_id' => $row->group_id,
						 'group_name' => $row->group_name,
						'profile_image' => base_url().'userImages/'.$row->profile_image,
						'name' => $row->name,
						'location' => $row->location,
						'groupLocation'=>$row->groupLocation,
						'category_title' => $row->category_title,
						'subcategory_id' => $row->subcategory_id,
						'subcategory_title' => $row->subcategory_title,
						'subcategory_title2' => $row->subcategory_title2,
						'subcategory_title3' => $row->subcategory_title3,
						'subcategory_title4' => $row->subcategory_title4,
						'subcategory_title5' => $row->subcategory_title5,
						'rating' => $row->rating,
						'group_image' => base_url().'groupImages'.$row->group_image,
						'cost_range' => $row->cost_range,
						'end_date' => $row->end_date,
						'members_count' => $row->members_count,
						'join_Member'=>$this->BuyerModel->getJoinMember($row->group_id),
						'description' => $row->description,
						'join_status' => $row->join_status
					);
			}
			$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => array("Getting all filtered Groups successfully"),
                    'data' => $resultArray
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => array('No data Found'),
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
		}
	}

/************ get All filtered Advertisemnet's details api *************/
	public function getFilteredAdvertisements_post(){
		$data = $this->input->post();
		$data['user_id'] = $this->user_id;
		$result = $this->ApiModel->get_filtered_advertisement_details($data);
		$details = array();
		if($result){
			foreach($result as $row){
				$details = array(
							'advertisement_id' => $row->advertisement_id,
							'advertisement_name'=> $row->advertisement_name,
							'status' => $row->status,
							'end_date' => $row->end_date,
							'views_count' => $row->views_count,
							'group_count' => $row->group_count,
							'image_path' => base_url().'advertisementImages/'.$row->image_path,
					);
			}
			$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => array("Getting all filtered Groups successfully"),
                    'data' => $result
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => array('No data Found'),
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
		}
	}

	public function UpdateGroupexpire_post(){
		
		$result = $this->ApiModel->updateExpired();
		
		if($result){
			
			$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "successfully",
                    
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'No data Found',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
		}
	}





	public function getFilteredsellerAdvertisements_post(){
		$data = $this->input->post();
		$data['user_id'] = $this->user_id;
		$result = $this->ApiModel->get_filteredseller_advertisement_details($data);
		$details = array();
		if($result){
			foreach($result as $row){

 			$images = $this->SellerModel->get_advertisement_images_by_id($row->advertisement_id);

               if($images){
                        foreach($images as $image){
                            $imageArray[] = array(
                                    'advertisement_id' => $image->advertisement_id,
                                    'image_id' => $image->image_id,
                                    'image_path' => base_url().'advertisementImages/'.$image->image_path
                                );
                        }
                        }   
                        


				$details[] = array(
							'advertisement_id' => $row->advertisement_id,
							'advertisement_name'=> $row->advertisement_name,
                            'activeStatus' => $row->status,
                            'end_date' => $row->end_date,
                            'views_count' => $row->views_count,
                            'group_count' => $row->group_count,
                            'start_date'=>$row->start_date,
                            'advertisement_details'=>$row->advertisement_details,
                            'user_count'=>$row->user_count,
                           // 'group_count'=>$row->group_count,
                            'category_title'=>$row->category_title,
                            'subcategory_title'=>$row->subcategory_title,
                            'subcategory_title2'=>$row->subcategory_title2,
                            'subcategory_title3'=>$row->subcategory_title3,
                            'subcategory_title4'=>$row->subcategory_title4,
                            'subcategory_title5'=>$row->subcategory_title5,
                            'location'=>$row->location,

                            'images_details' => $imageArray
					);
				 $imageArray =array();
			}
			$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting all filtered Groups successfully",
                    'data' => $details
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
		}else{
			$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'No data Found',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
		}
	}


public function notification_post(){
		
			$user_type = $this->input->post('user_type');       
        	$result = $this->ApiModel->getNotification($this->user_id,$user_type);
           $count=$this->ApiModel->getNotificationcount($this->user_id,$user_type);


        	$details = array();
        	if($result){

				foreach($result as $row){

					if($user_type=='seller')
					{
						$details[] = array(
							'notify' => $row->status,
                            'created_date' => date('Y-m-d', strtotime($row->created_date)),
                             'notify_date' => date('M d', strtotime($row->created_at)),
                           
                           
					);
					}

					else{
							$details[] = array(
							'notify' => $row->status,
                            'group_name' => $row->group_name,
                            'notify_date' => date('M d', strtotime($row->created_at)),
                            
                            );                            
					}

				}
        		$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Notification get successfully",
                    'count'=>$count,
                    'data' => $details
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
        	}else{
        		$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No new Notification',
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
        	}
        
	}



public function readNotification_post(){
		
			$user_type = $this->input->post('user_type');       
        	$result = $this->ApiModel->updatenotification($this->user_id,$user_type);   
        	
        	if($result){

        		$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Notification update successfully"                   
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
        	}else{
        		$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Something Wrong'
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
        	}
        
	}





/*********** forget password Api ***************/
	public function forgotPassword_post(){
		$this->load->library('form_validation');
		$this->load->library('email');

		$username = $this->input->post('username');
        $this->form_validation->set_rules('username', 'Username', 'required|valid_email');

        if($this->form_validation->run() == TRUE){
        	$check_user = $this->ApiModel->check_user_exits($username);
        	if($check_user){


        		$password=$this->encryption->decrypt($check_user->password);

        		log_message('debug',print_r($password,TRUE));

        		$this->sendotp($password,$username,'GoGroup Password:');
        		
        		$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Please check your email"
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
        	}else{
        		$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Email does not exits',
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
        	}
        }else{
    		$response[$this->config->item('rest_status_field_name')] = false;
            $response[$this->config->item('rest_message_field_name')] =  $this->form_validation->error_array();
            $this->response($response, REST_Controller::HTTP_OK);
    	}
	}
}

