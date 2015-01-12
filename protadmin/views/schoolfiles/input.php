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
                                <?php $attributes = array('class'=>'form-horizontal', 'id' => 'schoolbulkform'); ?>
                                <?php echo form_open_multipart('backend/school/bulkupload/'.$ontotita->id, $attributes); ?>
                       
                        <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr role="row">
            <th class="sorting_asc" scope="col">Από</th>
            <th class="sorting" scope="col">Περιγραφή</th>
            <th class="sorting" scope="col">Ημερομηνία αποστολής</th>
            <th class="sorting" scope="col">Αριθμός Πρωτοκόλλου</th>
            <th class="sorting" scope="col">Αρχείο</th>
            <th class="sorting" scope="col">Επιλογή για προώθηση</th>
                                         		
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($eggrafes as $b) :?>
            <tr>
                <td><?php echo $b->sender_name;?></td>
                <td><?php echo $b->description;?></td>
                <td><?php if ($b->created_date!=null) echo date("d/m/Y", strtotime($b->created_date));?></td>  
                <td><?php if ($b->is_protocol!=null) 
                            echo '<span class="strong">Αριθμός:</span> '.$b->protocol_no.'<br/><span class="strong">Ημερομηνία:</span> '.$b->protocol_date;  
                            else echo "Δεν έχει πρωτόκολλο"?>
                     <?php if ($b->is_president == 1) {;?> 
                        <span class="label label-info">Χρεωμένο από Πρόεδρο</span>
                     <?php }; ?>
                </td>
                <td class="center">
                     
                        <a style="margin-top: 5px;" class="btn btn-warning"  title="Προβολή" href="<?php echo MY_FILEFOLDER.$b->upload_file;?>">
                           <i class="fa fa-download"></i>                                            
                        </a>
                 </td>
                 <td class="center">
                   
                      <?php echo form_checkbox(array(
                            'name'        => 'files[]',
                            'id'          => $b->id,
                            'tabindex'    => $b->id,
                            'value'       => $b->id,
                            'class'       => '',
                        ));?>  
                    
                 </td>
                 
            </tr>
            <?php endforeach; ?>
           
      </tbody>
</table>
                          
                
                <div class="alert alert-warning">
                      Επιλέξτε από τα παραπάνω αρχεία όσα θέλετε να επισυνάψετε με ένα νέο δικό σας για προώθηση και προχωρήστε με την παρακάτω φόρμα 
                       <div class="control-group" style="padding-top:10px;padding-bottom:10px;">
                            <?php if(isset($_POST['usersid'])) $set1 = $_POST['usersid']; else $set1='';?>   
                            <?php echo form_error('usersid');?>
                            <?php echo form_label('Επιλογή παραληπτών', 'usersid', array(
                                 'for' => 'usersid',
                                  ));  ?>
                            <div class="controls">
                                <?php $js ='id = "usersid" multiple name="usersid" tabindex = "3" data-rel="chosen" style="width:300px"';
                                $options=array();
                                $allusers = new User();
                                $allusers->getUsers();
                                foreach($allusers as $oneuser):
                                  $options[$oneuser->id] = $oneuser->lastname.' '.$oneuser->firstname;  
                                endforeach;
                                 echo form_dropdown('usersid[]', $options, 0, $js);?>
                            </div>
                           
                        </div> 
                      <div class="control-group">
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
                      <div class="control-group">        
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
                      <div style="padding-top: 10px"></div>
                       <?php echo form_button(array(
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'true',
                                        'tabindex'    => '3',
                                        'type' => 'submit',
                                        'content' => '<i class="fa fa-arrow-right"> Προώθηση</i>',
                                        'class' => 'btn btn-danger'
                            )); ?>                                            
                            
                            <?php echo form_close();?> 
                    
             </div>                         
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