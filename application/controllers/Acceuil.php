<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceuil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!isset($this->session->connected)){
			redirect('sign/index');
		}

		$this->load->model('Crud');

		$this->load->view('layout/head.php');	
		$this->load->view('layout/header.php');
		$this->load->view('layout/sidebar.php');
	}

	public function index()
	{
		$d['p_o'] = $this->Crud->get_data_desc('poste',['etat'=>1]);
		$d['p_v'] = $this->Crud->get_data_desc('poste',['etat'=>0]);
		$d['poste'] = $this->Crud->get_data_desc('poste',[],5);
		$d['all_post'] = $this->Crud->get_data_desc('poste',[]);
		$d['cv'] = $this->Crud->get_data_desc('cv');
		$d['index_menu'] = true;

		$this->load->view('pages/acceuil',$d);
		$this->load->view('layout/footer.php');
		$this->load->view('layout/js.php');
	}

	public function all_poste()
	{
		$d['p_o'] = $this->Crud->get_data_desc('poste',['etat'=>1]);
		$d['p_v'] = $this->Crud->get_data_desc('poste',['etat'=>0]);
		$d['poste_menu'] = true;

		$this->load->view('pages/all_poste',$d);
		$this->load->view('layout/footer.php');
		$this->load->view('layout/js.php');
	}

	public function new_poste()
	{
		$this->Crud->add_data('poste',[
			'name' => $this->input->post('name'),
			'etat' => 0
		]);

		redirect('acceuil/all_poste');
	}

	public function change_stat()
	{
		$id = $this->input->post('id');
		$etat = $this->input->post('etat');
		
		if($etat == 1)
		{
			$this->Crud->update_data('poste',['id'=>$id],['etat'=>0]);
		}else{
			$this->Crud->update_data('poste',['id'=>$id],['etat'=>1]);
		}

		redirect('acceuil/all_poste');
	}

	//upload cv
	public function cv()
	{
		if(count($_POST) <= 0)
		{
			$d['poste'] = $this->Crud->get_data_desc('poste',[]);
			$d['cv_menu'] = true;
			$this->load->view('pages/cv',$d);
			$this->load->view('layout/footer.php');
			$this->load->view('layout/js.php');
		}else{
			if ($_FILES['cv']['name'] != null) 
			{
				$p_name = $this->Crud->get_data('poste',['id'=>$this->input->post('poste')])[0]->name;

				$fichier = $_FILES['cv']['name'].'-'.md5(time());

				move_uploaded_file($_FILES['cv']['tmp_name'], './assets/cv/'.$fichier);
			
				$d = [
					'file' => $fichier,
					'poste_id' => $this->input->post('poste')
				];

				$this->Crud->add_data('cv',$d);

				$this->session->set_flashdata(['cv_added'=>true]);
				redirect('acceuil/index');
		   }	
		}	
	}

	//filter
	public function filter()
	{
		if(count($_POST) <= 0)
		{
			$d['poste'] = $this->Crud->get_data_desc('poste',[]);
			$d['filtre_menu'] = true;
			$this->load->view('pages/filter',$d);
			$this->load->view('layout/footer.php');
			$this->load->view('layout/js.php');
		}else
		{
            if (count($this->Crud->get_data_desc('cv', ['poste_id'=>$this->input->post('poste')])) > 0) {
                $cv = $this->Crud->get_data_desc('cv', ['poste_id'=>$this->input->post('poste')])[0]->file;
                $c= $this->input->post('critere');
                $critere = explode(',', $c);

                $CSVfp = fopen(base_url('assets/cv/'.$cv), "r");

                if ($CSVfp !== false) {
                    while (!feof($CSVfp)) {
                        $data = fgetcsv($CSVfp, 1000, ",");

                        if (is_array($data)) {
                            for ($i=0;$i<count($data);$i++) {
                                $cell['c'.$i] = $data[$i];
                            }
                            $table[] = $cell;
                        }
                    }
                }
                
                fclose($CSVfp);
                
                if (isset($table)) {
                    $cv = [];

                    foreach ($table as $t) {
                        // print_r($t);
                        for ($i=count($t)-1;$i>count($t)-2;$i--) {
                            $j = $i-1;
                            $d = [];
                            if ((strtolower($t['c'.$i]) == strtolower($critere[1]) && strtolower($t['c'.$j]) == strtolower($critere[0])) ||
                            (strtolower($t['c'.$i]) == strtolower($critere[0]) && strtolower($t['c'.$j]) == strtolower($critere[1]))) {
                                for ($k=0;$k<count($t);$k++) {
									if($t['c'.$k] != '')
									{
										$d['k'.$k] = $t['c'.$k];
									}                                    
                                }
                            }
                        }
                        if (isset($d)) {
                            $cv[] = $d;
                        }
                    }
                }
                $this->load->view('pages/filter_result',['cv'=>$cv]);				
				$this->load->view('layout/footer.php');
				$this->load->view('layout/js.php');
            }else{
				$this->session->flash_data(['no_cv'=>true]);
				redirect('acceuil/filter');
			}
		}		
	}

	//sending mail
	public function send_mail()
	{
		// foreach($_POST as $p=>$v)
		// {
		// 	echo $v.'<br/>';
		// }
		// die();
		redirect('acceuil/filter');
	}
}
