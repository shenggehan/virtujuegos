<?php if ($user['login_status'] == 1 && $count) { ?>
<form action="" method="get" onsubmit="return false;">
    <div><textarea name="comment" cols="60" rows="4" id="the_comment" class="news_add_comment_box"></textarea>
    <br />
    </div>
      <div class="news_comment_button_container"><input type="submit" name="Submit" id="comment_submit" value="<?php echo GAME_SUBMIT_COMMENT;?>" onclick="AddComment(<?php echo $id.",'".$setting['site_url'];?>', 'news')" /></div>
</form>
<?php } else {
echo '<div id="login_to_comment">'.GAME_LOGIN_COMMENT.'</div>';
}
?>