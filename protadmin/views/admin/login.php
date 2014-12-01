<!DOCTYPE html>
<html lang="el">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Μαρία Εμμανουήλ, Σωμαράς Χρήστος">
    <title>Εφαρμογή Διαχείρισης Πρωτόκολλου</title>
    <link href="<?php echo $resources;?>css/bootstrap.css" rel="stylesheet" />
     
</head>
<body style="background-color: rgba(132, 132, 132, 1);height: 100%;">
    
<div class="container-fluid" >
    <div class="container">
        <h2 style="font-weight: bold;font-size:24px;color: rgba(155, 231, 29, 1);text-align: center;padding-top: 50px">Εφαρμογή Πρωτόκολλου<br/>ΤΕΙ ΘΕΣΣΑΛΙΑΣ</h2>
      <div class="row"><div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4"><?php echo $this->session->flashdata('msg'); ?>
                                <?php $attributes = array('id' => 'loginform', 'class'=>'form-signin'); ?>
                                <?php echo form_open('backend', $attributes); ?>
                                <?php echo form_fieldset(''); ?>
                                <div class="form-group">
                                    <?php echo form_error('login');?>
                                    <?php echo form_input(array(
                                                                  'name'        => 'login',
                                                                  'id'          => 'login',
                                                                  'tabindex'    => '1',
                                                                  'placeholder' => 'Εισάγετε όνομα χρήστη',
                                                                  'class'       => 'form-control',
                                                                  'autofocus'   => 'autofocus',
                                                                   ));?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_error('pass'); ?>
                                    <?php echo form_password(array(
                                                                   'name'        => 'pass',
                                                                   'id'          => 'pass',
                                                                   'tabindex'    => '2',
                                                                   'placeholder' => 'Εισάγετε κωδικό',
                                                                   'class'       => 'form-control',
                                                                    'autofocus'   => 'autofocus'
                                                                    ));?>
                                </div>
                                    <?php echo form_button(array(
                                                                    'name' => 'button',
                                                                    'id' => 'button',
                                                                    'value' => 'true',
                                                                    'tabindex'    => '3',
                                                                    'type' => 'submit',
                                                                    'content' => 'Αποστολή',
                                                                    'class' => 'btn btn-lg btn-primary btn-block'    
                                                                    )); ?>
                            <?php echo form_fieldset_close(); ?>
                            <?php echo form_close();?> 
      </div><div class="col-md-4">&nbsp;</div></div>
          <hr>
<div style="font-family:arial; margin-top:20px; text-align:center;font-size:12px;">
			<strong>Υπεύθυνος:</strong> <a style="color:#fff;" href="http://teilar.academia.edu/TakisHartonas" title="Χρυσάφης Χαρτώνας" target="_blank">Χρυσάφης Χαρτώνας</a>, Καθηγητής<br/>
                        <strong>Ανάπτυξη:</strong> <a style="color:#fff;" href="http://gr.linkedin.com/in/emmanouilmaria" target="_blank" title="Μαρία Εμμανουήλ">Μαρία Εμμανουήλ</a>, <a style="color:#fff;" href="http://www.somweb.gr" title="Χρήστος Σωμαράς" target="_blank">Χρήστος Σωμαράς</a><br/>
			&copy; <?php echo date('Y') ?> <a style="color:#fff;" href="http://www.teilar.gr" target="_blank">ΤΕΙ Θεσσαλίας</a>
</div>
    </div>

    </div> <!-- /container -->
    </body>
</html>