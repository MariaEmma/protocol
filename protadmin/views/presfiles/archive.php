<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="panel panel-default">
                    
                    <div class="panel-heading">Αρχειοθετημένα Αρχεία
                    </div>
                    <div class="panel-body">					
                        
                        
                        
                        <div class="table-responsive">
                            <div class="bycategory">
                                <form action="categorychoice.php">
                                    <select name="categorychoice" onchange="getCategory(this.value)">
                                        <option>Όλες οι κατηγορίες</option>
                                        <?php 
                                        $categories = new Category();
                                        $categories->getCategories();
                                        foreach($categories as $onecat): ?>
                                        <option value="<?php echo $onecat->id?>"><?php echo $onecat->title?></option>;  
                                     <?php endforeach; ?>
                                    </select>
                                </form>
<!--                         <?php //if(isset($_POST['category_choice'])) $set1 = $_POST['category_choice']; else $set1='';?>   
                        <?php// echo form_error('category_choice');?>
                        <div class="controls">
                            //<?php //$js ='id = "category_choice" name="category_choice" tabindex = "31" data-rel="chosen" style="width:200px"';
//                            $options=array(0=>'Όλες οι κατηγορίες');
//                            $categories = new Category();
//                            $categories->getCategories();
//                            foreach($categories as $onecat):
//                              $options[$onecat->id] = $onecat->title;  
//                            endforeach;
//                            echo form_dropdown('category_choice', $options, 0, $js);?>
                        </div>-->
                    </div>
                    
                         <?php echo form_close();?>
                            </div>
 
                          <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <?php if($eggrafes->exists()){ ?>
                            <table id="dataTables-archive" class="table table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                    <tr role="row">

                                        <th class="sorting" scope="col">Αποστολέας</th>
                                        <th class="sorting" scope="col">Περιγραφή</th>
                                        <th class="sorting" scope="col">Ημερομηνία</th>
                                        <th class="sorting" scope="col">Kατάσταση</th>
                                        <th class="sorting" scope="col">Kατηγορία αρχειοθέτησης</th>
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
                 <td class="categorychoice">
                     <?php 
                     $ks = new User_file();
                     $ksid = $ks->getUserFile($ontotita->id,$b->id);
                     $ksnew = new User_file($ksid);
                     $category = new Category($ksnew->category_id);
                     echo $category->title;
                     ?>    
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