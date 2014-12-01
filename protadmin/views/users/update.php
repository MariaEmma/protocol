 <div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>              
                <div class="panel panel-default"> 
                    <div class="panel-heading">Επεξεργασία χρήστη
                    </div>
                    <div class="panel-body">
                        
                        <div class="row">
                                <div class="col-md-12">
<?php $attributes = array('id' => 'userupdateform'); ?>
<?php echo form_open('backend/user/update/'.$ontotita2->id, $attributes); ?>
<?php echo form_fieldset('Στοιχεία χρήστη'); ?>
<div class="col-md-6">
    <div class="form-group"> 
<?php echo form_error('username');?> 
<?php echo form_label('Όνομα χρήστη', 'username', array(
                                             'for' => 'username',
                                              )); ?>
<?php echo form_input(array(
                           'name'        => 'username',
                           'id'          => 'username',
                           'tabindex'    => '1',
                           'placeholder' => 'Εισάγετε όνομα χρήστη',
                           'class'       => 'form-control',
                            'value'       => $ontotita2->username,                           
                           ));?> 
</div>       
<div class="form-group">                                        
<?php echo form_error('password'); ?>
<?php echo form_label('Κωδικός', 'password', array(
                                             'for' => 'password',
                                              )); ?>
<?php echo form_password(array(
                               'name'        => 'password',
                               'id'          => 'password',
                               'tabindex'    => '2',
                               'placeholder' => 'Εισάγετε κωδικό',
                               'class'       => 'form-control',
));?> 
    </div>       
<div class="form-group">  
<?php echo form_error('cnewpass');?> 
    <?php echo form_label('Επιβεβαίωση Κωδικού', 'cnewpass', array(
                                             'for' => 'cnewpass',
                                              )); ?>
<?php echo form_password(array(
                               'name'        => 'cnewpass',
                               'id'          => 'cnewpass',
                               'tabindex'    => '3',
                               'placeholder' => 'Επιβεβαιώστε τον κωδικό',
                               'class'       => 'form-control',
));?>
        </div>

</div>
<div class="col-md-6"> 
    <div class="form-group"> 
<?php echo form_error('firstname');?> 
<?php echo form_label('Όνομα', 'firstname', array(
                                             'for' => 'firstname',
                                              ));  ?>          
<?php echo form_input(array(
                            'name'        => 'firstname',
                            'id'          => 'firstname',
                            'tabindex'    => '4',
                            'placeholder' => 'Εισάγετε όνομα',
                            'class'       => 'form-control',
                            'value'       => $ontotita2->firstname,
                            ));?>  
                                             </div>  
<div class="form-group">
<?php echo form_error('lastname');?> 
<?php echo form_label('Επώνυμο', 'lastname', array(
                                             'for' => 'lastname',
                                              ));  ?>          
<?php echo form_input(array(
                            'name'        => 'lastname',
                            'id'          => 'lastname',
                            'tabindex'    => '5',
                            'placeholder' => 'Εισάγετε επώνυμο',
                            'class'       => 'form-control',
                            'value'       => $ontotita2->lastname,
                            ));?>     
                                             </div> 
<div class="form-group">
<?php echo form_error('phone');?> 
<?php echo form_label('Τηλέφωνο', 'phone', array(
                                             'for' => 'phone',
                                              )); ?>
<?php echo form_input(array(
                            'name'        => 'phone',
                            'id'          => 'phone',
                            'tabindex'    => '6',
                            'placeholder' => 'Εισάγετε τηλέφωνο',
                            'class'       => 'form-control',
                            'value'       => $ontotita2->phone,
                           ));?> 
</div>       
<div class="form-group"> 
<?php echo form_error('email');?> 
<?php echo form_label('Ηλ. διεύθυνση', 'email', array(
                                             'for' => 'email',
                                              )); ?>
<?php echo form_input(array(
                           'name'        => 'email',
                           'id'          => 'email',
                           'tabindex'    => '7',
                           'placeholder' => 'Εισάγετε την ηλ. σας διεύθυνση',
                           'class'       => 'form-control',
                            'value'       => $ontotita2->email,
                           ));?>       
</div>  

<?php echo form_button(array(
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'true',
                                        'tabindex'    => '8',
                                        'type' => 'submit',
                                        'content' => 'Απoθήκευση',
                                        'class' => 'btn btn-primary'
)); ?></div> 
                                               
<?php echo form_fieldset_close(); ?>

                                       <?php echo form_close();?>
</div></div>
                
                
                
                                            </div><!--span11 -->
  
</div> 
				</div><!--/span-->
			
			</div><!--/row--> 
    </div>
</div>
		