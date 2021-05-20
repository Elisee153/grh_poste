<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		//======================================================
		$this->load->model('Crud');
		//======================================================
		$this->load->view('layout/head');

	}

    public function index()
	{
		if (count($_POST) <= 0) {
            $this->load->view('pages/signin');
            $this->load->view('layout/js');        
        } 
        else{
            $data = array(
                "username" => trim($this->input->post("username")),
                "mdp" => trim($this->input->post("mdp"))
            );

            if(count($res = $this->Crud->get_data('user',$data)) > 0)
            {
                //creation de la session
                $session =[
                    "id"=>$res[0]->id,                    
                    "username"=>$res[0]->username,
                    "name"=>$res[0]->name,
                    "mdp"=>$res[0]->mdp,
                    "email"=>$res[0]->email,
                    "connected"=>true,                    
                ];

                $this->session->set_userdata($session);

                //gestion des interfaces selon les differents utilisateurs                
                redirect('acceuil/index');
            }
            else{
                $session_flash = array("error_login" => "Nom d'utilisateur ou mot de passe incorrect!!");
                $this->session->set_flashdata($session_flash);
                redirect("sign/index");
            }
        }
	}

    //===Creer un compte===
    public function signUp()
    {
        if (count($_POST) <= 0) {
            $this->load->view('admin/signup');
            $this->load->view('layout/admin/js');        
        }
        else{
            $data = array(
                "name" => $this->input->post('name'),				
                "email" => $this->input->post("email"),
                "username" => $this->input->post("username"),
                "mdp" => $this->input->post("mdp"),
            );
            //add user
            $this->Crud->add_date('user',$data);
            $this->session->set_flashdata(array('account_created'=>true));
            redirect('admin/index');
        }
    }

    public function profile()
    {
         //===chargement du model===
         $this->load->model('Crud');

         //===l'id d'utilisateur===
         $id = $this->session->id_admin;
 
         if(count($_POST)<=0)
         {
             $d['user'] = $this->Crud->get_data('user',['id'=>$id]);
 
             //===Passage a la vue===
             $this->load->view('layout/admin/topbar');
             $this->load->view('layout/admin/sidebar');
             $this->load->view('admin/profile',$d);
             $this->load->view('layout/admin/js');
             $this->load->view('layout/admin/footer');
         }
         else
         {
            $this->Crud->update_data('user',['id'=>$id],$_POST);

            redirect('admin/index');            
         }
    }
    //se deconnecter de l'application
    public function deconnexion()
    {
        $this->session->sess_destroy();
        redirect("sign/");
    }
}

?>