<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {

	public function get_categories(){
		$result = $this->db->get('categories')->result();

		return $result;
	}

	public function insert($data,$newfile_name){
		$categoryDetails = array('category_title' => $data['category_title'],'category_image'=>$newfile_name);

		return $this->db->insert('categories',$categoryDetails);
	}

	public function get_category_id($id){
		return $this->db->where('category_id',$id)->get('categories')->row();
	}

	public function update_category($data,$newfile_name){
		return $this->db->where('category_id',$data['category_id'])->update('categories',array('category_title'=>$data['category_title'],'category_image'=>$newfile_name));
	}

	public function get_subcategories($id){
		return $this->db->where('category_id',$id)->get('subcategories')->result();
	}

	public function insert_subcategory($data){
		$details = array('category_id' => $data['category_id'],
						'subcategory_title' => $data['subcategory_title']
						);

		return $this->db->insert('subcategories',$details);

	}

	public function insert_subcategory2($data){
		$details = array('subcategory_id' => $data['subcategory_id'],
						'subcategory_title2' => $data['subcategory_title2']
						);

		return $this->db->insert('subcategories2',$details);

	}

	public function insert_subcategory3($data){
		//print_r($data);die;
		$details = array('subcategory2_id' => $data['subcategory_id2'],
						'subcategory_title3' => $data['subcategory_title3']
						);

		return $this->db->insert('subcategories3',$details);

	}

	public function insert_subcategory4($data){
		$details = array('subcategory3_id' => $data['subcategory_id3'],
						'subcategory_title4' => $data['subcategory_title4']
						);

		return $this->db->insert('subcategories4',$details);

	}

	public function insert_subcategory5($data){
		//print_r($data);die;
		$details = array('subcategory4_id' => $data['subcategory_id4'],
						'subcategory_title5' => $data['subcategory_title5']
						);

		return $this->db->insert('subcategories5',$details);

	}

	public function get_subcategory_id($id){
		return $this->db->where('subcategory_id',$id)->get('subcategories')->row();


	}

	public function get_subcategory_id2($id){
		return $this->db->where('subcategory2_id',$id)->get('subcategories2')->row();


	}

	public function get_subcategory_id3($id){
		return $this->db->where('subcategory3_id',$id)->get('subcategories3')->row();


	}

	public function get_subcategory_id4($id){
		return $this->db->where('subcategory4_id',$id)->get('subcategories4')->row();


	}

	public function get_subcategory_id5($id){
		return $this->db->where('subcategory5_id',$id)->get('subcategories5')->row();


	}

	public function updatesubCategory($data){
		return $this->db->where('subcategory_id',$data['subcategory_id'])->update('subcategories',array('subcategory_title'=>$data['subcategory_title'],'category_id' =>$data['category_id']
	));
	}

	public function updatesubCategory2($data){
		return $this->db->where('subcategory2_id',$data['subcategory_id2'])->update('subcategories2',array('subcategory_title2'=>$data['subcategory_title2'],'subcategory_id' =>$data['subcategory_id_2']
	));
	}

	public function updatesubCategory3($data){
		return $this->db->where('subcategory3_id',$data['subcategory_id3'])->update('subcategories3',array('subcategory_title3' =>$data['subcategory_title3'],'subcategory2_id' =>$data['subcategory_id_3']
	));
	}

	public function updatesubCategory4($data){
		return $this->db->where('subcategory4_id',$data['subcategory_id4'])->update('subcategories4',array('subcategory_title4' =>$data['subcategory_title4'],'subcategory3_id' =>$data['subcategory_id_4']
	));
	}

	public function updatesubCategory5($data){
		return $this->db->where('subcategory5_id',$data['subcategory_id5'])->update('subcategories5',array('subcategory_title5' =>$data['subcategory_title5'],'subcategory4_id' =>$data['subcategory_id_5']
	));
	}

	public function get_subcategories2($id){
		return $this->db->where('subcategory_id',$id)->get('subcategories2')->result();
	}

	public function get_subcategories3($id){
		return $this->db->where('subcategory2_id',$id)->get('subcategories3')->result();
	}

	public function get_subcategories4($id){
		return $this->db->where('subcategory3_id',$id)->get('subcategories4')->result();
	}

	public function get_subcategories5($id){
		return $this->db->where('subcategory4_id',$id)->get('subcategories5')->result();
	}

	public function get_sub_categories(){
		return $this->db->get('subcategories')->result();
	}

	public function get_subcategories_2(){
		return $this->db->get('subcategories2')->result();
	}

	public function get_subcategories_3(){
		return $this->db->get('subcategories3')->result();
	}

	public function get_subcategories_4(){
		return $this->db->get('subcategories4')->result();
	}

	public function Get_all_category_data()
	{
		return $this->db->query('CALL Get_all_category_data()')->result();
		
	}


}