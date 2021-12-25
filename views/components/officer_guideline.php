<?php
foreach ($display_guidelines as $guideline) {
    echo "<li>".$guideline->getGuideline()."
                    <a href='/officer/guidelines?edit_id=".$guideline->getGuidId()."'><i class=\"ms-3 mt-2 fa fa-pencil\"></i></a>
                    <a href='/officer/guidelines?delete_id=".$guideline->getGuidId()."'><i class=\"ms-3 mt-2 fa fa-minus-circle\"></i></a>
                   </li>";
}

?>
