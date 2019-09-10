<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('advertisementModel');
		$this->load->model('EmailModel');
		$this->load->helper('url');
		$this->load->library('session');

		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

	}

	public function home(){
		$advertisements = array();
		$users = $this->advertisementModel->get_active_users();
		$categories = $this->advertisementModel->get_all_categories();
		if(!empty($_GET['search'])){

			$search = $_GET['search'];
			 	$data = $this->input->post();

			 $advertisements = $this->advertisementModel->get_active_ads($user_id=null,$data,$search);

		}
		
		else if(!empty($_GET['id'])){

				$user_id = $_GET['id'];
				$advertisements = $this->advertisementModel->get_active_ads($user_id,$data=null,$serach=null);
		}else{


			$advertisements = $this->advertisementModel->get_active_ads($user_id = null,$data =null,$search=null);
		}
		
		$this->load->view('advertisements',array('advertisements' => $advertisements,'users' => $users, 'categories' => $categories));
	}

	public function reject_reason(){
		$data = $this->input->post();
			$dataresult = $this->advertisementModel->change_adv_reject_status($data);

			if($dataresult){
				
					echo json_encode(array('status'=> $dataresult, 'message' => 'Advertisement Rejected Successfully'));
				
				
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Advertisement not Rejected Successfully'));
			}
		
	}

	public function approve_advise_request($adv_id){

		$seller_id= $this->input->post('seller_id'); 

		$result = $this->advertisementModel->change_adv_approve_status($adv_id,$seller_id);
		if($result){
			echo json_encode(array('status'=> $result, 'message' => 'Advertisement Approved Successfully'));
			//echo json_encode(array('status'=> $result, 'message' => 'Advertisement Approved Successfully'));
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Advertisement not Approved Successfully'));
		}
	} 

	public function get_advertisement_details_id($adv_id){

		$result = $this->advertisementModel->get_adv_details_id($adv_id);
		$result['total_views']=$this->advertisementModel->get_total_views_by_adv($adv_id);

		if($result)
		{
			echo json_encode($result);
		}
		else
		{
			return false;
		}
		
	}
 
	public function sub_categories(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->advertisementModel->get_sub_category($category_id);
		echo json_encode($subcategories);
	}

	public function sub_categories2(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->advertisementModel->get_sub_category2($category_id);
		echo json_encode($subcategories);
	}

	public function sub_categories3(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->advertisementModel->get_sub_category3($category_id);
		echo json_encode($subcategories);
	}

	public function sub_categories4(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->advertisementModel->get_sub_category4($category_id);
		echo json_encode($subcategories);
	}
	public function sub_categories5(){
		$category_id = $this->input->post('categoryId');
		$subcategories = $this->advertisementModel->get_sub_category5($category_id);
		echo json_encode($subcategories);
	}


	public function reject_adv_request($adv_id){
		$seller_id= $this->input->post('seller_id'); 
		$result = $this->advertisementModel->change_adv_reject_status($adv_id,$seller_id);

		if($result){
			$sendEmail =  $this->EmailModel->send_email_change_adv_reject_status($seller_id);
			if($sendEmail){
				echo json_encode(array('status'=> $result, 'message' => 'Advertisement Rejected  and Email Sent Successfully'));
			}else{
				echo json_encode(array('status'=> 'false', 'message' => 'Email not Sent Successfully'));
			}
			//echo json_encode(array('status'=> $result, 'message' => 'Advertisement Rejected Successfully'));
		}else{
			echo json_encode(array('status'=> 'false', 'message' => 'Advertisement not Rejected Successfully'));
		}
	}

	public function delete($id){

		$result = $this->advertisementModel->delete_advertisement($id);
		if($result){
			redirect('advertisement/home');
		}else{
			echo "Not deleted";
		}
	}

	public function insert(){
		$data = $this->input->post();

		$result = $this->advertisementModel->add_details($data);

		if($result)
		{
		
				for($i=0; $i<count($_FILES['ads_image']['name']);$i++)
				{

					$file_name=$_FILES['ads_image']['name'][$i];
					$file_size=$_FILES['ads_image']['size'][$i];
					$file_tmp=$_FILES['ads_image']['tmp_name'][$i];
					$file_type=$_FILES['ads_image']['type'][$i];
					$array = explode('.', $file_name);
					$file_ext = end( $array); 
					$newfile_name = time().$file_name;


					 move_uploaded_file($file_tmp,"./advertisementImages/".$newfile_name);

					 
			         $result1 = $this->advertisementModel->add_image_details($result['adv_id'],$result['created_by'],$newfile_name);
				}
				
					$this->session->set_flashdata('message','Advertisment added Successfully'); 
				 	redirect('/Advertisement/home');	
				
		}

		else
		{
			$this->session->set_flashdata('message','Some error occur while approved the advertisement request'); 
			redirect('/Advertisement/home');	
		}

		}


		// if($result){
		// 	echo json_encode(array('result'=>$result, 'message'=>'Advertisement added Successfully'));
		// }else{
		// 	echo json_encode(array('result'=>$result, 'message'=>'Advertisement not added Successfully'));
		// }
	

	public function add_details($data){

		$adData = array('category_id' => $data['categories'],
						'subcategory_id' => $data['sub_categories'],
						'advertisement_details' => $data['ads_description'],
						'HistoryOfChange' => $data['history'],
						'user_count' => $data['user_count'],
						'start_date' => $data['start_date'],
						'end_date' => $data['end_date'],
						'createdby_userid' => $data['users'],
						'status' =>'approved',
						'is_approved' => 1
						);

		return $this->db->insert('advertisements',$adData);

	}

public function update()
	{
		$data = $this->input->post();
		// 	print_r($_FILES);
		// print_r($data);die;


		$result = $this->advertisementModel->update_details($data);
		if($result)
		{
			$this->session->set_flashdata('message','Advertisment Updated Successfully'); 
		 		 	redirect('/Advertisement/home');	
		}
		else
		{
				$this->session->set_flashdata('message','Some error occur while updating the advertisement request'); 
		     	redirect('/Advertisement/home');	

		}


		// if($result)
		// {
		
		// 		for($i=0; $i<count($_FILES['ads_image']['name']);$i++)
		// 		{

		// 			$file_name=$_FILES['ads_image']['name'][$i];
		// 			$file_size=$_FILES['ads_image']['size'][$i];
		// 			$file_tmp=$_FILES['ads_image']['tmp_name'][$i];
		// 			$file_type=$_FILES['ads_image']['type'][$i];
		// 			$array = explode('.', $file_name);
		// 			$file_ext = end( $array); 
		// 			$newfile_name = time().$file_name;


		// 			 move_uploaded_file($file_tmp,"./advertisementImages/".$newfile_name);

					 
		// 	         $result1 = $this->advertisementModel->update_image_details($result['adv_id'],$result['created_by'],$newfile_name);
		// 		}
				
		// 			$this->session->set_flashdata('message','Advertisment Updated Successfully'); 
		// 		 	redirect('/Advertisement/home');	
				
		// }

		// else
		// {
		// 	$this->session->set_flashdata('message','Some error occur while updating the advertisement request'); 
		// 	redirect('/Advertisement/home');	
		// }

		}

}