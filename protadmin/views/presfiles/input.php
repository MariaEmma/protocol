<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="panel panel-default">
                    
                    <div class="panel-heading">Εισερχόμενα Αρχεία
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                
                                 <?php if($eggrafes->exists()){ ?>
                        <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr role="row">
            
            <th class="sorting" scope="col">Αποστολέας</th>
            <th class="sorting" scope="col">Θέμα</th>
            <th class="sorting" scope="col">Ημερομηνία</th>   
            <th class="sorting" scope="col">Παραλήπτες για προώθηση</th>
<!--            <th class="sorting" scope="col">Επιλέξτε κατηγορία αρχειοθέτησης</th>-->
            <th class="sorting" scope="col">Αρχείο</th>
                                         		
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($eggrafes as $b) :?>
            <tr>
                <td><?php echo $b->sender_name;?></td>
                <td><?php echo $b->description;?></td>
                <td><?php if ($b->created_date!=null) echo date("d/m/Y", strtotime($b->created_date));?></td>  
                <td>     
                    <?php $attributes = array('class'=>'form-horizontal', 'id' => 'presidentsendform'); ?>
                    <?php echo form_open('backend/president/send/'.$ontotita->id.'/'.$b->id, $attributes); ?>
                    <div class="control-group" style="padding-top:10px;">
                        <?php if(isset($_POST['usersid'])) $set1 = $_POST['usersid']; else $set1='';?>   
                        <?php echo form_error('usersid');?>
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
<!--                <td>
                    <?php //$attributes = array('class'=>'form-horizontal', 'id' => 'requestnewform'); ?>
                    <?php //echo form_open('backend/president/store/'.$ontotita->id.'/'.$b->id, $attributes); ?>
                    <div class="control-group"> 
                        <?php //echo form_error('categoryid');?>

                        <div class="controls top-space">
                        <?php // $js = 'id = "categoryid" name="categoryid" tabindex = "1" data-rel="chosen"';
//                        $options=array('0'=>'- Αρχειοθέτηση -');
//                        $allcategories = new Category();
//                        $allcategories->getCategories();
//                        foreach($allcategories as $onecat):
//                          $options[$onecat->id] = $onecat->title;  
//                        endforeach;
                       // echo form_dropdown('categoryid', $options, 0, $js);?> 
                        </div>       
                    </div> 
                    <div class="form-actions top-space">
                        <?php // echo form_button(array(
//                                    'name' => 'button',
//                                    'id' => 'button',
//                                    'value' => 'true',
//                                    'tabindex' => '2',
//                                    'type' => 'submit',
//                                    'content' => '<i class="fa fa-archive"></i>',
//                                    'class' => 'btn btn-primary'
                      //  )); ?>
                    </div>    
                    <?php // echo form_fieldset_close(); ?>
                    <?php //echo form_close();?>
                </td>-->
                
                  <td class="center">
                     <a class="btn btn-warning"  title="Προβολή" href="<?php echo MY_FILEFOLDER.$b->upload_file;?>">
                        <i class="fa fa-download"></i>                                            
                     </a>
                      <a class="btn btn-danger"  href="/backend/president/delete/<?php echo $ontotita->id;?>/<?php echo $b->id;?>" onclick="return confirm('Eίστε σίγουροι για την διαγραφή;')" title="Διαγραφή">
                            <i class="fa fa-trash-o"></i>
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

    </div><!--page inner end-->
    
</div><!--page wrapper end-->