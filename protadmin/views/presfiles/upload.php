 <div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>    
                <div class="panel panel-default">
                    <div class="panel-heading">Αποστολή Αρχείου
                    </div>
                    <div class="panel-body">
                         <?php $attributes = array('id' => 'presfilenewform'); ?>
                         <?php echo form_open_multipart('backend/president/upload/'.$ontotita->id, $attributes); ?>
                   
                    <div class="form-group">
                        <?php if(isset($_POST['description'])) $set1 = $_POST['description']; else $set1='';?>
                        <?php echo form_error('description');?> 
                        <?php echo form_label('Τίτλος-Περιγραφή', 'description', array(
                                                  'for' => 'description',
                                                 ));  ?>
                                     <?php echo form_textarea(array(
                                                'name'        => 'description',
                                               'id'          => 'description',
                                               'tabindex'    => '2',
                                               'value'       => $set1,
                                               'placeholder' => 'Εισάγετε τίτλο - περιγραφή',
                                               'class'       => 'form-control',
                                               'rows'        => '2'
                                             ));?>
                    </div>
 
       
                    <div class="form-group">        
                    <?php echo form_label('Επιλογή αρχείου', 'userfile', array(
                         'for' => 'userfile',
                          ));  ?>
                    <?php echo form_upload(array(
                                'name'        => 'userfile',
                                'id'          => 'userfile',
                                'tabindex'    => '2',
                                'class'       => '',
                                ));?>
                                      </div>

                    <?php echo form_button(array(
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'true',
                                        'tabindex'    => '3',
                                        'type' => 'submit',
                                        'content' => 'Αποστολή',
                                        'class' => 'btn btn-danger'
                    )); ?>

                    <?php echo form_fieldset_close(); ?>
                    <?php echo form_close();?> 
                        
                    </div>
            </div>

        </div>    
    </div>
 </div>
      </div>