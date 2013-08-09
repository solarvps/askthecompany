<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('Qa_model');
		$this->load->helper('form');
		$this->load->helper('url');

		date_default_timezone_set('America/New_York');
	
	    $this->load->library('session');
	    if ( $this->session->userdata('logged_in') == false )
	      redirect('/login');
	}

	public function index()
	{
	  $questions = $this->Qa_model->getQuestions();
	
	  $saved = $this->session->flashdata('saved');
	  $emailed = $this->session->flashdata('emailed');
		
	  $data = array('questions' => $questions, 'saved' => $saved, 'emailed' => $emailed);

	  $this->load->view('questions/list', $data);
	}
	
	function manage()
	{
		$id = $this->uri->segment(3);
		
		$question = $this->Qa_model->getQuestion($id);
		$answer = $this->Qa_model->getAnswerForQuestion($id);
		$activity = $this->Qa_model->getActivityForAnswer($id);
		
		$data = array('id' => $id, 'question' => $question, 'answer' => $answer, 'activity' => $activity);
		
		$this->load->view('questions/manage', $data);
	}
	
	function saveManageForm()
	{
		$id = $this->input->post('id');
		$category = $this->input->post('category');
		$answer = $this->input->post('answer');
		$answered = $this->input->post('answered');
		$sendEmail = $this->input->post('sendEmail');
		$sendAddress = $this->input->post('sendAddress');
		$user = $this->session->userdata('username');
		
		$this->Qa_model->updateCategory($id, $category);
		$this->Qa_model->saveAnswer($id, $answer);
		$this->Qa_model->setAnswered($id, $answered);
		
		$this->Qa_model->addActivity(array('questionId' => $id, 'user' => $user, 'action' => 'Saved'));
		
		if ($answered == 1 && $sendEmail == 1 && !empty($sendAddress))
		{
			$this->load->library('email');
			$question = $this->Qa_model->getQuestion($id);
		
		    $this->email->from('noreply@fortressitx.com', 'New Answer Alert');
		    $this->email->to($sendAddress);
		    $this->email->subject('A new question has just been answered on Ask The Company!');
		    $this->email->message("\r\n\r\nThis question was from " . $question->name  . ":\r\n\r\n" . $question->question . "\r\n\r\n" . "The answer was:\r\n\r\n" . $answer);
		     
		    if ($this->email->send())
		    {
				$this->session->set_flashdata('emailed', '1');
			
				$this->Qa_model->addActivity(array('questionId' => $id, 'user' => $user, 'action' => 'Emailed '. $sendAddress));
		    }
		}
		
		$this->session->set_flashdata('saved', '1');
		redirect('/admin');
	}

}
