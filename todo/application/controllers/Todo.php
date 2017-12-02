<?php
/** @property TodoModel $TodoModel
 * 
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Todo
 *
 * @author adminSio
 */
class Todo extends CI_Controller{
    //put your code here
    public function index()
    {
        $all_Todo = $this->TodoModel->get_all();
        $data = array();
        $data['titre'] = "Liste de mes travaux";
        $data['lesTodos'] = $all_Todo;
        $this->load->view('TodoView',$data);
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TodoModel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        
    }
    public function fait($id)
    {
    	$params = array('completed'=>1);
    	$this->TodoModel->update($id,$params);
    	redirect(base_url("todo/index"));
        
    }
    
    public function add()
    {
        $this->form_validation->set_rules('ordre','ordre','required|numeric');
        $this->form_validation->set_rules('task','tâche','required|max_length[66]');
        if($this->form_validation->run() == TRUE)
        {
            $task = $this->input->post('task');
            $ordre = $this->input->post('ordre');
            $params = array('task'=>$task,'ordre'=>$ordre,'completed'=>0);
            $this->TodoModel->add($params);
            redirect(base_url("Todo/index"));
            
            
        }
        else
        {
            $this->load->view('TodoAdd');
            
        }   
    }
    
    public function modifier($id)
    {
        //var_dump($id);
        $this->form_validation->set_rules('ordre','ordre','required|numeric');
        $this->form_validation->set_rules('task','tâche','required|max_length[66]');
        if($this->form_validation->run() == TRUE)
        {
            //var_dump($id);
            $task = $this->input->post('task');
            $ordre = $this->input->post('ordre');
            $params = array('task'=>$task,'ordre'=>$ordre,'completed'=>0);
            
//            var_dump($params);
            
            $this->TodoModel->update($id,$params);
            redirect(base_url("Todo/index"));
        }
        else
        {
            $idTbl = array();
            $idTbl['id'] = $id;
            $utilisateur = $this->TodoModel->get_By_Id($id);
            $idTbl['task']= $utilisateur['task'];
            $idTbl['ordre']= $utilisateur['ordre'];
            $this->load->view('TodoUpdate',$idTbl);
            
        } 
    }
    public function delete($id)
    {
    	$this->TodoModel->delete($id);
    	redirect(base_url("todo/index")); 
    }
}