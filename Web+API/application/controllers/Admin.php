<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('groupModel');
		$this->load->model('AdminModel');
		$this->load->model('EmailModel');
		$this->load->library('email'); 
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index(){
		if(!isset($_SESSION['user_name']))
		{
			$this->load->view('login');
		}

		else
		{
			redirect('admin/home');
		}

		
	}

	public function admin_login_check()
	{
		$data=$this->input->post();
		//print_r($data);die;

		$result=$this->AdminModel->admin_login_check($data);
		//$this->session->set_userdata($result);

		//print_r($result->user_name);die;
		$_SESSION['user_name']=$result->user_name;
		

		if(count($result)>0)
		{
			//print_r($result);die;
			redirect('/admin/home',$_SESSION['user_name']);
			//$this->home();
			
		}
		else
		{
			 $this->session->set_flashdata('message','Username or Password is wrong'); 
			
			redirect('/admin/index',$message);
		}


	}


	public function home(){

		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

		$total_count_sellers = $this->AdminModel->get_total_count_sellers();
		$total_count_users = $this->AdminModel->get_total_count_users();
		$total_count_ads = $this->AdminModel->get_total_count_ads();
		$pendingSellers = $this->AdminModel->get_pending_approval_sellers();
		$pendingAdvertisements = $this->AdminModel->get_pending_approval_ads();
		$pendingGroups = $this->AdminModel->get_pending_approval_groups();
		$users = $this->groupModel->get_active_users();

		//print_r($users);die;

		
		$this->load->view('index',array('sellers'=>$pendingSellers,'advertisements'=> $pendingAdvertisements, 'groups' => $pendingGroups,'seller_count'=>$total_count_sellers,'users_count'=>$total_count_users, 'ads_count'=>$total_count_ads,'users'=>$users));
	}

	public function get_pending_sellers_details($user_id){

		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}


		$details = $this->AdminModel->get_pending_sellers_detail($user_id);

		echo json_encode($details);
	}

	public function approve_seller_request($user_id){

		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

		$result = $this->AdminModel->change_approve_status($user_id);

		if($result){
			$sendEmail =  $this->EmailModel->send_email_change_seller_approv_status($user_id);
			if($sendEmail){
				echo json_encode(array('status'=> $result, 'message' => 'Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Seller not Approved Successfully'));
		}
	}

	public function reject_seller_request()
	{
			if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

			$data=$this->input->post();

		$user_id = $this->input->post('seller_id');
		$data['seller_id']=$user_id;
			//print_r($data);die;
		$result = $this->AdminModel->change_reject_status($user_id);

		if($result){
			$sendEmail =  $this->EmailModel->send_email_change_seller_reject_status($data);
			if($sendEmail){
				echo json_encode(array('status'=> $result, 'message' => 'Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Seller not Rejected Successfully'));
		}

	}

	public function get_advertisement_details_id($adv_id){
			if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}


		$result = $this->AdminModel->get_adv_details_id($adv_id);

		if($result){
			echo json_encode($result);
		}else{
			return false;
		}
		
	}

	public function approve_adv_request($adv_id){
			if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

		$seller_id = $this->input->post('seller_id');
		
		$result = $this->AdminModel->change_adv_approve_status($adv_id,$seller_id);


		if($result){

			$sendEmail =  $this->EmailModel->send_email_change_adv_approv_status($seller_id);	

			$advertisement_detail = $this->AdminModel->get_adv_details_id($adv_id);

$msg_body=array(
                    'advertisement_id'=> $adv_id, 
                    'type'=>'seller',
                    'notificationType'=>'offer',
                    'category_id'    =>   $advertisement_detail[0]->category_id,
                    'user_id'=>      $seller_id ,            
                    'title'   =>'GoGroup', 
                    'description'=> "Your Advertisement ".$advertisement_detail[0]->advertisement_name." has been approved by admin"
                           
                                       );

			$this->EmailModel->send_push_notification($seller_id,$msg_body);



			if($sendEmail){
				echo json_encode(array('status'=> $result, 'message' => 'Advertisement Approved and Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Advertisement not Approved Successfully'));
		}

		// if($result){
		// 	echo json_encode(array('status'=> $result, 'message' => 'Advertisement Approved Successfully'));
		// }else{
		// 	echo json_encode(array('status'=> 'false', 'message' => 'Advertisement not Approved Successfully'));
		// }
	}


	public function reject_adv_request(){
			if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}
		
		$data=$this->input->post();
		$seller_id = $this->input->post('seller_id');
		
		$result = $this->AdminModel->change_adv_reject_status($this->input->post(),$seller_id);


		if($result){
			$sendEmail =  $this->EmailModel->send_email_change_adv_reject_status($seller_id,$data);

			$advertisement_detail = $this->AdminModel->get_adv_details_id($this->input->post('advertisement_id'));

			//Your ad 'ad title goes here' has been disapproved by GoGroup admin due to 'reason being entered by admin in web'. 


			$msg_body=array(
                    'advertisement_id'=> $this->input->post('advertisement_id'), 
                    'type'=>'seller',
                    'notificationType'=>'offer',
                    'category_id'    =>   $advertisement_detail[0]->category_id,
                    'user_id'=>      $seller_id ,            
                    'title'   =>'GoGroup', 
                    'description'=> "Your Advertisement ".$advertisement_detail[0]->advertisement_name."has been disapproved by GoGroup admin due to".$data['reason']
                           
                                       );

			$this->EmailModel->send_push_notification($seller_id,$msg_body);


			if($sendEmail){

				echo json_encode(array('status'=> $result, 'message' => 'Advertisement Rejected and Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Advertisement not Rejected Successfully'));
		}


		// if($result){
		// 	echo json_encode(array('status'=> $result, 'message' => 'Advertisement Rejected Successfully'));
		// }else{
		// 	echo json_encode(array('status'=> 'false', 'message' => 'Advertisement not Rejected Successfully'));
		// }
	}


	public function get_group_details_id($group_id){
		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

		$result = $this->AdminModel->get_group_details_id($group_id);
		$result['total_joined_memebers']=$this->AdminModel->get_joined_members_count_by_group($group_id);
		
		if($result){
			echo json_encode($result);
		}else{
			return false;
		}
	}

	public function group_update(){

		$data = $this->input->post();

		//print_r($data);die;

		if(empty($_FILES['group_image']['name']))
		{
			$newfile_name=$data['profile_img'];
		}

		else
		{
	        $file_name=$_FILES['group_image']['name'];
			$file_size=$_FILES['group_image']['size'];
			$file_tmp=$_FILES['group_image']['tmp_name'];
			$file_type=$_FILES['group_image']['type'];
			$array = explode('.', $file_name);
			$file_ext = end( $array); 

			 $expensions= array("jpeg","jpg","png");

			if(in_array($file_ext,$expensions)=== false){
	        	 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
	     		 }
	      
	   		if($file_size > 2097152){
	         	$errors[]='File size must be excately 2 MB';
	      	}

	      $newfile_name = time().$file_name;
	     
	       if(empty($errors)==true){
	         move_uploaded_file($file_tmp,"./groupImages/".$newfile_name);
	         echo "Success";
	      }else{
	         print_r($errors);
	      }
	  }
		$result = $this->groupModel->update_details($data,$newfile_name);


		if($result){
				$this->session->set_flashdata('message','Group updated Successfully'); 
				 redirect('/Admin/home');
	
		}else{
				$this->session->set_flashdata('message','Some error occur while approved the group request'); 
				 redirect('/Admin/home');
	
			
		}

	}

	public function edit_group_image($group_id)
	{
		 $file_name=$_FILES['file']['name'];
		$file_size=$_FILES['file']['size'];
		$file_tmp=$_FILES['file']['tmp_name'];
		$file_type=$_FILES['file']['type'];

		$array = explode('.', $file_name);
		$file_ext = end( $array); 

		 $expensions= array("jpeg","jpg","png");

		  if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     		 }

		 if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
     	 }

      $newfile_name = time().$file_name;
     
       if(empty($errors)==true)
       {
         move_uploaded_file($file_tmp,"./groupImages/".$newfile_name);
         $result = $this->AdminModel->edit_group_image($group_id,$newfile_name);
        echo json_encode(array('status'=> true, 'message' => 'Group Image Updated Successfully'));
       }
       else
       {
         echo json_encode(array('status'=> 'false', 'message' => $errors));
       }

      



		
	}

	public function approve_group_request($group_id){
			if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

		$user_id = $this->input->post('user_id');
		$result = $this->AdminModel->change_group_approve_status($group_id,$user_id);

		if($result){

			$groupdetails = $this->AdminModel->get_group_info($group_id);
			
			$sendEmail =  $this->EmailModel->send_email_change_group_approv_status($user_id,$groupdetails->group_name);

			


			$msg_body=array(
                    'group_id'=> $group_id, 
                    'type'=>'user',
                    'notificationType'=>'interest',
                    'category_id'    =>   $groupdetails->category_id,
                    'user_id'=>      $user_id ,            
                    'description'   =>"You interest". $groupdetails->group_name ."has been approve by GoGroup Admin", 
                    'title'=> "GoGroup"
                           
                                       );

			$this->EmailModel->send_push_notification($user_id,$msg_body);


			if($sendEmail){
			
				echo json_encode(array('status'=> $result, 'message' => 'Group Approved and Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Group not Approved Successfully'));
		}

		// if($result){
		// 	echo json_encode(array('status'=> $result, 'message' => 'Group Approved Successfully'));
		// }else{
		// 	echo json_encode(array('status'=> 'false', 'message' => 'Group not Approved Successfully'));
		// }
	}

	

	public function reject_group_request(){
		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

		$data=$this->input->post();
		$user_id = $this->input->post('user_id');
	
		$result = $this->AdminModel->change_group_reject_status($this->input->post(),$user_id);


		if($result){
			$groupdetails = $this->AdminModel->get_group_info($this->input->post('group_id'));

			$sendEmail =  $this->EmailModel->send_email_change_group_reject_status($user_id,$data);

			


			$msg_body=array(
                    'group_id'=> $this->input->post('group_id'), 
                    'type'=>'user',
                    'notificationType'=>'interest',
                    'category_id'    =>   $groupdetails->category_id,
                    'user_id'=>      $user_id ,            
                    'description'=>"You interest". $groupdetails->group_name ."has been disapprove by GoGroup Admin due to".$data['reason'], 
                    'title'=> "GoGroup"
                                              
                       );

			$this->EmailModel->send_push_notification($user_id,$msg_body);


			
			if($sendEmail){
			
				echo json_encode(array('status'=> $result, 'message' => 'Group Rejected and Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Group not Rejected Successfully'));
		}

		// if($result){
		// 	echo json_encode(array('status'=> $result, 'message' => 'Group Rejected Successfully'));
		// }else{
		// 	echo json_encode(array('status'=> 'false', 'message' => 'Group not Rejected Successfully'));
		// }
	}


	public function get_user_deatils($user_id){
			if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

		$result = $this->AdminModel->get_user_detail_by($user_id);

		if($result){
			echo json_encode($result);
		}else{
			return false;
		}
	}

	public function get_all_banners()
	{
		$banners = $this->AdminModel->get_banners();
		$this->load->view('banners',array('banners'=>$banners));
	}

	public function delete_banner($banner_id)
	{
		$result = $this->AdminModel->delete_banner($banner_id);

		if($result){
			$this->session->set_flashdata('message','Banner deleted Successfully'); 
			redirect('Admin/get_all_banners');
		}else{
			$this->session->set_flashdata('message','Some error occur while approved the delete request'); 
				redirect('Admin/get_all_banners');
			
		}		
	}

	public function banner_insert()
	{

		$file_name=$_FILES['banner_image']['name'];
		$file_size=$_FILES['banner_image']['size'];
		$file_tmp=$_FILES['banner_image']['tmp_name'];
		$file_type=$_FILES['banner_image']['type'];
		$array = explode('.', $file_name);
		$file_ext = end( $array); 

		 $expensions= array("jpeg","jpg","png");

		  if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     		 }
	      
	     

	      $newfile_name = time().$file_name;
	     
	       if(empty($errors)==true)
	       {
	         move_uploaded_file($file_tmp,"./bannerImage/".$newfile_name);
	        
	       }
	       else
	       {
	         $this->session->set_flashdata('message','Extension not allowed, please choose a JPEG or PNG file'); 
				redirect('Admin/get_all_banners');
	       }

		$result = $this->AdminModel->insert_banner($newfile_name);

		if($result){
			$this->session->set_flashdata('message','Banner Inserted Successfully'); 
			redirect('Admin/get_all_banners');
		}else{
			$this->session->set_flashdata('message','Some error occur while approved the insert request'); 
				redirect('Admin/get_all_banners');
			
		}

	}

	public function logout()
	{
		session_destroy(); 
		redirect('admin/index');
	}
	

}
