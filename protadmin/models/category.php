<?php

class Category extends DataMapper {
   
    var $has_many = array('file');
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
    function getCategoriesOfFiles(){
        return $this->file->get();
    }
}

/* End of file user.php */
/* Location: ./lamdapp/models/user.php */
   
    

   
