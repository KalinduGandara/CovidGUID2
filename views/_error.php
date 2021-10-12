<?php
/** @var $exception Exception */
?>
<?php
/** @var $this \app\core\View */

$this->title = $exception->getMessage();
?>

<h3><?php echo $exception->getCode()?> - <?php echo $exception->getMessage()?></h3>
