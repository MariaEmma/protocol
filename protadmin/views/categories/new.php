<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>              
                <div class="panel panel-default"> 
                    <div class="panel-heading">Δημιουργία Νέας κατηγορίας αρχειοθέτησης
                    </div>
                    <div class="panel-body">
                        
                        <div class="row">
                                <div class="col-md-12">
                                                <?php $attributes = array('id' => 'categorynewform'); ?>
                                                <?php echo form_open('backend/category/new', $attributes); ?>
                                                <?php echo form_fieldset('Στοιχεία κατηγορίας'); ?>
<div class="col-md-6">
    <div class="form-group"> 
<?php if(isset($_POST['title'])) $set1 = $_POST['title']; else $set1='';?>
<?php echo form_error('title');?> 
<?php echo form_label('Τίτλος κατηγορίας', 'title', array(
                                             
                                              )); ?>
<?php echo form_input(array(
                           'name'        => 'title',
                           'id'          => 'title',
                           'tabindex'    => '1',
                           'placeholder' => 'Εισάγετε τίτλο κατηγορίας',
                           'class'       => 'form-control',
                            'value'       => $set1,
                           ));?> 
</div>       
<div class="form-group"> 
<?php if(isset($_POST['description'])) $set1 = $_POST['description']; else $set1='';?>
<?php echo form_error('description');?> 
<?php echo form_label('Περιγραφή', 'description', array(
                                             
                                              ));  ?>  
         
<?php echo form_textarea(array(
                            'name'        => 'description',
                            'id'          => 'description',
                            'tabindex'    => '2',
                            'placeholder' => 'Εισάγετε περιγραφή',
                            'class'       => 'form-control',
                            'value'       => $set1,
                            ));?>
</div>       

<?php echo form_button(array(
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'true',
                                        'tabindex'    => '3',
                                        'type' => 'submit',
                                        'content' => 'Απoθήκευση',
                                        'class' => 'btn btn-primary'
)); ?>  </div>                                             
<?php echo form_fieldset_close(); ?>
<?php echo form_close();?> 
                    </div></div>
                
                
                
                                            </div><!--span11 -->
  
</div> 
				</div><!--/span-->
			
			</div><!--/row--> 
    </div>
</div>






				
			