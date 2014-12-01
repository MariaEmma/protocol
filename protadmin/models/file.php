<?php

class File extends DataMapper {
    var $has_one = array('user','category');    
    var $table = 'files';
    var $validation = array(
        'description' => array(
            'label' => 'Περιγραφή',
            'rules'=> array('trim'),
        ),
        'upload_file' => array(
            'label' => 'Αρχείο', 
            'rules'=> array('required'),
        ),        
    );
       
function getUserOwnFiles($userid){
        return $this->where('sent_user',$userid)->order_by("president_date")->get();
    } 
function getMaxId(){
        return $this->select_max('id')->get()->id;
    }

}

/* End of file category.php */
/* Location: ./lamdapp/models/categroy.php */