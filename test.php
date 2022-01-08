<?php
$date = new DateTime("2021-12-27");
$today = new DateTime();
if ($date < $today ){
    echo 'past';
}
elseif ($date > $today){
    echo 'future';
}
else{
    echo 'today';
}
