<?php
/** @property  CI_DB $db
 *
 */
/*if(! defined ('BASEPATH')) exit ("Pas d'acces direct au script")
{
}
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TodoModel
 *
 * @author adminSio
 */
class TodoModel extends CI_Model
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }
    public function get_By_Id($id)
    { 
        $data = $this->db-> get_where('todo', array('id' => $id))->row_array();
        return $data;
    }
    public function get_all()
    {
        $this->db->order_by('ordre');  
        return $this->db->get('todo')->result_array();
        
    }
    public function add($params)
    {
        $this->db->insert('todo',$params);
    }
    public function delete($id)
    {
        $this->db->delete('todo',  ['id'=>$id]);
    }
    public function update($id,$params)
    {
//        var_dump($id);
//        var_dump($params);
        $this->db->where('id',$id);
        $this->db->update('todo',$params);
    }
    }
     
