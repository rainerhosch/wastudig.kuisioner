<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perwalian extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			redirect(base_url());
		} else {
			$this->load->view('mhs/perwalian');
		}
	}
}
