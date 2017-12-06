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
    
    public function aFaire($id)
    {
    	$params = array('completed'=>0);
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
            $data=[];
            $unTodo = $this->TodoModel->get_By_Id($id);
            $ordre = $unTodo['ordre'];
            $task = $unTodo['task'];
            $id = $unTodo['id'];
            $data['ordre'] = $ordre;
            $data['task'] = $task;
            $data['id'] = $id;
            $this->load->view('TodoUpdate',$data);
            
        } 
    }
    public function delete($id)
    {
    	$this->TodoModel->delete($id);
    	redirect(base_url("todo/index")); 
    }
    
    public function reordonner()
    {
        $this->form_validation->set_rules('ordre','ordre','required|numeric');
        $lesTodos['mesTodos'] = $this->TodoModel->get_All();
        $i = 0;
        foreach ($lesTodos as $todo):
            $todo['ordre'] = $i +10;
        endforeach;
        
        if($this->form_validation->run() == TRUE)
        {
             $ordre = $this->input->post('ordre');
             foreach ($lesTodos as $untodo):
             $this->TodoModel->update($untodo['id'],$ordre);
             endforeach;
             redirect(base_url("Todo/index"));
        }
        else
        {
            $this->load->view('TodoReclasser',$lesTodos);
        }
        
    }
}