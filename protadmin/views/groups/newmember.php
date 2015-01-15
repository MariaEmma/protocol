<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>              
                <div class="panel panel-default"> 
                    <div class="panel-heading">Προσθήκη μέλους στην ομάδα <?php echo $group->title; ?>
                    </div>
                    <div class="panel-body">
                        
                        <div class="row">
                                <div class="col-md-12">
                                                <?php $attributes = array('id' => 'groupnewform'); ?>
                                                <?php echo form_open('backend/group/newmember/'.$group->id, $attributes); ?>
                                                <?php echo form_fieldset('Επιλογή χρήστη'); ?>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <?php echo form_error('user_id');?>
                                        <?php echo form_label('Χρήστης', 'user_id', array(

                                                                                      ));?>
                                        <?php $js = 'id = "user_id" name="user_id" tabindex = "1" class="form-control"';
                                        $options=array('0'=>'- Μην αφήσετε κενή επιλογή -');
                                        
                                        foreach($users as $one):
                                          $options[$one->id] = $one->lastname.' '.$one->firstname;  
                                        endforeach;
                                        echo form_dropdown('user_id', $options, 0, $js);?> 
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






				
			