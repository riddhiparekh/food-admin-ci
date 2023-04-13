<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * OrderProcedure Class
 *
 * @package		orders
 * @subpackage	Order Process
 * @category	Libraries
 * @author		Hiren Faldu
 */
class OrderProcedure {

	function assign($inputs)
	{
		$response = [
			'status' => false
		];
		if(!array_key_exists('assignee', $inputs) || !$inputs['assignee']) {
			$response['msg'] = 'Please select delivery boy to assign order(s)!';
			return $response;
		}
		$assignee = $inputs['assignee'];
		if(!array_key_exists('orders', $inputs) || !is_array($inputs['orders']) || !count($inputs['orders'])) {
			$response['msg'] = 'Please select orders to update status!';
			return $response;
		}

		$orders = $inputs['orders'];
		Order::whereIn('id', $orders)->update([
			'delivery_boy_id' => $assignee,
			'order_status' => 'assigned'
		]);
		return [
			'status' => true,
			'msg' => 'Orders have been assigned to delivery boy!'
		];
	}

	function reject($inputs)
	{
		$response = [
			'status' => false
		];
		if(!array_key_exists('orders', $inputs) || !is_array($inputs['orders']) || !count($inputs['orders'])) {
			$response['msg'] = 'Please select orders to reject!';
			return $response;
		}

		$orders = $inputs['orders'];
		Order::whereIn('id', $orders)->update([
			'order_status' => 'rejected',
			'delivery_boy_id' => 0
		]);
		return [
			'status' => true,
			'msg' => 'Orders have been rejected!'
		];
	}

	function pickup($inputs)
	{
		$response = [
			'status' => false
		];
		if(!array_key_exists('orders', $inputs) || !is_array($inputs['orders']) || !count($inputs['orders'])) {
			$response['msg'] = 'Please select orders to pickup!';
			return $response;
		}
		$orders = $inputs['orders'];

		Order::whereIn('id', $orders)->update([
			'order_status' => 'ready_to_pick'
		]);
		return [
			'status' => true,
			'msg' => 'Orders have been prepared for pickup!'
		];

	}

	function ship($inputs)
	{
		$response = [
			'status' => false
		];
		if(!array_key_exists('orders', $inputs) || !is_array($inputs['orders']) || !count($inputs['orders'])) {
			$response['msg'] = 'Please select orders to ship!';
			return $response;
		}

		$orders = $inputs['orders'];
		Order::whereIn('id', $orders)->update([
			'order_status' => 'shipped'
		]);
		return [
			'status' => true,
			'msg' => 'Orders are out for delivery!'
		];
	}

	function complete($inputs)
	{
		$response = [
			'status' => false
		];
		if(!array_key_exists('orders', $inputs) || !is_array($inputs['orders']) || !count($inputs['orders'])) {
			$response['msg'] = 'Please select orders to complete!';
			return $response;
		}

		$orders = $inputs['orders'];
		Order::whereIn('id', $orders)->update([
			'order_status' => 'delivered'
		]);
		return [
			'status' => true,
			'msg' => 'Orders are completed!'
		];
	}
}