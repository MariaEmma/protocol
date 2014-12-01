<?php
$protokolo = 'Εφαρμογή διαχείρισης πρωτόκολλου - ΤΕΙ ΘΕΣΣΑΛΙΑΣ';
if($emailtype == 'adminreg')
{
$subj = 'Εγγραφή στο δικτυακό τόπο της Εφαρμογής Πρωτόκολλου';
$pass = $rs;
$emailmess = 'Σας έγραψε ο διαχειριστής του συστήματος στο δικτυακό τόπο της Εφαρμογής Πρωτόκολλου. <br/>Παρακαλούμε επισκεφτείτε τον <a href="'.base_url().'" >σύνδεσμο</a> για να εισέλθετε και να αλλάξετε άμεσα τον κώδικό πρόσβασης.';

$emailtemp = '<html><head><title>'.$subj.'</title></head><body>
                          <p>'.$emailmess.'<br/>To όνομα χρήστη είναι:  '.$uname.'<br/>O κωδικός πρόσβασης είναι:  '.$rs.' 
                          </p><hr>'.$protokolo.'</body></html>'; 
}

if($emailtype == 'sendpass')
{
$som = new User($id);
$subj = 'Αλλαγή κωδικού πρόσβασης στο δικτυακό τόπο της Εφαρμογής Πρωτόκολλου';
$pass = $rs;
$emailmess = 'Ο διαχειριστής πυροδότησε της διαδικασία αλλαγής του κωδικού σας. <br/>Παρακαλούμε επισκεφτείτε τον <a href="'.base_url().'" >σύνδεσμο</a> για να εισέλθετε και να αλλάξετε άμεσα τον κώδικό πρόσβασης.';
$emailtemp = '<html><head><title>'.$subj.'</title></head><body>
                          <p>'.$emailmess.'<br/>O νέος σας κωδικός για το όνομα χρήστη <strong>'.$som->username.'</strong> είναι: <strong>'.$pass.'</strong>
                          </p><hr>'.$protokolo.'</body></html>'; 
}

$this->load->library('email');
$configsom = array (
                    'mailtype' => 'html',
                    'charset'  => 'utf-8',
                    'priority' => '1'
                   );
$this->email->initialize($configsom);
$tigki = new User();
$tigki->get_by_usertype_id(1);
$this->email->from($tigki->email, 'Διαχειριστής');

if($emailtype == 'adminreg')
    $this->email->to($this->input->post('email'));
if($emailtype == 'sendpass'){
    $this->email->to($som->email);
}

$this->email->subject($subj);           
$this->email->message($emailtemp);
$this->email->send();
?>