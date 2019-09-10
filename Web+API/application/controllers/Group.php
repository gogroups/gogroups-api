<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('groupModel');
		$this->load->model('EmailModel');
		$this->load->helper('url');
		$this->load->library('session');
		
		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}
	}
	

	public function home(){

		$groups = array();
		$users = $this->groupModel->get_active_users();
		$categories = $this->groupModel->get_all_categories();

		if(!empty($_GET['search'])){

			$search = $_GET['search'];
			 	$data = $this->input->post();

			 $groups = $this->groupModel->get_groups_details($user_id=null,$data,$search);

		}

		else if(!empty($_GET['id'] )){
			$user_id = $_GET['id'];
			$groups = $this->groupModel->get_groups_details($user_id,$data=null,$search=null);
		}else{
			$groups = $this->groupModel->get_groups_details($user_id = null,$data=null,$search=null);
		}


		$this->load->view('groups',array('groups'=> $groups,'users' => $users, 'categories' => $categories));
	}


	public function reject_reason(){
		$data = $this->input->post();
		$result = $this->groupModel->change_group_reject_status($data);
		if($result){
			echo json_encode(array('status'=> $result, 'message' => 'Group Rejected Successfully'));
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Group not Rejected Successfully'));
		}
	}

	public function sub_categories(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->groupModel->get_sub_category($category_id);
		echo json_encode($subcategories);
	}

	public function sub_categories2(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->groupModel->get_sub_category2($category_id);
		echo json_encode($subcategories);
	}

	public function sub_categories3(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->groupModel->get_sub_category3($category_id);
		echo json_encode($subcategories);
	}

	public function sub_categories4(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->groupModel->get_sub_category4($category_id);
		echo json_encode($subcategories);
	}
	public function sub_categories5(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->groupModel->get_sub_category5($category_id);
		echo json_encode($subcategories);
	}

	public function insert(){
		$data = $this->input->post();

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
     
       if(empty($errors)==true)
       {
         move_uploaded_file($file_tmp,"./groupImages/".$newfile_name);
         echo "Success";
       }
       else
       {
         print_r($errors);
       }

		$result = $this->groupModel->add_details($data,$newfile_name);


		if($result)
		{
				$this->session->set_flashdata('message','Group added Successfully'); 
				 redirect('/Group/home');
	
		}
		else{
				$this->session->set_flashdata('message','Some error occur while approved the group request'); 
				 redirect('/Group/home');
	
			//echo json_encode(array('result'=>$result, 'message'=>'User not added Successfully'));
		}

		

		
		// if($result){
		// 	echo json_encode(array('result'=>$result, 'message'=>'Group added Successfully'));
		// }else{
		// 	echo json_encode(array('result'=>$result, 'message'=>'Group not added Successfully'));
		// }
	}

	public function update(){

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
				 redirect('/Group/home');
	
		}else{
				$this->session->set_flashdata('message','Some error occur while approved the group request'); 
				 redirect('/Group/home');
	
			//echo json_encode(array('result'=>$result, 'message'=>'User not added Successfully'));
		}

		

		
		// if($result){
		// 	echo json_encode(array('result'=>$result, 'message'=>'Group added Successfully'));
		// }else{
		// 	echo json_encode(array('result'=>$result, 'message'=>'Group not added Successfully'));
		// }
	}

	public  function delete($id){
		$result = $this->groupModel->delete_group($id);
		if($result){
			redirect('group/home');
		}else{
			echo "Not deleted";
		}
	}

	public function approve_group_request($group_id){
		$user_id= $this->input->post('user_id'); 

		$result = $this->groupModel->change_group_approve_status($group_id,$user_id);

		if($result){
			echo json_encode(array('status'=> $result, 'message' => 'Group Approved Successfully'));
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Group not Approved Successfully'));
		}
	}

	public function reject_group_request($group_id){
		$user_id= $this->input->post('user_id'); 
		$result = $this->groupModel->change_group_reject_status($group_id,$user_id);

		if($result){
			$sendEmail =  $this->EmailModel->send_email_change_group_reject_status($user_id);
			if($sendEmail){
				echo json_encode(array('status'=> $result, 'message' => 'Group Rejected  and Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not Sent Successfully'));
			}
			//echo json_encode(array('status'=> $result, 'message' => 'Group Rejected Successfully'));
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Group not Rejected Successfully'));
		}
	}


}