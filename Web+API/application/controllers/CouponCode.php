<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CouponCode extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('advertisementModel');
		$this->load->model('CouponCodeModel');
		$this->load->helper('url');
		$this->load->library('session');

		if(!isset($_SESSION['user_name']))
		{
			redirect('admin/index');
		}

	}

	public function home()
	{
		$data['coupon_codes'] = $this->CouponCodeModel->get_coupon_codes();
		
		$this->load->view('couponCodes',$data);
	}

	public function update_remarks($couponId)
	{
		$is_remarks_updated = $this->CouponCodeModel->update_remarks($couponId,$this->input->post('remarks'));

		 if($is_remarks_updated)   
        {
            echo json_encode(array('status' => true,'redirect'=>base_url('CouponCode/home')));
        }
        else
        {
            echo json_encode(array('status' => false, 'errors' => array('Something Went Wrong') ));
        }
	}


}