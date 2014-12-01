<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function _output($content)
    {
        // Load the base template with output content available as $content
        require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/paths.php");

        $data['content'] = &$content;
        echo($this->load->view('templates/base', $data, true));
    }

}
