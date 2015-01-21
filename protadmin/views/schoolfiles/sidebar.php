<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <?php $typos = new Usertype($ltype);
                                $imagebcd = array(
                                        'src' => MY_IMAGEFOLDER.$typos->logo,
                                        'width'  => '128',
                                        'alt' => $typos->title,
                                        'title' => $typos->title,
                                        'class'=> 'user-image img-responsive'
                                );?>
                                <?php echo img($imagebcd);?>
            </li>
            <li>
                <a  href="/backend/school/input/<?php echo $ontotita->id;?>"><i class="fa fa-folder fa-2x"></i>Εισερχόμενα Αρχεία</a>
            </li>
            <li>
                <a  href="/backend/school/upload/<?php echo $ontotita->id;?>"><i class="fa fa-file-text fa-2x"></i>Αποστολή Αρχείου</a>
            </li>
            <li>
                <a  href="/backend/user/update/<?php echo $ontotita->id;?>"><i class="fa fa-refresh fa-2x"></i>Επεξεργασία προφίλ</a>
            </li>
        </ul>
    </div>
</nav> 		