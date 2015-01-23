 <div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>    
                <div class="panel panel-default">
                    <div class="panel-heading">Αποστολή Αρχείου
                    </div>
                    <div class="panel-body">
                         <?php $attributes = array('id' => 'filenewform'); ?>
                         <?php echo form_open_multipart('backend/school/upload/'.$ontotita->id, $attributes); ?>
                        <div class="control-group" style="padding-top:10px;padding-bottom:10px;">
                            <?php if(isset($_POST['usersid'])) $set1 = $_POST['usersid']; else $set1='';?>   
                            <?php echo form_error('usersid');?>
                            <?php echo form_label('Επιλογή παραληπτών', 'usersid', array(
                                 'for' => 'usersid',
                                  ));  ?>
                            <div class="controls">
                                <?php $js ='id = "usersid" multiple name="usersid" tabindex = "31" data-rel="chosen" style="width:200px"';
                                    $options=array();
                                    $groups = new Group();
                                    $groups-> getAllGroups();
                                    foreach($groups as $onegroup):
                                      $options[$onegroup->id.'-g'] = $onegroup->title;  
                                    endforeach;
                                    $allusers = new User();
                                    $allusers->getUsers();
                                    foreach($allusers as $oneuser):
                                        if($oneuser->id==3 || $oneuser->school_id==$ontotita->id )
                                            $options[$oneuser->id] = $oneuser->lastname.' '.$oneuser->firstname;  
                                    endforeach;
                                    echo form_dropdown('usersid[]', $options, 0, $js);?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php if(isset($_POST['description'])) $set1 = $_POST['description']; else $set1='';?>
                            <?php echo form_error('description');?> 
                            <?php echo form_label('Θέμα', 'description', array(
                                                    'for' => 'description',
                                                   ));  ?>
                            <div class="controls" style="width: 50%;">
                                    <?php echo form_textarea(array(
                                              'name'        => 'description',
                                              'id'          => 'description',
                                              'tabindex'    => '2',
                                              'value'       => $set1,
                                              'placeholder' => 'Εισάγετε Θέμα',
                                              'class'       => 'form-control',
                                              'rows'        => '2'
                                            ));?>
                             </div>
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
                        <div class="padding-break">
                           <div class="panel panel-info">
                               <div class="panel-heading">Απεσταλμένα αρχεία
                               </div>
                               <div class="panel-body">
                                    <div class="table-responsive">
                                        <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                              <?php if($eggrafes->exists()){ ?>
                                                <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting_asc" scope="col">Προς</th>
                                                            <th class="sorting" scope="col">Θέμα</th>
                                                            <th class="sorting" scope="col">Ημερομηνία αποστολής</th>
                                                            <th class="sorting" scope="col">Ενέργειες</th>
                                                        </tr>
                                                    </thead>   
                                                    <tbody>
                                                        <?php foreach ($eggrafes as $b) :?>
                                                        <tr>
                                                            <td><?php 
                                                            $receivers = $b->getFileReceiver();
                                                            foreach ($receivers as $onereceiver) {
                                                               echo $onereceiver->lastname.' '.$onereceiver->firstname.'<br/>'; 
                                                            };?>
                                                            </td>
                                                            <td><?php echo $b->description;?></td>
                                                            <td><?php if ($b->created_date!=null) echo date("d/m/Y", strtotime($b->created_date));?></td>  
                                                            <td class="center"><a class="btn btn-warning"  title="Προβολή" href="<?php echo MY_FILEFOLDER.$b->upload_file;?>">
                                                                                <i class="fa fa-download"></i>                                            
                                                                        </a>      
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
                </div>
            </div>
        </div>
    </div>
 </div>