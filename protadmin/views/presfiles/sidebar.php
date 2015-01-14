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
                <a  href="/backend/president/input/<?php echo $ontotita->id;?>"><i class="fa fa-folder fa-2x"></i>Εισερχόμενα Αρχεία</a>
            </li>
<!--            <li>
                <a  href="/backend/president/output/<?php echo $ontotita->id;?>"><i class="fa fa-check-square fa-2x"></i>Εξερχόμενα Αρχεία</a>
            </li>-->
            <li>
                <a  href="/backend/president/request/<?php echo $ontotita->id;?>"><i class="fa fa-bookmark-o fa-2x"></i>Νέο αίτημα για πρωτόκολλο</a>
            </li>

            <li>
                <a  href="/backend/president/protocoled/<?php echo $ontotita->id;?>"><i class="fa fa-check-square fa-2x"></i>Πρωτοκολλημένα Αιτήματα</a>
            </li>
            <li>
                <a  href="/backend/user/update/<?php echo $ontotita->id;?>"><i class="fa fa-refresh fa-2x"></i>Επεξεργασία προφίλ</a>
            </li>
            <li>
                <a  href="/backend/president/archive/<?php echo $ontotita->id;?>"><i class="fa fa-archive fa-2x"></i>Αρχειοθετημένα
                </a>
            </li>
            <li>
                <a  href="/backend/president/grantaccess/<?php echo $ontotita->id;?>"><i class="fa fa-qrcode fa-2x"></i>Παραχώρηση Δικαιωμάτων
                </a>
            </li>
            <?php   $ur = new User();
                    $vicepresi = $ur->getVicepresidentIncharge();
                    //$urtype = $ontotita->usertype->get();
                    if ($vicepresi->exists()) {?>
             <li>
                <a  href="/backend/vicepresident/changetovicepres"><i class="fa fa-sign-out fa-2x"></i>Πρόσβαση ως Αντιπρόεδρος
                </a>
            </li>
                    <?php } ?>
        </ul>
    </div>
</nav> 		