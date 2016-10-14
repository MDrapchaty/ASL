<?php
	//Drapchaty Matthew
	class model_Tipkno extends CI_Controller {

		function getTips(){
			$query = $this->db->query('SELECT * FROM tips JOIN days ON tips.dayid=days.dayid JOIN months ON tips.monthid=months.monthid JOIN jobs ON tips.jobid=jobs.jobid ORDER BY tipid DESC;');

			if ($query->num_rows() > 0){
				return $query->result(); //returns array of objects
			}else{
				return NULL;
			}
		}


		function getJobs(){
			$query = $this->db->query('SELECT * FROM jobs');

			if ($query->num_rows() > 0){
				return $query->result(); //returns array of objects
			}else{
				return NULL;
			}
		}

	
		function deletetip($id){
			$this -> db -> where('tipid', $id);
  			$this -> db -> delete('tips');
		}

		function addtip(){
	    	$tipamount=$this->input->post('tipamount');
			$hours=$this->input->post('hours');
			$day=$this->input->post('day');
			$week=$this->input->post('week');
			$month=$this->input->post('month');
			$job=$this->input->post('job');
			$data = array(
				'tipamount'=>$tipamount,
				'hours'=>$hours,
				'dayid'=>$day,
				'week'=>$week,
				'monthid'=>$month,
				'jobid'=>$job
			);
			$this->db->insert('tips',$data);
		}

		function addjob(){
			$jobname=$this->input->post('jobname');
			$jobdata = array(
				'jobname'=>$jobname
			);
			$this->db->insert('jobs', $jobdata);
		}


		function deletejob($id){
			$this -> db -> where('jobid', $id);
  			$this -> db -> delete('jobs');
		}
}

?>