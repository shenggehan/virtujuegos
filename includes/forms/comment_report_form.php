<?php
include '../../config.php';
include '../../includes/core.php';
include '../../language/'.$setting['language'].'.php';
$id = intval($_GET['id']);
$type = intval($_GET['type']);
?>

<div class="comment_report_text"><?php echo COMMENT_REPORT_TITLE; ?></div>

<form action="" method="get" onsubmit="return false;">
    <div><textarea name="report" cols="60" rows="4" id="the_report" class="comment_report_textbox"></textarea>
    <br />
    </div>
      <div class="report_button_container" style="text-align:right;">
      
      <input type="submit" name="Submit" id="report_submit" value="<?php echo GAME_SUBMIT_REPORT;?>" onclick="SendReport(<?php echo $id.",'".$setting['site_url'];?>', <?php echo $type;?>)" />
      
      <input type="button" name="close" id="close_report" value="<?php echo GAME_CLOSE_REPORT;?>" onclick="HidePopup('ava-popup');" />
      
      </div>
</form>