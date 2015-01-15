<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>
                
                <div class="panel panel-default"> 
                    <div class="panel-heading">Υπάρχουσες κατηγορίες
                    </div>
                    <div class="panel-body">
                        <div style="text-align:right; padding-bottom:10px;">
                            <a title="Κάντε κλικ για επιστροφή στις ομάδες χρηστών." data-rel="tooltip" class="btn btn-primary" href="/backend/group">
                            Ομάδες χρηστών</a> 
                            <a title="Κάντε κλικ για εισαγωγή χρήστη." data-rel="tooltip" class="btn btn-success" href="/backend/group/newmember/<?php echo $group->id ?>">
                            Προσθήκη μέλους</a> 
                        </div>
                        <div class="table-responsive">
                            <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                
                                 <?php if($users->exists()){ ?>
                        <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr role="row"> 
            <th class="sorting" scope="col">Οναματεπώνυμο</th>
            <th class="sorting" scope="col">Τύπος χρήστη</th>
            <th width="170" class="sorting" scope="col">Ενέργειες</th>
                                         		
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($users as $b) :?>
            <tr>
                <td><?php echo $b->lastname.' '.$b->firstname;?></td>
                <td><?php $urt = new Usertype($b->usertype_id) ;
                    echo $urt->title ;?></td>
               
                
                    <td class="center">
                         <div style="line-height: 32px;">
                              
                            <a class="btn btn-danger"  href="/backend/group/delmember/<?php echo $group->id ?>/<?php echo $b->id;?>" onclick="return confirm('Eίστε σίγουροι για την διαγραφή;')" title="Αφαίρεση από ομάδα">
                                    <i class="fa fa-trash-o"> Κατάργηση μέλους</i>
                            </a>
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
                    Δεν υπάρχουν ομάδες χρηστών προς το παρόν.
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