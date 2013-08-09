<?php 

class Qa_model extends CI_Model {
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function getQuestions ($limit = null)
	{
		if (isset($limit))
		{
			$limit = " limit $limit";
		}
		
		$query = $this->db->query('select id, question, answer, name, answered, category, answers.timeCreated as timeAnswered, questions.timeCreated as timeAsked 
								   from questions
								   left join answers
								   on questions.id = answers.questionId
								   order by questions.timeCreated DESC' . $limit);
	
        return ($query->result());
	}
	
	function getAnswers ($params = array())
	{
		if (isset($params['limit']))
		{
			$limit = " limit $limit";
		}
		else
		{
			$limit = "";
		}
		
		if (isset($params['category']) && !empty($params['category']))
		{
			$category = $params['category'];
			$categoryClause = " and category='$category'";
		}
		else
		{
			$categoryClause = "";
		}
		
		
		if (isset($params['contains']) && !empty($params['contains']))
		{
			$contains = $this->db->escape_like_str($params['contains']);
			$containsClause = " and (question like '%$contains%' or answer like '%$contains%')";
		}
		else
		{
			$containsClause = "";
		}
		
		$query = $this->db->query("select id, question, answer, name, answered, category, answers.timeCreated as timeAnswered, questions.timeCreated as timeAsked 
								   from questions
								   right join answers
								   on questions.id = answers.questionId
								   where answered = 1
								   $categoryClause
								   $containsClause
								   order by answers.timeCreated DESC" . $limit);

        return ($query->result());
	}
	
	function getQuestion ($id)
	{
		$query = $this->db->get_where('questions', array('id' => $id));
		$row = $query->row();
		
		return $row;
	}
	
	function getAnswerForQuestion ($id)
	{
		$query = $this->db->get_where('answers', array('questionId' => $id));
		$row = $query->row();
		
		return $row;
	}
	
	function saveAnswer($id, $answer)
	{	
		$query = $this->db->get_where('answers', array('questionId' => $id));
		
		if ($query->num_rows() == 0)
		{
			$this->db->insert('answers', array('answer' => $answer, 'questionId' => $id));
		}
		else
		{
			$this->db->where('questionId', $id);
			$this->db->update('answers', array('answer' => $answer));
		}
	}
	
	function setAnswered ($id, $answered)
	{
		$this->db->where('id', $id);
		$this->db->update('questions', array('answered' => $answered));
	}
	
	function updateCategory($id, $category)
	{
		$this->db->where('id', $id);
		$this->db->update('questions', array('category' => $category));
	}
	
	function addActivity ($params = array())
	{	
		$this->db->insert('answerActivity', array('questionId' => $params['questionId'], 'action' => $params['action'], 'user' => $params['user']));
	}
	
	function getActivityForAnswer($id)
	{
		$query = $this->db->query("select * from answerActivity where questionId = $id order by ts asc");

        return ($query->result());
	}
	
}
	
?>