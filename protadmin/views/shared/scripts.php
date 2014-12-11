<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?php echo $resources;?>js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo $resources;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $resources;?>js/chosen.jquery.js"></script>
    <script src="<?php echo $resources;?>js/bootstrap-datepicker.js"></script>
    <script src="<?php echo $resources;?>js/bootstrap-editable.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo $resources;?>js/jquery.metisMenu.js"></script>
         <!-- MORRIS CHART SCRIPTS -->
   <!--  <script src="<?php //echo $resources;?>js/morris/raphael-2.1.0.min.js"></script>-->
    <!-- <script src="<?php // echo $resources;?>js/morris/morris.js"></script> -->
   
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo $resources;?>js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo $resources;?>js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-files').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
         <script>
$('.inline-editable').editable({
    selector: 'a.editable-click',
    type: 'text',
    url: "<?php echo site_url('protfiles/updateprotocol');?>",
    title: 'Επεξεργασία τιμής',
    mode:'inline',
});
</script>
    <script src="<?php echo $resources;?>js/custom.js"></script>
    