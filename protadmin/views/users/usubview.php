<div class="form-group"> 
                                              <?php echo form_error('usertype_id');?>
                                              <?php echo form_label('Είδος Χρήστη', 'usertype_id', array(

                                                                                            ));?>
                                              <?php $js = 'id = "usertypeid" disabled="disabled " name="usertype_id" tabindex = "4" class="form-control" onchange="return onSelectChange();" value ="'.$ontotita2->usertype_id.'"';
                                              $options=array('0'=>'- Μην αφήσετε κενή επιλογή -');
                                              $usrtype = new Usertype();

                                              foreach($usrtype->getAllUsertypes() as $one):
                                                $options[$one->id] = $one->title;  
                                              endforeach;
                                              echo form_dropdown('usertypeid', $options, $ontotita2->usertype_id, $js);?> 
                                          </div>
                                          <div class="form-group" > 
                                              <?php echo form_error('school_id');?>
                                              <?php echo form_label('Σχολή', 'school_id', array(

                                                                                            ));?>
                                              <?php $js2 = 'disabled="disabled " id = "school_id" name="school_id" tabindex = "5" class="form-control" value ="'.$ontotita2->school_id.'"';
                                              $options2=array('0'=>'- Επιλέξτε Σχολή -');
                                              $usr = new User();

                                              foreach($usr->getSchoolUsers() as $oneusr):
                                                $options2[$oneusr->id] = $oneusr->firstname.' ('.$oneusr->lastname.')';  
                                              endforeach;
                                              echo form_dropdown('school_id', $options2, $ontotita2->school_id, $js2);?> 
                                          </div>
