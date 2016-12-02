<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getPostings extends CI_Controller {

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
	public function index() {
		$length = $this->input->post("length");
		$beforeAt = $this->input->post("beforeAt");
        
        $this->load->database();
		$query = $this->db->query("SELECT * FROM d_morurun.t_posting order by id desc");
		
		$postings_array = array();

        foreach ($query->result() as $row){

                $posting["posting_id"] = (int)$row->id;
                $posting["user_id"] = $row->user_id;
            
                $this->load->database();
                $query_user = $this->db->query("SELECT * FROM d_morurun.t_user where uid like '".$row->user_id."'");
                $row_user = $query_user->row();
                $nickname = $row_user->nickname;

                $posting["user_nickname"] = $nickname;

                $time_stamp  =strtotime("$row->datetime");
                $posting["datetime"] = date(DATE_ATOM, $time_stamp);
                $posting["type_id"] = (int)$row->type_id;
                $posting["comment"] = $row->comment;
                $posting["url"] = $row->url;
                $posting["latitude"] = (double)$row->latitude;
                $posting["longitude"] = (double)$row->longitude;
                $posting["location_id"] = $row->location_id;
                array_push($postings_array, $posting);

        }

		$resoponse_obj = array("posting" => $postings_array);		
		$json_str = json_encode($resoponse_obj);
		$this->output->set_content_type('application/json');
		$this->output->set_output($json_str);
		$this->output->set_status_header(200);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */