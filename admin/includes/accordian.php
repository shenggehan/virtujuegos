<div id="basic-accordian" ><!--Parent of the Accordion-->


<!--Start of each accordion item-->
  <div id="test-header" class="accordion_headings header_highlight" >Game quick-add</div><!--Heading of the accordion ( clicked to show n hide ) -->
  
  <!--Prefix of heading (the DIV above this) and content (the DIV below this) to be same... eg. foo-header & foo-content-->
  
  <div id="test-content"><!--DIV which show/hide on click of header-->
  
  	<!--This DIV is for inline styling like padding...-->
    <div id="box1" class="accordion_child">
    	<?php include('quick_add_game_form.php'); ?>
    </div>
    
  </div>
      <div class="right_bottom"></div>
<!--End of each accordion item--> 


</div><!--End of accordion parent-->