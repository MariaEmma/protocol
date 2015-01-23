<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="panel panel-default">
                    
                    <div class="panel-heading">Πρωτοκολλημενα Αρχεία
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                
                                 <?php if($eggrafes->exists()){ ?>
                        <table id="dataTables-files" class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
        <tr role="row">
            
            <th class="sorting" scope="col">Αποστολέας</th>
            <th class="sorting" scope="col">Παραλήπτες</th>
            <th class="sorting" scope="col">Θέμα</th>
            <th class="sorting" scope="col">Αριθμός Πρωτοκόλλου</th>
            <th class="sorting" scope="col">Ημερομηνία</th> 
            <th class="sorting" scope="col">Αρχείο</th> 
        </tr>
      </thead>   
      <tbody>
          <?php foreach ($eggrafes as $b) :?>
            <tr>
                 <td><?php echo $b->sender_name;?></td>
                 <td><?php $receivers = $b->getFileReceiver();
                      foreach ($receivers as $onereceiver) {
                        echo $onereceiver->lastname.' '.$onereceiver->firstname.'<br/>'; 
                       };?>
                 </td>
                 <td><?php echo $b->description;?></td>
                 <td><?php echo $b->protocol_no;?></td>
                 <td><?php if ($b->created_date!=null) echo date("d/m/Y", strtotime($b->created_date));?></td>  
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