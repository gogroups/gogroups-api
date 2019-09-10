<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('categoryModel');
		$this->load->library('session');
		
	if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}
	}

	public function home(){
			$categories = $this->categoryModel->get_categories();
			$subcategories = $this->categoryModel->get_sub_categories();
			$subcategories2 = $this->categoryModel->get_subcategories_2();
			$subcategories3 = $this->categoryModel->get_subcategories_3();
			$subcategories4 = $this->categoryModel->get_subcategories_4();
			$all_category_data=$this->categoryModel->Get_all_category_data();
			$this->load->view('categories',array('categories' => $categories,'subcatgories'=>$subcategories,'subcatgories2'=>$subcategories2,'subcatgories3'=>$subcategories3,'subcatgories4'=>$subcategories4,'all_category_data'=>$all_category_data));
	}

	public function add(){
		$data = $this->input->post();



		if(!empty($_FILES['category_image']['name'])) {

		$file_name=$_FILES['category_image']['name'];
		$file_size=$_FILES['category_image']['size'];
		$file_tmp=$_FILES['category_image']['tmp_name'];
		$file_type=$_FILES['category_image']['type'];
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
       move_uploaded_file($file_tmp,"./CategoryImages/".$newfile_name);

         echo "Success";
      }else{
         print_r($errors);
      }
}
else
		{
				$newfile_name ="dummy.jpg";
		}



		
		$result = $this->categoryModel->insert($data,$newfile_name);
		if($result){
			$this->session->set_flashdata('message','Category added Successfully'); 
			redirect('/Category/home');	
		}else{
			$this->session->set_flashdata('message','Some error occur while approved the category request'); 
				redirect('/Category/home');	
			//echo json_encode(array('result'=>$result, 'message'=>'Seller not added Successfully'));
		}

		

		// if($result){
		// 	echo json_encode(array('status'=>$result, 'message'=>'Category added Successfully'));
		// }else{
		// 	echo json_encode(array('status'=>$result, 'message'=>'Category not added Successfully'));
		// }
	}

	public function getcategory_by_id($id){
		$result = $this->categoryModel->get_category_id($id);

		if($result){
			echo json_encode($result);
		}
	}

	public function updateCategory(){
		$data = $this->input->post();
		 $file_name=$_FILES['category_image1']['name'];
		$file_size=$_FILES['category_image1']['size'];
		$file_tmp=$_FILES['category_image1']['tmp_name'];
		$file_type=$_FILES['category_image1']['type'];
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
       move_uploaded_file($file_tmp,"./CategoryImages/".$newfile_name);

         echo "Success";
      }else{
         print_r($errors);
      }
		$result = $this->categoryModel->update_category($data,$newfile_name);

		//$result = $this->categoryModel->insert($data,$newfile_name);
		if($result){
			$this->session->set_flashdata('message','Category updated Successfully'); 
			redirect('/Category/home');	
		}else{
			$this->session->set_flashdata('message','Some error occur while updating the category request'); 
				redirect('/Category/home');	}
		// if($result){
		// 	echo json_encode(array('status'=>$result, 'message'=>'Category updated Successfully'));
		// }else{
		// 	echo json_encode(array('status'=>$result, 'message'=>'Category not updated Successfully'));
		// }
	}

	public function subcategories($category_id){
		//  $data = $this->input->post();
		//$cat_name=$data['cat_name'];
		//echo $cat_name;die;
		$result = $this->categoryModel->get_subcategories($category_id);
		//$result['name']=$cat_name;

		echo json_encode($result);
	}

	public function addSubcategory(){
		$data = $this->input->post();

		//print_r($data);die;

		$result = $this->categoryModel->insert_subcategory($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory added Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory not added Successfully'));
		}
	}
	public function addSubcategory2(){
		$data = $this->input->post();

		$result = $this->categoryModel->insert_subcategory2($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory2 added Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory2 not added Successfully'));
		}
	}
	public function addSubcategory3(){
		$data = $this->input->post();

		$result = $this->categoryModel->insert_subcategory3($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory3 added Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory3 not added Successfully'));
		}
	}

	public function addSubcategory4(){
		$data = $this->input->post();

		$result = $this->categoryModel->insert_subcategory4($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory3 added Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory3 not added Successfully'));
		}
	}

	public function addSubcategory5(){
		$data = $this->input->post();

		$result = $this->categoryModel->insert_subcategory5($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory3 added Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory3 not added Successfully'));
		}
	}

	public function getsubcategory_by_id($id){
		$result = $this->categoryModel->get_subcategory_id($id);

		if($result){
			echo json_encode($result);
		}
	}

	public function getsubcategory_by_id2($id){
		$result = $this->categoryModel->get_subcategory_id2($id);

		if($result){
			echo json_encode($result);
		}
	}

	public function getsubcategory_by_id3($id){
		$result = $this->categoryModel->get_subcategory_id3($id);

		if($result){
			echo json_encode($result);
		}
	}

	public function getsubcategory_by_id4($id){
		$result = $this->categoryModel->get_subcategory_id4($id);

		if($result){
			echo json_encode($result);
		}
	}

	public function getsubcategory_by_id5($id){
		$result = $this->categoryModel->get_subcategory_id5($id);

		if($result){
			echo json_encode($result);
		}
	}

	public function updatesubCategory(){
		$data = $this->input->post();

		$result = $this->categoryModel->updatesubCategory($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory updated Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory not updated Successfully'));
		}
	}

	public function updatesubCategory2(){
		$data = $this->input->post();

		$result = $this->categoryModel->updatesubCategory2($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory2 updated Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory2 not updated Successfully'));
		}
	}
	public function updatesubCategory3(){
		$data = $this->input->post();

		$result = $this->categoryModel->updatesubCategory3($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory3 updated Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory3 not updated Successfully'));
		}
	}

	public function updatesubCategory4(){
		$data = $this->input->post();

		$result = $this->categoryModel->updatesubCategory4($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory4 updated Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory4 not updated Successfully'));
		}
	}

	public function updatesubCategory5(){
		$data = $this->input->post();

		$result = $this->categoryModel->updatesubCategory5($data);
		if($result){
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory5 updated Successfully'));
		}else{
			echo json_encode(array('status'=>$result, 'message'=>'SubCategory5 not updated Successfully'));
		}
	}

	public function subcategories2($subcategory_id){

		$result = $this->categoryModel->get_subcategories2($subcategory_id);

		if(empty($result))
		{
			//$result=array();
			$result[]=array(
				'subcategory_id'=>$subcategory_id,
				'check'=>'noValue'
			);

			
			echo json_encode($result);
		}
		else
		{
			echo json_encode($result);	
		}


		

		
	}

	public function subcategories3($subcategory_id){

		$result = $this->categoryModel->get_subcategories3($subcategory_id);

		if(empty($result))
		{
			//$result=array();
			$result[]=array(
				'subcategory_id'=>$subcategory_id,
				'check'=>'noValue'
			);

			
			echo json_encode($result);
		}
		else
		{
			echo json_encode($result);	
		}
	}

	public function subcategories4($subcategory_id){

		$result = $this->categoryModel->get_subcategories4($subcategory_id);

		if(empty($result))
		{
			//$result=array();
			$result[]=array(
				'subcategory_id'=>$subcategory_id,
				'check'=>'noValue'
			);

			
			echo json_encode($result);
		}
		else
		{
			echo json_encode($result);	
		}
	}

	public function subcategories5($subcategory_id){

		$result = $this->categoryModel->get_subcategories5($subcategory_id);

		if(empty($result))
		{
			//$result=array();
			$result[]=array(
				'subcategory_id'=>$subcategory_id,
				'check'=>'noValue'
			);

			
			echo json_encode($result);
		}
		else
		{
			echo json_encode($result);	
		}
	}
}