<!--Banner code-->
<style>

#postit{width:300px; height:290px; padding:5px; position:absolute; background-color:white; border:1px solid black; visibility:hidden; z-index:50; cursor:hand; color: #000;}

</style>

<div id="postit" style="left:522px;top:633px">
<div align="right"><b><a href="javascript:closeit()"><font face="Arial" size="1">CERRAR</font> </a></b></div>

<!--AQUI VA EL MENSAJE-->
<br/>
<!-- BEGIN SMOWTION TAG - 300x250 - DO NOT MODIFY -->
<script type="text/javascript">
smowtion_size = "300x250";
smowtion_section = "5305612";
</script>
<script type="text/javascript"
src="http://ads.smowtion.com/ad.js?s=5305612&amp;z=300x250">
</script>
<!-- END SMOWTION TAG - 300x250 - DO NOT MODIFY -->

<!--FIN DEL MENSAJE-->


<script>

//Post-it only once per browser session? (0=no, 1=yes)
//Specifying 0 will cause postit to display every time page is loaded
var once_per_browser=0

///No need to edit beyond here///

var ns4=document.layers
var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ns4)
crossobj=document.layers.postit
else if (ie4||ns6)
crossobj=ns6? document.getElementById("postit") : document.all.postit


function closeit(){
if (ie4||ns6)
crossobj.style.visibility="hidden"
else if (ns4)
crossobj.visibility="hide"
}

function get_cookie4(Name) {
var search = Name + "="
var returnvalue = "";
if (document.cookie4.length > 0) {
offset = document.cookie4.indexOf(search)
if (offset != -1) { // if cookie4 exists
offset += search.length
// set index of beginning of value
end = document.cookie4.indexOf(";", offset);
// set index of end of cookie4 value
if (end == -1)
end = document.cookie4.length;
returnvalue=unescape(document.cookie4.substring(offset, end))
}
}
return returnvalue;
}

function showornot(){
if (get_cookie4('postdisplay')==''){
showit()
document.cookie4="postdisplay=yes"
}
}

function showit(){
if (ie4||ns6)
crossobj.style.visibility="visible"
else if (ns4)
crossobj.visibility="show"
}

if (once_per_browser)
showornot()
else
showit()


</script>

<script language="JavaScript1.2">

//drag drop function for ie4+ and NS6////
/////////////////////////////////

function drag_drop(e){
if (ie4&&dragapproved){
crossobj.style.left=tempx+event.clientX-offsetx
crossobj.style.top=tempy+event.clientY-offsety
return false
}
else if (ns6&&dragapproved){
crossobj.style.left=tempx+e.clientX-offsetx
crossobj.style.top=tempy+e.clientY-offsety
return false
}
}

function initializedrag(e){
if (ie4&&event.srcElement.id=="postit"||ns6&&e.target.id=="postit"){
offsetx=ie4? event.clientX : e.clientX
offsety=ie4? event.clientY : e.clientY

tempx=parseInt(crossobj.style.left)
tempy=parseInt(crossobj.style.top)

dragapproved=true
document.onmousemove=drag_drop
}
}
document.onmousedown=initializedrag
document.onmouseup=new Function("dragapproved=false")

</script></div><div class="clear"/></div>
