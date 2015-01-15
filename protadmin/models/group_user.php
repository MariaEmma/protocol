<?php

class Group_user extends DataMapper {
   
    var $table = 'group_users';
    
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    function getGroupUser($groupid,$userid)
    {
        return $this->where('group_id',$groupid)->where('user_id',$userid)->get();
    }
//    function getUserFileForAfile($fileid)
//    {
//        return $this->where('file_id',$fileid)->get();
//    }
    
}

/* End of file user.php */
/* Location: ./lamdapp/models/user.php */
   
    

   
