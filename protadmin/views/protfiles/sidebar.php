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
                <a  href="/backend/protocol/input/<?php echo $ontotita->id;?>"><i class="fa fa-folder fa-2x"></i>Εισερχόμενα Αρχεία</a>
            </li>
            <li>
                <a  href="/backend/protocol/requested/<?php echo $ontotita->id;?>"><i class="fa fa-level-down fa-2x"></i>Εισερχόμενα Αιτήματα</a>
            </li>
            <li>
                <a  href="/backend/protocol/certified/<?php echo $ontotita->id;?>"><i class="fa fa-check-square-o fa-2x"></i>Πρωτοκολλημένα Αρχεία</a>
            </li>
            <li>
                <a  href="/backend/user/update/<?php echo $ontotita->id;?>"><i class="fa fa-refresh fa-2x"></i>Επεξεργασία προφίλ</a>
            </li>
           
        </ul>
    </div>
</nav> 		