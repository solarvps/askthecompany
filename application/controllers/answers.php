<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answers extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('Qa_model');
		$this->load->helper('form');
		$this->load->helper('url');

		date_default_timezone_set('America/New_York');
	}

	public function index()
	{
		$data = array();
		
		$category = $this->input->post('category');
		
		$contains = $this->input->post('contains');
		
		if (empty($category))
		{
			$selectedCategory = "All";
		}
		else
		{
			$selectedCategory = $category;
		}
		
		if ($category == 'All')
		{
			$category = "";
		}
		
		$data['answers'] = $this->Qa_model->getAnswers(array('category' => $category, 'contains' => $contains));
		$data['selectedCategory'] = $selectedCategory;
		$data['contains'] = $contains;
		
	  	$this->load->view('questions/answers', $data);
	}
	
	public function answer()
	{
		$id = $this->uri->segment(3);
		$question = $this->Qa_model->getQuestion($id);
		$answer = $this->Qa_model->getAnswerForQuestion($id);
	
		$data = array ('question' => $question, 'answer' => $answer);
	
		$this->load->view('questions/answer', $data);
	}
		
}
