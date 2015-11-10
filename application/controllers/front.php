<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('_header');
        $this->load->view('front/front');
        $this->load->view('_footer');
	}
    public function login()
	{
		$this->load->view('_header');
        $this->load->view('front/login');
        $this->load->view('_footer');
	}
    public function dashboard()
	{
		$this->load->view('_header');
        $this->load->view('front/dashboard');
        $this->load->view('_footer');
	}
    public function application()
	{
		$this->load->view('_header');
        $this->load->view('front/application');
        $this->load->view('_footer');
	}
    public function gallery()
	{
		$this->load->view('_header');
        $this->load->view('front/gallery');
        $this->load->view('_footer');
	}
    public function developper(){
    	$this->load->view('_header');
        $this->load->view('front/developper');
        $this->load->view('_footer');
	}
    public function play(){
    	$this->load->view('_header');
        $this->load->view('front/play');
        $this->load->view('_footer');
	}
    public function how_to_use(){
    	$this->load->view('_header');
        $this->load->view('front/how_to_use');
        $this->load->view('_footer');
	}
    public function ideas_box(){
    	$this->load->view('_header');
        $this->load->view('front/ideas_box');
        $this->load->view('_footer');
	}
    public function concept(){
    	$this->load->view('_header');
        $this->load->view('front/concept');
        $this->load->view('_footer');
	}
}
