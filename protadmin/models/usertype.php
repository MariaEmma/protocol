<?php

class Usertype extends DataMapper {
    
    var $has_many = array('user');
    
    var $table = 'usertypes';

    var $validation = array(
        'title' => array(
            'label' => 'Τίτλος χρήστη',
            'rules' => array('required', 'trim'),
        ),
        'description' => array(
            'label' => 'Περιγραφή',
            'rules'=> array('trim'),
        ),
    );
    
    function getListboxUsertypes(){
        $arr = array(2,5,6,7);
        return $this->where_in('id',$arr)->order_by("id", "asc")->get();
    }
   

}

/* End of file category.php */
/* Location: ./lamdapp/models/categroy.php */