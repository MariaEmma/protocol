<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>
                
                <div class="panel panel-default"> 
                    <div class="panel-heading">Υπάρχοντες Χρήστες
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                
                                 <?php if($eggrafes->exists()){ ?>
                        <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr role="row">
            <th class="sorting_asc" scope="col">Α/Α</th>
            <th class="sorting" scope="col">Ονοματεπώνυμο</th>
            <th class="sorting" scope="col">Όνομα Χρήστη</th>
            <th class="sorting" scope="col">Ιδιότητα</th>
            <th class="sorting" scope="col">Στοιχεία</th>
            <th width="170" class="sorting" scope="col">Ενέργειες</th>
                                         		
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($eggrafes as $b) :?>
            <tr>
                <td><?php echo $b->id;?></td>
                <td><?php echo $b->lastname.' '.$b->firstname;?></td>
                <td><?php echo $b->username;?></td>
                <td><?php echo $b->usertype->get()->title;?></td>
                 <td><?php echo 'Τηλ:'.$b->phone;?><br/>
                     <a href="mailto:<?php echo $b->email;?>">Στείλτε email</a><br/>
                     <?php if ($b->active==0) echo '<span class="label label-danger">Ανενεργός</span>'; else echo '<span class="label label-success">Ενεργός</span>'?></td>
                    <td class="center">
                         <div style="line-height: 32px;">
                            <a class="btn btn-warning"  title="Επεξεργασία" href="/backend/user/update/<?php echo $b->id;?>">
                                    <i class="fa fa-edit"></i>                                            
                            </a>
                            <?php if ($b->usertype_id!=1 && $b->usertype_id!=3 && $b->usertype_id!=4){?>
                           <?php if ($b->active==0){?>
                           <a class="btn btn-success"  href="/backend/user/activate/<?php echo $b->id;?>"  title="Ενεργοποίηση">
                                    <i class="fa fa-check-square-o"></i>
                            </a><?php } else {?>
                             <a class="btn btn-danger" href="/backend/user/deactivate/<?php echo $b->id;?>"  title="Απενεργοποίηση">
                                    <i class="fa fa-square-o"></i>
                            </a><?php } }?>
                             <?php if ($b->usertype_id!=1 && $b->usertype_id!=3 && $b->usertype_id!=4){?>
                            <a class="btn btn-info"  href="/backend/user/delete/<?php echo $b->id;?>" onclick="return confirm('Eίστε σίγουροι για την διαγραφή;')" title="Διαγραφή">
                                    <i class="fa fa-trash-o"></i>
                            </a><?php } ?>
                              <?php if ($b->usertype_id!=1){?>
                             <a class="btn btn-default" href="/backend/user/changepass/<?php echo $b->id;?>"  title="Αποστολή στο χρήστη νέου κωδικού">
                                <i class=" fa fa-key"></i>
                                </a>
                              <?php } ?>
                         </div>
                    </td>
            </tr>
            <?php endforeach; ?>
      </tbody>
</table>         
                    <?php }   else { ?>
    <div class="alert alert-info alert-dismissable">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                    <strong>Προσοχή!</strong>
                    Δεν υπάρχουν χρήστες προς το παρόν.
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