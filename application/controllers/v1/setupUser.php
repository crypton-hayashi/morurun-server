<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setupUser extends CI_Controller {

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
		$nickname = $this->input->post("nickname");
		$uid = $this->input->post("uid");
		
        error_log("nickname = " . $nickname);
		error_log("uid = " . $uid);
        
        
		$this->load->database();
        
        if(!$uid){
            $length = 6;
            $uid = date('YmdHis').substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
        

            $dbdata = array(
                'uid' => $uid ,
                'nickname' => $nickname ,
                'datetime' => date('Y-m-d H:i:s') ,
            );

            $this->db->insert('t_user', $dbdata); 
        }else{
        
			$this->db->where('uid', $uid );
			$this->db->update('t_user', array('nickname' => $nickname));
        }
        
		$resoponse_obj = array("status" => "OK", "uid" => $uid);		
		$json_str = json_encode($resoponse_obj);
		$this->output->set_content_type('application/json');
		$this->output->set_output($json_str);
		$this->output->set_status_header(200);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */