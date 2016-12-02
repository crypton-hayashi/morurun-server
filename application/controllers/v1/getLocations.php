<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getLocations extends CI_Controller {

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
		
		$locations_array = array();

        $this->load->database();
		$query = $this->db->query("SELECT * FROM d_morurun.t_location where city LIKE '室蘭市' order by id desc");

		foreach ($query->result() as $row){

            $location["location_id"] = $row->location_id;
            $location["name"] = $row->name;
            $location["information"] = $row->information;
            $location["url"] = $row->url;
            $location["latitude"] = (double)$row->latitude;
            $location["longitude"] = (double)$row->longitude;
            array_push($locations_array, $location);

		}

		$resoponse_obj = array("location" => $locations_array);		
		$json_str = json_encode($resoponse_obj);
		$this->output->set_content_type('application/json');
		$this->output->set_output($json_str);
		$this->output->set_status_header(200);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */