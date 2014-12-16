<?php

class User_file extends DataMapper {
   
    var $has_one = array('category');
    

    var $table = 'user_files';
    
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    function getUserFile($userid,$fileid)
    {
        return $this->where('user_id',$userid)->where('file_id',$fileid)->get()->id;
    }
    function getUserFileForAfile($fileid)
    {
        return $this->where('file_id',$fileid)->get();
    }
    
}

/* End of file user.php */
/* Location: ./lamdapp/models/user.php */
   
    

   
