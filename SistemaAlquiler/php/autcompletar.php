



<html> 
<head>
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>  
<link rel="stylesheet" href="jquery-ui.css">
</head>
<body>
<input  id="tag">
<script type="text/javascript">
$(document).ready(function(){
var items =
[
    "elemento1",
    "elemento2"
];
$("#tag").autocomplete({
source: items
});

});

</script>

</body>
</html>