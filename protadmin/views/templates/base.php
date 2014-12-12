<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Μαρία Εμμανουήλ, Σωμαράς Χρήστος">
    <title>Εφαρμογή Διαχείρισης Πρωτόκολλου</title>
     <?php $this->load->view('shared/stylesheet.php'); ?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand" style="background-color: #A70303; font-size:14px;" >Εφαρμογή Πρωτόκολλου<br/>TEI ΘΕΣΣΑΛΙΑΣ</div> 
            </div>
  <div class="intro-text"> Καλώς ήλθατε: <span style="font-weight:bold;"><?php echo $user->firstname.' '.$user->lastname; ?></span>, Τελευταία είσοδος :  <?php if ($ldate!=null) echo date("d/m/Y H:i:s", strtotime($ldate));?>&nbsp; <a href="/backend/logout" class="btn btn-danger square-btn-adjust">Αποσύνδεση</a> </div>
        </nav>  
           <!-- /. NAV TOP  --> 


     <?php echo $content; ?>   

    <div style="background-color: #999999; font-family:arial; padding:5px; text-align:center;font-size:12px;">
			<strong>Υπεύθυνος:</strong> <a style="color:#fff;" href="http://teilar.academia.edu/TakisHartonas" title="Χρυσάφης Χαρτώνας" target="_blank">Χρυσάφης Χαρτώνας</a>, Καθηγητής<br/>
                        <strong>Ανάπτυξη:</strong> <a style="color:#fff;" href="http://gr.linkedin.com/in/emmanouilmaria" target="_blank" title="Μαρία Εμμανουήλ">Μαρία Εμμανουήλ</a>, <a style="color:#fff;" href="http://www.somweb.gr" title="Χρήστος Σωμαράς" target="_blank">Χρήστος Σωμαράς</a><br/>
			&copy; <?php echo date('Y') ?> <a style="color:#fff;" href="http://www.teilar.gr" target="_blank">ΤΕΙ Θεσσαλίας</a>
</div>    
 
</div>
     <!-- /. WRAPPER  -->
  
<?php $this->load->view('shared/scripts.php'); ?>   
</body>
</html>
