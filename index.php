<!doctype html>
<html>
<?php include_once ('head.php'); ?>
<body>
<div id="wrapper">
<?php include_once ('nav.php'); ?>
<div id="content">
<div class="container">
	<div class="row">
		<div class="col-md-6 col-offset-3">
			<div id='drink_table'></div>
		</div><!--col-md-6-->
	</div><!--row-->
</div><!--container-->
</div><!--content-->
</div><!--wrapper-->
<script type='text/javascript'>
google.load('visualization', '1', {packages:['table']});
google.setOnLoadCallback(drawTable);
function drawTable() {
    var query = new google.visualization.Query('https://spreadsheets.google.com/tq?key=0Asl09SxrwsI2dEJIZVhXWGVKTzR4ajllTFdHLWFBRkE&gid=22');
    query.send(handleQueryResponse);
}

function handleQueryResponse(response) {
    if (response.isError()) {
        alert('Error in query: ' + response.getMessage() + '' + response.getDetailedMessage());
        return;
    }
    
    var data = response.getDataTable();
    var today = new Date();
    var cssClassNames = {
        'headerRow': 'rowHeader',
        'tableRow': 'tableRow',
        'hoverTableRow': 'rowHover'
    };
    
    var formatter = new google.visualization.PatternFormat('<a href="{19}" target="_blank">Update Brew</a>');
    formatter.format(data, [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19],20);
    
    var options = {'showRowNumber': false, 'allowHtml': true, 'alternatingRowStyle': false, 'cssClassNames': cssClassNames};	  
    
    var drink = new google.visualization.DataView(data);
    drink.setColumns([0,17,18]),drink.setRows(drink.getFilteredRows([{column:2, minValue:'0'}]));
		var drinkCount = drink.getNumberOfRows();
		if (drinkCount > 0) {
			var table = new google.visualization.Table(document.getElementById('drink_table'));
			table.draw(drink, options);
		}
		
		if ( drinkCount > 0) {
			$(".drink_section").prepend("<h3>Bottled & Ready</h3>");
		}
}
</script>
</body>
</html>
