<?php
///** @var $exception Exception */
//?>
<?php
///** @var $this \app\core\View */
//
//$this->title = $exception->getMessage();
//?>
<!---->
<!--<h3>--><?php //echo $exception->getCode()?><!-- - --><?php //echo $exception->getMessage()?><!--</h3>-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?php echo $exception->getMessage()?></title>
</head>
<body style="height: 100%">
<div class="container">
    <h1>
        <?php echo $exception->getCode().'  |  '.$exception->getMessage() ?>
    </h1>
</div>


</body>
</html>