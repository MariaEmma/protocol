<?php $resources =  '/assets/';?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="el">
<head profile="http://gmpg.org/xfn/11">
<title>404  Errorpage</title>
<meta charset="utf-8"/>
<meta http-equiv="Content-Language" content="el"/>
<meta name="robots" content="all,index,follow"/>
<meta name="keywords" content="404 error page"/>
<meta name="description" content="404 error page"/>
<meta name="publisher" content="Μαρία Εμμανουήλ, Σωμαράς Χρήστος" />
<meta name="author" content="Μαρία Εμμανουήλ, Σωμαράς Χρήστος" />
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $resources;?>404/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $resources;?>404/backgrounds.css" />

<!--[if IE]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body>
<div class="wrapper">
	<div class="mainWrapper">
        <div class="leftHolder">
            <div class="errorNumber">404 error</div> 
        </div>
        <div class="rightHolder">
            <div class="message"><p>Η σελίδα που ψάχνετε δεν υπάρχει!!! Προσπαθήστε με κάτι άλλο.</p></div>
                              
            <div class="tryToMessage">
                <a href="javascript:history.go(-1)" title="πισω" style="color:#fff;"><img src="<?php echo $resources;?>404/images/back.png" title="πισω"/>Πάτε πίσω</a>    
            </div>
          </div>
        <footer style="font-family:arial; font-size:11px;">
			<strong>Υπεύθυνος:</strong> <a style="color:#999;" href="http://teilar.academia.edu/TakisHartonas" title="Χρυσάφης Χαρτώνας" target="_blank">Χρυσάφης Χαρτώνας</a>, Καθηγητής </span><br/>
                        <strong>Ανάπτυξη:</strong> <a style="color:#999;" href="http://gr.linkedin.com/in/emmanouilmaria" target="_blank" title="Μαρία Εμμανουήλ">Μαρία Εμμανουήλ</a>, <a style="color:#999;" href="http://www.somweb.gr" title="Χρήστος Σωμαράς" target="_blank">Χρήστος Σωμαράς</a></span><br/>
			&copy; <?php echo date('Y') ?> <a style="color:#999;" href="http://www.teilar.gr" target="_blank">ΤΕΙ Θεσσαλίας</a>
		</footer>
	</div>
</div>
</body>
</html>
