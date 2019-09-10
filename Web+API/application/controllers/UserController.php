<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('userModel');
		$this->load->model('AdminModel');
		$this->load->model('EmailModel');
		$this->load->helper('url');
		$this->load->library('session');
		
		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}
	}


	public function home(){

		
		$data = $this->userModel->get_active_users();

		$this->load->view('userAccount',array('users'=>$data));
	}

	public function insert(){

		$data = $this->input->post();
		//print_r($_FILES);die;
		//$seller_image = $this->input->post('seller_image');


        $file_name=$_FILES['user_image']['name'];
		$file_size=$_FILES['user_image']['size'];
		$file_tmp=$_FILES['user_image']['tmp_name'];
		$file_type=$_FILES['user_image']['type'];
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
         move_uploaded_file($file_tmp,"./userImages/".$newfile_name);
         
      }else{
         print_r($errors);
      }
		

		// $data = $this->input->post();
      $result = $this->userModel->insertUser($data,$newfile_name);
	


		if($result==1){
				$this->session->set_flashdata('message','User added Successfully'); 
				redirect('/UserController/home');
		}
		elseif($result==2)
		{
			$this->session->set_flashdata('message','Email and contact_number are already registered!'); 
			redirect('/UserController/home');	
		}
		elseif($result==3)
		{
			$this->session->set_flashdata('message','Email is already registered!'); 
			redirect('/UserController/home');	
		}
		elseif($result==4)
		{
			$this->session->set_flashdata('message','Contact Number is already registered!'); 
			redirect('/UserController/home');	
		}
		else{
				$this->session->set_flashdata('message','Some error occur while approved the user request'); 
				redirect('/UserController/home');	
			//echo json_encode(array('result'=>$result, 'message'=>'User not added Successfully'));
		}

	}

	public function update()
	{
		
		$data = $this->input->post();
		//print_r($data);die;

		if(empty($_FILES['user_image']['name']))
		{
			$newfile_name=$data['profile_img'];
		}

		else
		{
	       	$file_name=$_FILES['user_image']['name'];
			$file_size=$_FILES['user_image']['size'];
			$file_tmp=$_FILES['user_image']['tmp_name'];
			$file_type=$_FILES['user_image']['type'];
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
		         move_uploaded_file($file_tmp,"./userImages/".$newfile_name);
		         
		      }else{
		         print_r($errors);
		      }
		
		}

		//echo $newfile_name;die;

		
		$result = $this->userModel->updateUser($data,$newfile_name);
	
		if($result){
			$this->session->set_flashdata('message','User Updated Successfully'); 
			redirect('/UserController/home');	
		}else{
			$this->session->set_flashdata('message','Some error occur while approved the user request'); 
				redirect('/UserController/home');	
			//echo json_encode(array('result'=>$result, 'message'=>'Seller not added Successfully'));
		}

	}


	public function getUserDetails($user_id){
		$result = $this->userModel->getUserDetails($user_id);

		if($result){
			echo json_encode($result);
		}else{
			return false;
		}
	}

	public function delete($id){

		$result = $this->userModel->delete_user($id);
		if($result){
			redirect('UserController/home');
		}else{
			echo "Not deleted";
		}
	}

	public function approve_user_request($user_id){
		$result = $this->userModel->change_approve_status($user_id);

		if($result){
			$sendEmail =  $this->EmailModel->send_email_change_seller_approv_status($user_id);
			if($sendEmail){
				echo json_encode(array('status'=> $result, 'message' => 'User Accepted and Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Userr not Approved Successfully'));
		}


	}

	public function reject_user_request($user_id){
		$result = $this->userModel->change_reject_status($user_id);

		if($result){

			echo json_encode(array('status'=> $result, 'message' => 'User Rejected Successfully'));
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'User not Rejected Successfully'));
		}

	}

	public function reject_reason(){
		$data = $this->input->post();
		$result = $this->userModel->addReason($data);
		if($result){
			$reasonresult = $this->AdminModel->change_reject_status($data['user_id']);

			if($reasonresult){
				$sendEmail =  $this->EmailModel->send_email_change_user_reject_status($data['user_id'],$data);
					if($sendEmail){
					echo json_encode(array('status'=> $result, 'message' => 'User Rejected and Email Sent Successfully'));
				}else{
					echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
				}
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'User not Rejected Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'User not Rejected Successfully'));
		}
	}


	

}
