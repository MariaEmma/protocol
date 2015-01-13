<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="panel panel-default">
                    
                    <div class="panel-heading">Δικαιώματα διαχείρισης
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive col-md-10 col-md-offset-1">
                            <div id="dataTables-files_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <div class="alert alert-warning padding-break">
                                    <?php 
                                            $usr = new User();
                                            if($usr->getVicepresidentIncharge()->exists())
                                            {
                                                $ypeythinos = $usr->getVicepresidentIncharge()->id;
                                                $vicepr = $usr->getVicepresidentIncharge();
                                                echo "Έχετε παραχωρήσει δικαιώματα διαχείρισης στον Αντιπρόεδρο: ".$vicepr->lastname.' '.$vicepr->firstname;
                                            ?>
                                    <div class="padding-break"> 
                                        <a class="btn btn-danger"  title="Αφαίρεση Δικαιωμάτων" href="/backend/president/removeaccess/<?php echo $ontotita->id;?>/<?php echo $ypeythinos;?>">
                                            <i class="fa fa-times-circle-o"> Αφαίρεση δικαιωμάτων</i>                                            
                                        </a>
                                    </div>
                                            <?php 
                                            }
                                            else 
                                            {
                                                $ypeythinos = 0;
                                                echo "Δεν έχετε παραχωρήσει δικαιώματα διαχείρισης σε Αντιπρόεδρο επιλέξτε από την παρακάτω φόρμα";
                                           ?>
                                    
                                </div>
                                <?php $attributes = array('id' => 'requestnewform'); ?>
                                <?php echo form_open('backend/president/grantaccess/'.$ontotita->id, $attributes); ?>
                                <div class="control-group padding-break"> 
                                    <?php echo form_error('userid');?>
                                    <?php echo form_label('Επιλέξτε τον αντιπρόεδρο που θέλετε να του παραχωρήσετε τα δικαιώματα', 'userid', array(
                                             'class' => 'control-label',
                                             'for' => 'userid',
                                              ));?>
                                    <div class="controls padding-break">
                                        
                                            <?php $js = 'id = "userid" name="userid" tabindex = "1" value ="'.$ypeythinos.'" data-rel="chosen" ';
                                                $options=array('0'=>'- Μην αφήσετε κενή επιλογή -');
                                                $allvicepres = new User();
                                                $allvicepres->getAllVicepresidents();
                                                foreach($allvicepres as $oneuser):
                                                  $options[$oneuser->id] = $oneuser->lastname." ".$oneuser->firstname;  
                                                endforeach;
                                                echo form_dropdown('userid', $options, $ypeythinos, $js);?>
                                    </div>       
                                </div> 
                                <div class="padding-break"></div>
                                <?php echo form_button(array(
                                        'name' => 'button',
                                        'id' => 'button',
                                        'value' => 'true',
                                        'tabindex'    => '2',
                                        'type' => 'submit',
                                        'content' => 'Υποβολή',
                                        'class' => 'btn btn-danger'
                                )); ?>


                                <?php echo form_close();?> 
                                <?php } ?>     
                            </div>
                        </div>
                    </div>
                </div>

            </div>    
        </div>

    </div><!--page inner end-->
    
</div><!--page wrapper end-->