<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv2db extends CI_Controller {

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
        
        $s=0;
        $back_tourspots=9999999;
        $filepath = "var/kanko_all.csv";
        $file = new SplFileObject($filepath); 
        $file->setFlags(SplFileObject::READ_CSV); 
        foreach ($file as $key => $line) {

            // 集合データの検索
            $tmp_tourspots = $line[0];
            $tmp_tourspots = str_replace("tourspots[", "", $tmp_tourspots);
            $tmp_tourspots = str_replace("]", "", $tmp_tourspots);
            
            // 集合データがインクリメントした時の処理
            if($tmp_tourspots>0 && $tmp_tourspots!=$back_tourspots){

                $back_tourspots = $tmp_tourspots;
            }

            // location_id
            if($line[2]=="refbase"){
                echo "refbase: ";
                echo $line[9];
                echo "<br>";
                $location_id = $line[9];
            }
            
            // name
            if($line[2]=="name1" && $line[3]=="written"){
                echo "written: ";
                echo $line[9];
                echo "<br>";
                $name = $line[9];
            }
            
            // information
            if($line[2]=="body"){
                echo "body: ";
                echo $line[9];
                echo "<br>";
                $information = $line[9];
            }
            
            // url
            if($line[3]=="url"){
                echo "url: ";
                echo $line[9];
                echo "<br>";
                $url = $line[9];
            }
            
            // latitude
            if($line[3]=="longitude"){
                echo "longitude: ";
                echo $line[9];
                echo "<br>";
                $latitude = $line[9];
            }
            
            // longitude
            if($line[3]=="latitude"){
                echo "latitude: ";
                echo $line[9];
                echo "<br>";
                $longitude = $line[9];
            }
            
            // pref
            if($line[1]=="place" && $line[2]=="pref" && $line[3]=="written"){
                echo "pref: ";
                echo $line[9];
                echo "<br>";
                $pref = $line[9];
            }
            
            // city
            if($line[1]=="place" && $line[2]=="city" && $line[3]=="written"){
                echo "city: ";
                echo $line[9];
                echo "<br>";
                $city = $line[9];
            }
            
            // phone
            if($line[2]=="phone"){
                echo "phone: ";
                echo $line[9];
                echo "<br>";
                $phone = $line[9];
            }
            
            // update_dt
            if($line[3]=="update"){
                echo "update: ";
                echo $line[9];
                echo "<br>";
                $update_dt = $line[9];
            }
            
            // genre_l
            if($line[1]=="genres[0]" && $line[2]=="L"){
                echo "genres L : ";
                echo $line[9];
                echo "<br>";
                $genre_l = $line[9];
            }
            
            // genre_m
            if($line[1]=="genres[0]" && $line[2]=="M"){
                echo "genres M : ";
                echo $line[9];
                echo "<br>";
                $genre_m = $line[9];
            }
            
            // genre_s
            if($line[1]=="genres[0]" && $line[2]=="S"){
                echo "genres S : ";
                echo $line[9];
                echo "<br>";
                $genre_s = $line[9];
            }

        }

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */