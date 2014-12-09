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
            <th class="sorting" scope="col">Περιγραφή</th>
            <th class="sorting" scope="col">Ημερομηνία</th>
            <th class="sorting" scope="col">Kατάσταση</th>
            <th class="sorting" scope="col">Επιλέξτε κατηγορία αρχειοθέτησης</th>
            <th class="sorting" scope="col">Αρχείο</th>
                                         		
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($eggrafes as $b) :?>
            <tr>
                <td><?php echo $b->sender_name;?></td>
                <td><?php echo $b->description;?></td>
                 <td><?php if ($b->created_date!=null) echo date("d/m/Y", strtotime($b->created_date));?></td>  
                 <td><?php  if ($b->is_protocol == 1) {;?> 
                    <span class="label label-success">Πρωτοκολλημένο</span>
                    <?php } else { ?> <span class="label label-danger">Μη Πρωτοκολλημένο</span>
                    <?php } ?>
                 <?php if ($b->is_president == 1) {;?> 
                    <span class="label label-info">Χρεωμένο από Πρόεδρο</span>
                 <?php }; ?>
                 </td>
                 <td>
                       
                        <?php $attributes = array('class'=>'form-horizontal', 'id' => 'requestnewform'); ?>
                        <?php echo form_open('backend/suser/store/'.$ontotita->id.'/'.$b->id, $attributes); ?>
                        <div class="control-group"> 
                            <?php echo form_error('categoryid');?>

                            <div class="controls">
                            <?php $js = 'id = "categoryid" name="categoryid" tabindex = "1" data-rel="chosen" ';
                            $options=array('0'=>'- Αρχειοθέτηση -');
                            $allcategories = new Category();
                            $allcategories->getCategories();
                            foreach($allcategories as $onecat):
                              $options[$onecat->id] = $onecat->title;  
                            endforeach;
                            echo form_dropdown('categoryid', $options, 0, $js);?> 
                            </div>       
                        </div>
                      <div style="padding-top:10px;"></div>
                     <div class="form-actions">
                        <?php echo form_button(array(
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'true',
                                        'tabindex' => '2',
                                        'type' => 'submit',
                                        'content' => '<i class="fa fa-archive"></i>',
                                        'class' => 'btn btn-primary'
                        )); ?>
                        </div>    
                        <?php echo form_fieldset_close(); ?>
                        <?php echo form_close();?>
                  </td>
                  <td class="center">
                     <a class="btn btn-warning"  title="Προβολή" href="<?php echo MY_FILEFOLDER.$b->upload_file;?>">
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

    </div><!--page inner end-->
    
</div><!--page wrapper end-->