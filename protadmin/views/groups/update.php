 <div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>              
                <div class="panel panel-default"> 
                    <div class="panel-heading">Επεξεργασία ομάδας χρηστών
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php $attributes = array('id' => 'groupupdateform'); ?>
                                <?php echo form_open('backend/group/update/'.$group->id, $attributes); ?>
                                <?php echo form_fieldset('Στοιχεία ομάδας χρηστών'); ?>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <?php echo form_error('title');?> 
                                        <?php echo form_label('Tίτλος κατηγορίας', 'title', array(

                                                                                      )); ?>
                                        <?php echo form_input(array(
                                                                   'name'        => 'title',
                                                                   'id'          => 'title',
                                                                   'tabindex'    => '1',
                                                                   'placeholder' => 'Εισάγετε τίτλο κατηγορίας',
                                                                   'class'       => 'form-control',
                                                                    'value'       => $group->title,                           
                                                                   ));?> 
                                    </div>       
                                        <?php echo form_button(array(
                                                                    'name' => 'button',
                                                                    'id' => 'button',
                                                                    'value' => 'true',
                                                                    'tabindex'    => '2',
                                                                    'type' => 'submit',
                                                                    'content' => 'Απoθήκευση',
                                                                    'class' => 'btn btn-primary'
                                        )); ?>
                                </div> 
                                    <?php echo form_fieldset_close(); ?>
                                    <?php echo form_close();?>
                            </div>
                        </div>
                    </div><!--span11 -->
                </div>
            </div><!--/span-->
        </div><!--/row--> 
    </div>
</div>
		