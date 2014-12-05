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
                <a  href="/backend/suser/input/<?php echo $ontotita->id;?>"><i class="fa fa-folder fa-2x"></i>Εισερχόμενα Αρχεία</a>
            </li>
            <li>
                <a  href="/backend/suser/output/<?php echo $ontotita->id;?>"><i class="fa fa-check-square fa-2x"></i>Εξερχόμενα Αρχεία</a>
            </li>
            <li>
                <a  href="/backend/suser/upload/<?php echo $ontotita->id;?>"><i class="fa fa-file-text fa-2x"></i>Αποστολή Αρχείου</a>
            </li>
            <li>
                <a  href="/backend/user/update/<?php echo $ontotita->id;?>"><i class="fa fa-refresh fa-2x"></i>Επεξεργασία προφίλ</a>
            </li>
            <li>
                <a  href="/backend/suser/archive/<?php echo $ontotita->id;?>"><i class="fa fa-archive fa-2x"></i>Αρχειοθετημένα
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse in" style="height: auto;">
                    <li><a href="/backend/suser/archive/<?php echo $ontotita->id;?>">Αρχεία Προέδρου</a></li>
                    <li><a href="#">Αρχεία Διαγωνισμών</a></li>
                    
                </ul>
            </li>
        </ul>
    </div>
</nav> 		