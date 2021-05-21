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
		$this->load->view('pages/acceuil',$d);
		$this->load->view('layout/footer.php');
		$this->load->view('layout/js.php');
	}

	public function all_poste()
	{
		$d['p_o'] = $this->Crud->get_data_desc('poste',['etat'=>1]);
		$d['p_v'] = $this->Crud->get_data_desc('poste',['etat'=>0]);

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

	public function filter()
	{
		if(count($_POST) <= 0)
		{
			$d['poste'] = $this->Crud->get_data_desc('poste',[]);
			$this->load->view('pages/filter',$d);
			$this->load->view('layout/footer.php');
			$this->load->view('layout/js.php');
		}else{
			echo 'else';die();
		}		
	}

	public function cv()
	{
		if(count($_POST) <= 0)
		{
			$d['poste'] = $this->Crud->get_data_desc('poste',[]);
			$this->load->view('pages/cv',$d);
			$this->load->view('layout/footer.php');
			$this->load->view('layout/js.php');
		}else{
			if ($_FILES['cv']['name'] != null) 
			{
				$p_name = $this->Crud->get_data('poste',['id'=>$this->input->post('poste')])[0]->name;

				$fichier = $p_name.'-'.$_FILES['cv']['name'];

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
}
