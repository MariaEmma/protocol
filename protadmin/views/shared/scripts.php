<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?php echo $resources;?>js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo $resources;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $resources;?>js/chosen.jquery.js"></script>
     <script src="<?php echo $resources;?>js/jquery.dynatable.js"></script>
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
    <script>
            $(document).ready(function () {
                $('#dataTables-archive').dataTable();
            });
    </script>
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
<?php if(isset($ontotita)){?>
    <script type="text/javascript">
$(document).ready(function()
{
    $("#category_choice").change(function()
    {
        var id=$(this).val();
        var user = <?php echo $ontotita ;?>;
        var dataString = 'id=' + id + '&user=' + user;


        $.ajax
        ({
            type: "POST",
            url: "<?php echo site_url('categories/findfilescategories'); ?>",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $("#dataTables-archive_wrapper").html(html);
            }
        });

    });

});
</script>
<?php } ?>   