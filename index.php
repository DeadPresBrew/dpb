<!doctype html>
<html>
<?php include_once ('head.php'); ?>
<body>
<div id="wrapper">
<?php include_once ('nav.php'); ?>
<div id="content">
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
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
		var query = new google.visualization.Query('https://spreadsheets.google.com/tq?key=1Drn1soYe5HLCa-7J_oWoeNYg-OdX7i8q2LD6OZhpDNQ&gid=46038258');
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
		
		var options = {'showRowNumber': false, 'allowHtml': true, 'alternatingRowStyle': false, 'cssClassNames': cssClassNames};	  
			
		var drink = new google.visualization.DataView(data);
            drink.setColumns([0,1,2,17,18]),drink.setRows(drink.getFilteredRows([{column:3, minValue:'0'}]));
			var table = new google.visualization.Table(document.getElementById('drink_table'));
			table.draw(drink, options);
	}
</script>
</body>
</html>
