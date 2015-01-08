<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="panel panel-default">
                    
                    <div class="panel-heading">Εισερχόμενα Αιτήματα
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                
                                 <?php if($eggrafes->exists()){ ?>
                        <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr role="row">
            
            <th class="sorting" scope="col">Αποστολέας</th>
            <th class="sorting" scope="col">Περιγραφή</th>
            <th class="sorting" scope="col">Ημερομηνία</th>
            <th class="sorting" scope="col">Αριθμός Πρωτοκόλλου</th>                            		
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($eggrafes as $b) :?>
            <tr>
                 <td><?php echo $b->sender_name;?></td>
                 <td><?php echo $b->description;?></td>
                 <td><?php if ($b->created_date!=null) echo date("d/m/Y", strtotime($b->created_date));?></td>  
              <td>
                   
                    <?php $attributes = array('class'=>'form-horizontal', 'id' => 'protocolnewform'); ?>
                    <?php echo form_open('backend/protocol/certify/'.$ontotita->id.'/'.$b->id, $attributes); ?>
                    
                         <div class="span3">
                            <div class="control-group"> 
                               <?php if(isset($_POST['protocol_no'])) $set1 = $_POST['protocol_no']; else $set1='';?>
                               <?php echo form_error('protocol_no');?>  
                               <div class="controls">
                               <?php echo form_input(array(
                                                          'name'        => 'protocol_no',
                                                          'id'          => 'protocol_no',
                                                          'tabindex'    => '1',
                                                          'placeholder' => 'Εισάγετε αριθμό',
                                                          'class'       => 'input-large',
                                                           'value'       => $set1,
                                                          ));?> 
                               </div>       
                            </div>
                             <div class="control-group" style="padding-top:10px;"> 
                                <?php if(isset($_POST['protocol_date'])) $set1 = $_POST['protocol_date']; else $set1='';?>
                                <?php echo form_error('protocol_date');?> 
                               
                                <div class="controls">
                                <?php echo form_input(array(
                                                           'name'        => 'protocol_date',
                                                           'id'          => 'protocol_date',
                                                           'tabindex'    => '2',
                                                           'placeholder' => 'Εισάγετε ημερομηνία',
                                                           'class'       => 'datepicker',
                                                            'value'       => $set1,
                                                           ));?> 
                                </div>
                            </div>
                         </div>
                         
                      
<!--                        <div class="control-group" style="padding-top:10px;">
                            <?php //if(isset($_POST['usersid'])) $set1 = $_POST['usersid']; else $set1='';?>   
                            <?php //echo form_error('usersid');?>
                            <div class="controls">
                                //<?php //$js ='id = "usersid" multiple name="usersid" tabindex = "3" data-rel="chosen" style="width:200px"';
//                                $options=array();
//                                $allusers = new User();
//                                $allusers->getUsers();
//                                foreach($allusers as $oneuser):
//                                  $options[$oneuser->id] = $oneuser->lastname.' '.$oneuser->firstname;  
//                                endforeach;
//                                 echo form_dropdown('usersid[]', $options, 0, $js);?>
                            </div>
                        </div>-->
                        
                   
                     <div class="form-actions" style="padding-top:10px;">
                        <?php echo form_button(array(
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'true',
                                        'tabindex' => '4',
                                        'type' => 'send',
                                        'content' => '<i class="fa fa-share"></i>',
                                        'class' => 'btn btn-primary'
                        )); ?>
                     </div>    
                       
                        <?php echo form_close();?>
                         </td>
            </tr>
            <?php endforeach; ?>
      </tbody>
</table>
                                
                    <?php }   else { ?>
    <div class="alert alert-info alert-dismissable">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                    <strong>Προσοχή!</strong>
                    Δεν υπάρχουν αρχεία προς το παρόν.
                    </div>
<?php }?>   
                            </div>
                        </div>
                    </div>
                </div>

            </div>    
        </div>

    </div><!--page inner end-->
    
</div><!--page wrapper end-->