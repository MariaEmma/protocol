<?php

class Group extends DataMapper {
   
   var $has_many = array(
        'user' => array(			
            'class' => 'user',			
            'other_field' => 'group',		
            'join_self_as' => 'group',		
            'join_other_as' => 'user',		
            'join_table' => 'group_users'),
    );
    var $table = 'groups';
    var $validation = array(
        
        'title' => array(
            'label' => 'Τίτλος',
            'rules' => array('required','trim'),
        ),
        'description' => array(
            'label' => 'Περιγραφή',
            'rules' => array('trim'),
        ),


    );
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    
    function getAllGroups(){
        return $this->order_by("title")->get();
    }
    function getUsersOfGroups(){
        return $this->user->get();
    }
    
    
}

/* End of file user.php */
/* Location: ./lamdapp/models/user.php */
   
    

   
