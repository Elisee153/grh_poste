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
		$this->session->set_flashdata(['poste_added'=>true]);
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
				if(count(explode(' ',$_FILES['cv']['name']))>1)
				{
					$file = explode(' ',$_FILES['cv']['name'])[0];
				}else{
					$file = $_FILES['cv']['name'];
				}

				// $p_name = $this->Crud->get_data('poste',['id'=>$this->input->post('poste')])[0]->name;

				$fichier = md5(time()).'-'.$file;

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
			$d['poste'] = $this->Crud->get_data_desc('poste',['etat'=>0]);
			$d['filtre_menu'] = true;
			$this->load->view('pages/filter',$d);
			$this->load->view('layout/footer.php');
			$this->load->view('layout/js.php');
		}else
		{
            if (count($this->Crud->get_data_desc('cv', ['poste_id'=>$this->input->post('poste')])) > 0) 
			{
                $cv = $this->Crud->get_data_desc('cv', ['poste_id'=>$this->input->post('poste')])[0]->file;
				$poste = $this->Crud->get_data_desc('poste',['id'=>$this->input->post('poste')])[0]->name;
                $competence = $this->input->post('competence');
				$langue = $this->input->post('langue');

				//===creation  de tableaux contenant les competences et les langues===
				if($langue != ''){$lg = explode(',', $langue);}else{$lg = '';}
                if($competence !=''){$cp = explode(',', $competence);}else{$cp = '';}				

				//===manipulation du fichier csv===
                $CSVfp = fopen(base_url('assets/cv/'.$cv), "r");

                if ($CSVfp !== false) 
				{
                    while (!feof($CSVfp)) 
					{
                        $data = fgetcsv($CSVfp, 1000, ",");

                        if (is_array($data)) 
						{
                            for ($i=0;$i<count($data);$i++) 
							{
                                $cell['c'.$i] = $data[$i];
                            }

                            $table[] = $cell;
                        }
                    }
                }
                
                fclose($CSVfp);
                
                if (isset($table)) 
				{
                    $cv = [];

                    foreach ($table as $t) {
                        // print_r($t);
                        for ($i=count($t)-1;$i>count($t)-2;$i--) 
						{
                            $j = $i-1;
                            $d = [];

							$array_competence = explode(',', $t['c'.$j]);
							$array_langue = explode(',', $t['c'.$i]);
							$cp_result = 0;
							$lg_result = 0;

							//===control competence===
							if($cp != '')
							{
								for($cpt=0;$cpt<count($cp);$cpt++)
								{
									for($arc=0;$arc<count($array_competence);$arc++)
									{
										if(trim(strtolower($cp[$cpt])) == trim(strtolower($array_competence[$arc])))
										{
											$cp_result +=1;break;
										}
									}
								}
							}
							

							//===control langue===
							if($lg != '')
							{
								for($lng=0;$lng<count($lg);$lng++)
								{
									for($arl=0;$arl<count($array_langue);$arl++)
									{
										if(trim(strtolower($lg[$lng])) == trim(strtolower($array_langue[$arl])))
										{
											$lg_result +=1;break;
										}
									}
								}
							}						

							//===control de compatibilite===							
							if($lg != '' && $cp != '')
							{
								if ($cp_result == count($cp) && $lg_result == count($lg)) 
								{
									for ($k=0;$k<count($t);$k++) 
									{
										if($t['c'.$k] != '')
										{
											$d['k'.$k] = $t['c'.$k];
										}                                    
									}
								}
							}else{
								if($lg != '' && $lg_result == count($lg))
								{
									for ($k=0;$k<count($t);$k++) 
									{
										if($t['c'.$k] != '')
										{
											$d['k'.$k] = $t['c'.$k];
										}                                    
									}
								}else if ($cp != '' && $cp_result == count($cp)) {
									for ($k=0;$k<count($t);$k++) 
									{
										if ($t['c'.$k] != '') 
										{
											$d['k'.$k] = $t['c'.$k];
										}
									}
                                }                            		
							}                           
                        }
                        if (isset($d)) 
						{
                            $cv[] = $d;
                        }
                    }
					$this->load->view('pages/filter_result',['cv'=>$cv,'filtre_menu'=>true,'poste'=>$poste]);				
					$this->load->view('layout/footer.php');
					$this->load->view('layout/js.php');
                }
            }else{
				$this->session->set_flashdata(['no_cv'=>true]);
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
