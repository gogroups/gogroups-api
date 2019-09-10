<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CouponCodeModel extends CI_Model {

	public function get_coupon_codes(){


		$result = $this->db->select('coupons.*,seller.name as seller_name,buyer.name as buyer_name,seller.lastName as seller_lastName,buyer.lastName as buyer_lastName,advertisements.advertisement_id,advertisements.advertisement_name')
		 				   ->join('users as seller','coupons.seller_id = seller.user_id','left')
		 				   ->join('users as buyer','coupons.buyer_id = buyer.user_id','left')
				   		   ->join('advertisements','coupons.advertisement_id = advertisements.advertisement_id')
						   ->get('coupons')
						   ->result();
		
		return $result;
	}

	public function update_remarks($coupon_id,$remarks)
	{
		$remarks = trim($remarks)?trim($remarks):null;
		
		
		$data = array(
			'remarks' => $remarks,
			);
		
		return $this->db->where('coupon_id',$coupon_id)
						->update('coupons',$data);
		
		
	}
}

	?>