<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <?php $typos = new Usertype($ltype);
                                $imagebcd = array(
                                        'src' => MY_IMAGEFOLDER.$typos->logo,
                                        'width'  => '128',
                                        'alt' => 'Γραμματεία',
                                        'title' => 'Γραμματεία',
                                        'class'=> 'user-image img-responsive'
                                );?>
                                <?php echo img($imagebcd);?>
            </li>
            <li>
                <a  href="/backend/gram/upload/<?php echo $ontotita->id;?>"><i class="fa fa-file-text fa-2x"></i>Αποστολή Αρχείου</a>
            </li>
            <li>
                <a  href="/backend/gram/myown/<?php echo $ontotita->id;?>"><i class="fa fa-folder fa-2x"></i>Απεσταλμένα Αρχεία</a>
            </li>
            <li>
                <a  href="/backend/gram/certified/<?php echo $ontotita->id;?>"><i class="fa fa-check-square fa-2x"></i>Πρωτοκολλημένα Αρχεία</a>
            </li>
            <li>
                <a  href="/backend/user/update/<?php echo $ontotita->id;?>"><i class="fa fa-refresh fa-2x"></i>Επεξεργασία προφίλ</a>
            </li>
        </ul>
    </div>
</nav> 		