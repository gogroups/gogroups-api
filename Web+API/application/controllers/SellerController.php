<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SellerController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('SellerControllerModel');
		$this->load->model('AdminModel');
		$this->load->model('EmailModel');
		$this->load->library('encryption');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->config('jwt');

		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}
	}
	
	public function home(){

		$data = $this->SellerControllerModel->get_active_sellers();
		$this->load->view('sellerAccount',array('sellerdata' => $data));
	}

	public function insert(){
		
		$data = $this->input->post();

		//print_r($_FILES);die;
		//$seller_image = $this->input->post('seller_image');


        $file_name=$_FILES['seller_image']['name'];
		$file_size=$_FILES['seller_image']['size'];
		$file_tmp=$_FILES['seller_image']['tmp_name'];
		$file_type=$_FILES['seller_image']['type'];
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
         echo "Success";
      }else{
         print_r($errors);
      }
		
		$result = $this->SellerControllerModel->insertSeller($data,$newfile_name);
		//print_r($result);die;
	
		if($result==1)
		{
			$this->session->set_flashdata('message','Seller added Successfully'); 
			redirect('/SellerController/home');	
		}
		elseif($result==2)
		{
			$this->session->set_flashdata('message','Email and contact_number are already registered!'); 
			redirect('/SellerController/home');	
		}
		elseif($result==3)
		{
			$this->session->set_flashdata('message','Email is already registered!'); 
			redirect('/SellerController/home');	
		}
		elseif($result==4)
		{
			$this->session->set_flashdata('message','Contact Number is already registered!'); 
			redirect('/SellerController/home');	
		}
		else{
			$this->session->set_flashdata('message','Some error occur while approved the seller request'); 
				redirect('/SellerController/home');	
			//echo json_encode(array('result'=>$result, 'message'=>'Seller not added Successfully'));
		}

	}

	public function update()
	{
		
		$data = $this->input->post();
		//print_r($data);die;

		if(empty($_FILES['seller_image']['name']))
		{
			$newfile_name=$data['profile_img'];
		}

		else
		{
	        $file_name=$_FILES['seller_image']['name'];
			$file_size=$_FILES['seller_image']['size'];
			$file_tmp=$_FILES['seller_image']['tmp_name'];
			$file_type=$_FILES['seller_image']['type'];
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
	         // echo "Success";
	      }else{
	         print_r($errors);
	      }
		}

		
		$result = $this->SellerControllerModel->updateSeller($data,$newfile_name);
	
		if($result){
			$this->session->set_flashdata('message','Seller Updated Successfully'); 
			redirect('/SellerController/home');	
		}else{
			$this->session->set_flashdata('message','Some error occur while approved the seller request'); 
				redirect('/SellerController/home');	
			//echo json_encode(array('result'=>$result, 'message'=>'Seller not added Successfully'));
		}

	}

	public function getSellerDetails($user_id){
		$result = $this->SellerControllerModel->getSellerDetails($user_id);

		if($result){
			echo json_encode($result);
		}else{
			return false;
		}
	}

	// public function editSellerDetails($user_id){
	// 	$result = $this->SellerControllerModel->getSellerDetails($user_id);

	// 	if($result){
	// 		echo json_encode($result);
	// 	}else{
	// 		return false;
	// 	}
	// }

	public function reject_reason(){
		$data = $this->input->post();
		$result = $this->SellerControllerModel->addReason($data);
		if($result){
			$reasonresult = $this->AdminModel->change_reject_status($data['seller_id']);

			if($reasonresult){
				$sendEmail =  $this->EmailModel->send_email_change_seller_reject_status($data);
				if($sendEmail){
					echo json_encode(array('status'=> $result, 'message' => 'Email Sent Successfully'));
				}else{
					echo json_encode(array('status'=> 'false', 'message' => 'Email not sent Successfully'));
				}
				//echo json_encode(array('status'=> $result, 'message' => 'Seller Rejected Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Seller not Rejected Successfully'));
			}
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Seller not Rejected Successfully'));
		}
	}


	public function delete($id){
		$this->load->model('SellerControllerModel');

		$result = $this->SellerControllerModel->delete_seller($id);
		if($result){
			redirect('sellerController/home');
		}else{
			redirect('sellerController/home');
		}
	}


	

}
