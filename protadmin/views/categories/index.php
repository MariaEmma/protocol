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
                            <a title="Κάντε κλικ για δημιουργία νέας κατηγορίας." data-rel="tooltip" class="btn btn-warning" href="/backend/category/new">
                            Νέα Κατηγορία αρχειοθέτησης</a> 
                        </div>
                        <div class="table-responsive">
                            <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                
                                 <?php if($categories->exists()){ ?>
                        <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr role="row">
            <th class="sorting_asc" scope="col">Α/Α</th>
            <th class="sorting" scope="col">Τίτλος</th>
            <th class="sorting" scope="col">Περιγραφή</th>
            <th width="170" class="sorting" scope="col">Ενέργειες</th>
                                         		
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($categories as $b) :?>
            <tr>
                <td><?php echo $b->id;?></td>
                <td><?php echo $b->title ;?></td>
                <td><?php echo $b->description ;?></td>
                
                    <td class="center">
                         <div style="line-height: 32px;">
                            <a class="btn btn-warning"  title="Επεξεργασία" href="/backend/category/update/<?php echo $b->id;?>">
                                    <i class="fa fa-edit"></i>                                            
                            </a>
                            <a class="btn btn-info"  href="/backend/category/delete/<?php echo $b->id;?>" onclick="return confirm('Eίστε σίγουροι για την διαγραφή;')" title="Διαγραφή">
                                    <i class="fa fa-trash-o"></i>
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
                    Δεν υπάρχουν κατηγορίες προς το παρόν.
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