<?php

use app\models\Notification;

?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Notifications
            </h1>
            <?php
            foreach (Notification::getNotifications() as $notification){
                $not_id = $notification->not_id;
                $cat_id = $notification->cat_id;
                $title = $notification->cat_title;
                $class = match ($notification->class) {
                    '0' => "Guideline",
                    '1' => "Sub Category",
                    default => "",
                };
                $type = match ($notification->type){
                    Notification::CREATE_NOTIFICATION => "New",
                    Notification::UPDATE_NOTIFICATION => "Update",
                    Notification::DELETE_NOTIFICATION => "Delete",
                    default => "",
                };
                //TODO make styles for unseennotifications
                $unseenStyle = "bg-secondary";
                $unseenBlock = '';
                if ($notification->status == Notification::UNSEEN_NOTIFICATION) {
                    $unseenStyle = "bg-primary";
                    $unseenBlock = '<a href="notification?not_id='.$not_id.'" class="card-link">Mark as read</a>';
                }
                echo '<div class="card " style="width: 50rem;">
  <div class="card-body  bg-opacity-10 '.$unseenStyle.'" style="">
    <h5 class="card-title">'."$type $class in $title".'</h5>
    <h6 class="card-subtitle mb-2 text-muted">'.date('F j, Y', strtotime($notification->date)).'</h6>
    <a href="notification?not_id='.$not_id.'&cat_id='.$cat_id.'" class="card-link">Open</a>
    '.$unseenBlock.'
  </div>
</div>';
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->