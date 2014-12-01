<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"><h4>Βρίσκεστε: <span style="color:green;"><?php echo $mtitle;?></span></h4> 
                <?php echo $this->session->flashdata('msg'); ?>              
                <div class="panel panel-default"> 
                    <div class="panel-heading">Δημιουργία Νέου Χρήστη
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php $attributes = array('id' => 'usernewform'); ?>
                                <?php echo form_open('backend/user/new', $attributes); ?>
                                <?php echo form_fieldset('Στοιχεία χρήστη'); ?>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <?php if(isset($_POST['username'])) $set1 = $_POST['username']; else $set1='';?>
                                        <?php echo form_error('username');?> 
                                        <?php echo form_label('Όνομα χρήστη', 'username', array(
                                                                                     'for' => 'username',
                                                                                      )); ?>
                                        <?php echo form_input(array(
                                                                   'name'        => 'username',
                                                                   'id'          => 'username',
                                                                   'tabindex'    => '1',
                                                                   'placeholder' => 'Εισάγετε όνομα χρήστη',
                                                                   'class'       => 'form-control',
                                                                    'value'       => $set1,
                                                                   ));?> 
                                    </div>       
                                    <div class="form-group"> 
                                        <?php if(isset($_POST['firstname'])) $set1 = $_POST['firstname']; else $set1='';?>
                                        <?php echo form_error('firstname');?> 
                                        <?php echo form_label('Όνομα', 'firstname', array(
                                                                                     'for' => 'firstname',
                                                                                      ));  ?>  

                                        <?php echo form_input(array(
                                                                    'name'        => 'firstname',
                                                                    'id'          => 'firstname',
                                                                    'tabindex'    => '2',
                                                                    'placeholder' => 'Εισάγετε όνομα',
                                                                    'class'       => 'form-control',
                                                                    'value'       => $set1,
                                                                    ));?>
                                    </div>       
                                    <div class="form-group">
                                        <?php if(isset($_POST['lastname'])) $set1 = $_POST['lastname']; else $set1='';?>
                                        <?php echo form_error('lastname');?> 
                                        <?php echo form_label('Επώνυμο', 'lastname', array(
                                                                                     'for' => 'lastname',
                                                                                      ));  ?>          
                                        <?php echo form_input(array(
                                                                    'name'        => 'lastname',
                                                                    'id'          => 'lastname',
                                                                    'tabindex'    => '3',
                                                                    'placeholder' => 'Εισάγετε επώνυμο',
                                                                    'class'       => 'form-control',
                                                                    'value'       => $set1,
                                                                    ));?>     
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <?php echo form_error('usertype_id');?>
                                        <?php echo form_label('Είδος Χρήστη', 'usertype_id', array(

                                                                                      ));?>
                                        <?php $js = 'id = "usertypeid" name="usertype_id" tabindex = "4" class="form-control" onchange="return onSelectChange();"';
                                        $options=array('0'=>'- Μην αφήσετε κενή επιλογή -');
                                        $usrtype = new Usertype();

                                        foreach($usrtype->getListboxUsertypes() as $one):
                                          $options[$one->id] = $one->title;  
                                        endforeach;
                                        echo form_dropdown('usertypeid', $options, 0, $js);?> 
                                    </div>
                                    <div class="form-group" > 
                                        <?php echo form_error('school_id');?>
                                        <?php echo form_label('Σχολή', 'school_id', array(

                                                                                      ));?>
                                        <?php $js2 = 'disabled="disabled "id = "school_id" name="school_id" tabindex = "5" class="form-control"';
                                        $options2=array('0'=>'- Επιλέξτε Σχολή -');
                                        $usr = new User();

                                        foreach($usr->getSchoolUsers() as $oneusr):
                                          $options2[$oneusr->id] = $oneusr->firstname.' ('.$oneusr->lastname.')';  
                                        endforeach;
                                        echo form_dropdown('school_id', $options2, 0, $js2);?> 
                                    </div>
                                    <div class="form-group">
                                        <?php if(isset($_POST['phone'])) $set1 = $_POST['phone']; else $set1='';?>
                                        <?php echo form_error('phone');?> 
                                        <?php echo form_label('Τηλέφωνο', 'phone', array(
                                                                                     'for' => 'phone',
                                                                                      )); ?>
                                        <?php echo form_input(array(
                                                                'name'        => 'phone',
                                                                'id'          => 'phone',
                                                                'tabindex'    => '5',
                                                                'placeholder' => 'Εισάγετε τηλέφωνο',
                                                                'class'       => 'form-control',
                                                                'value'       => $set1,
                                                               ));?>     
                                    </div> 
                                    <div class="form-group"> 
                                        <?php echo form_error('email');?> 
                                        <?php echo form_label('Ηλ. διεύθυνση', 'email', array(
                                                                                     'for' => 'email',
                                                                                      )); ?>
                                        <?php echo form_input(array(
                                                               'name'        => 'email',
                                                               'id'          => 'email',
                                                               'tabindex'    => '6',
                                                               'placeholder' => 'Εισάγετε την ηλ. σας διεύθυνση',
                                                               'class'       => 'form-control',
                                                               ));?>      
                                    </div>
                                        <?php echo form_button(array(
                                            'name' => 'button',
                                            'id' => 'button',
                                            'value' => 'true',
                                            'tabindex'    => '7',
                                            'type' => 'submit',
                                            'content' => 'Απoθήκευση',
                                            'class' => 'btn btn-primary'
                                            )); ?>  </div>                                             
                                                <?php echo form_fieldset_close(); ?>
                                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div><!--span11 -->
                </div> 
            </div><!--/span-->
        </div><!--/row-->
    </div>
</div>






				
			