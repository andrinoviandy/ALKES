<html>
<head>
<title>Membuat Pop-Up Window</title>
<script language="javascript">
function buka_popup(){
 window.open('popup2.php', '', 'width=640, height=480, menubar=yes,location=yes,scrollbars=yes, resizeable=yes, status=yes, copyhistory=no,toolbar=no');
}
</script>
<script type="text/javascript" language="javascript">
function PopupCenter(pageURL, title,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
</head>
<body>
<a onclick=\"PopupCenter('popup2.php', 'myPop1',800,400);\" href=\"javascript:void(0);\" style=\"text-decoration:none\">info writings</a>
<p>Anda juga dapat membuka window popupnya dari sini</p>
<a href="javascript: buka_popup();">KLIK DISINI</a>
</body>
</html>