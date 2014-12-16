<?php

class Category extends DataMapper {
   
    var $has_many = array('user_file');
    var $table = 'categories';
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
    
    function getCategories(){
        return $this->order_by("title")->get();
    }
    function getFilesOfCategories(){
        return $this->user_file->get();
    }
}

/* End of file user.php */
/* Location: ./lamdapp/models/user.php */
   
    

   
