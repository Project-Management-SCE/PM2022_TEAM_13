<?php
require_once 'core/init.php';

$inv=$_POST['Invid2'];

$invest = new Invest($inv);
$invest->update(array(
	'collected'=>1,
	'collectdate'=>date("Y-m-d")

));
$mov = new InvestMovement();
$mov->create(array(
				'investor'=>$invest->data()->investor,
                'Pid'=>$invest->data()->Pid,
                'investid'=>$inv,
                'amount'=>$invest->data()->amount*($invest->data()->gainper/100 +1),
                'date'=>date("Y-m-d"),
                'Aname'=>$invest->data()->Aname

));

Redirect::to("investData.php");
?>