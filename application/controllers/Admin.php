<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function index()
	{
		$get_data = callAPI('GET', 'https://api.example.com/get_url/'.$user['User']['customer_id'], false);
		$response = json_decode($get_data, true);
		$errors = $response['response']['errors'];
		$data = $response['response']['data'][0];

		exit;

		$data['title'] = "Admin Panel";

		$this->load->view('backend/template/header', $data);
		$this->load->view('backend/dashboard');
		$this->load->view('backend/template/footer');
	}
}
