<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                                <?php 
                                $typos = new Usertype($ltype);
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
                <a  href="/backend/admin"><i class="fa fa-group fa-2x"></i>Χρήστες</a>
            </li> 
            <li>
            <a  href="/backend/user/new"><i class="fa fa-user fa-2x"></i>Νέος Χρήστης</a>
            </li>
            <li>
                <a  href="/backend/user/update/<?php echo $ontotita->id;?>"><i class="fa fa-refresh fa-2x"></i>Επεξεργασία προφίλ</a>
            </li>
            <li>
                <a  href="/backend/category"><i class="fa fa-flag-o fa-2x"></i>Κατηγορίες Αρχειοθέτησης</a>
            </li>
        </ul>
    </div>
</nav> 		