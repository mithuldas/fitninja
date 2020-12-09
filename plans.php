<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

FlowControl::startSession();

?>

<?php
require "header.php";

$product1 = new Product("Basic",$conn);
$product2 = new Product("Standard",$conn);
$product3 = new Product("All Access",$conn);
$product4 = new Product("Couple",$conn);
?>

<div class="container">

Choose the plan that’s right for you.
<BR><BR>

  <div class="row pb-2">
  <div class="col-3 hide-on-mobile">
  </div class="col">
  <div class="col">
  <form action="confirm_plan.php" method="POST">
      <input type="radio" id="plan1Header" name="planChoice" value="plan1" />
      <label for="plan1Header">Basic</label>
  </div class="col">
  <div class="col">
    <input type="radio" id="plan2Header" name="planChoice" value="plan2"/>
    <label for="plan2Header">Standard</label>
  </div class="col">
  <div class="col">
    <input type="radio" id="plan3Header" name="planChoice" value="plan3"/>
    <label for="plan3Header">All Access</label>
  </div class="col">
  <div class="col">
    <input type="radio" id="plan4Header" name="planChoice" value="plan4" checked="checked" />
    <label for="plan4Header">Couple</label>
  </div class="col">
  </div class = "row">



<div class="row hide-on-nonmobile">
<div class="col">
<center>Fitness Routines</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Fitness Routines
</div class="col">
<div class="col"> Any 1
</div class="col">
<div class="col"> Any 2
</div class="col">
<div class="col"> All
</div class="col">
<div class="col"> All
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Number of sessions per month</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Number of sessions per month
</div class="col">
<div class="col"> 20
</div class="col">
<div class="col"> 10+10
</div class="col">
<div class="col"> 20
</div class="col">
<div class="col"> 20
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Dedicated Fitness Manager</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Dedicated Fitness Manager
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Sessions with Fitness Manager</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Sessions with Fitness Manager
</div class="col">
<div class="col"> 1/week
</div class="col">
<div class="col"> 2/week
</div class="col">
<div class="col"> On call
</div class="col">
<div class="col"> On call
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Customised Fitness Plans</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Customised Fitness Plans
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Dedicated Personal Trainer</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Dedicated Personal Trainer
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Number of trainees</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Number of trainees
</div class="col">
<div class="col"> 1
</div class="col">
<div class="col"> 1
</div class="col">
<div class="col"> 1
</div class="col">
<div class="col"> 2
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Flexible Scheduling</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Flexible Scheduling
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✓
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Transferable</center>
</div class="col">
</div class="row">
<div class="row">
<div class="col-3 hide-on-mobile"> Transferable
</div class="col">
<div class="col"> ✗
</div class="col">
<div class="col"> ✗
</div class="col">
<div class="col"> ✓
</div class="col">
<div class="col"> ✗
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile">
<div class="col">
<center>Monthly Price</center>
</div class="col">
</div class="row">
<div class="row pb-2">
<div class="col-3 hide-on-mobile">Monthly Price
</div class="col">
<div class="col"> <?php echo "₹ ".$product1->currentPriceINR->amount; ?>
</div class="col">
<div class="col"> <?php echo "₹ ".$product2->currentPriceINR->amount; ?>
</div class="col">
<div class="col"> <?php echo "₹ ".$product3->currentPriceINR->amount; ?>
</div class="col">
<div class="col"> <?php echo "₹ ".$product4->currentPriceINR->amount; ?>
</div class="col">
</div class = "row">

<div class="row">
<div class="col"> <center><button type="submit" class="btn btn-primary btn-sm btn mr-1 mb-1" id ="basicPlanBtn"> Continue </button></center>
</div class="col">
</div class = "row">
</form>

</div>


<?php
  require "footer.php";
?>
