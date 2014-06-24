<?php
echo '<div class="search_form_container"><form name="form" action="'.$setting['site_url'].'/index.php?task=search" method="get">
      <input name="q" type="text" size="25" class="search_page_textbox"/> 
      <input type="submit" name="Submit" value="'.SEARCH_BUTTON.'" class="submit_button" />
      <input name="task" type="hidden" value="search" />
	  </form></div>';
?>