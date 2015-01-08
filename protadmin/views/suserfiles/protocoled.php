<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="panel panel-default">
                    
                    <div class="panel-heading">Πρωτοκολλημένα αιτήματα προς αποστολή                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                
                                 <?php if($eggrafes->exists()){ ?>
                        <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr role="row">
            <th class="sorting_asc" scope="col">Περιγραφή</th>
            <th class="sorting" scope="col">Αριθμός πρωτοκόλλου</th>
            <th class="sorting" style="width: 100px;"scope="col">Ημερομηνία πρωτοκόλλου</th>
            <th class="sorting" scope="col">Ενέργειες</th>
                                         		
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($eggrafes as $b) :?>
            <tr>
                 <td><?php echo $b->description;?></td>
                 <td><?php if ($b->is_protocol == 1) echo '<span class="label label-success">Πρωτοκολλημένο</span><br/>Αριθμός: '.$b->protocol_no;?></td>
                 <td><?php if ($b->protocol_date!=null) echo date("d/m/Y", strtotime($b->protocol_date));?></td>  
                 
                 <td>     
                    <?php $attributes = array('class'=>'form-horizontal', 'id' => 'suserupform'); ?>
                    <?php echo form_open_multipart('backend/suser/upload/'.$ontotita->id.'/'.$b->id, $attributes); ?>
                    
                     <div class="control-group">        
                        <?php echo form_label('Επιλογή αρχείου', 'userfile', array(
                             'for' => 'userfile',
                              ));  ?>
                        <?php echo form_upload(array(
                                    'name'        => 'userfile',
                                    'id'          => 'userfile',
                                    'tabindex'    => '1',
                                    'class'       => '',
                                    ));?>
                     </div>
                     <div class="control-group" style="padding-top:10px;">
                        <?php if(isset($_POST['usersid'])) $set1 = $_POST['usersid']; else $set1='';?>   
                        <?php echo form_error('usersid');?>
                        <div class="controls">
                            <?php $js ='id = "usersid" multiple name="usersid" tabindex = "2" data-rel="chosen" style="width:200px"';
                            $options=array();
                            $allusers = new User();
                            $allusers->getUsers();
                            foreach($allusers as $oneuser):
                              $options[$oneuser->id] = $oneuser->lastname.' '.$oneuser->firstname;  
                            endforeach;
                            echo form_dropdown('usersid[]', $options, 0, $js);?>
                        </div>
                    </div>
                    <div class="form-actions" style="padding-top:10px;">
                        <?php echo form_button(array(
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'true',
                                        'tabindex' => '2',
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