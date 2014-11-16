<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Example SubCrypt - Result</title>
	</head>
	<style type="text/css">
		
		table
		{
			font-size: 14px;
			font-family: Arial;
			color: #000;
			
		}
		
		th
		{
			background-color: #000;
			color: #fff;
			padding: 5px;
		}
		
		td
		{
			border-bottom: 1px solid #ccc;
			padding: 5px;
			text-align: center;
		}
	
	</style>
	<body>
		
		<h4>result...</h4>

		<table >
			<tr>
				<th>Field Name</th><th>Encrypted Value Received by POST</th><th>Original Value (decrypted)</th>
			</tr>
		<?php 
			include_once '../class_subcrypt.php';
			$subcrypt = new Subcrypt();
			foreach($_POST as $key=>$value): 
		?>
			
			<tr>
				<td>
					<?php echo $key; ?>
				</td>
				<td>
					<?php echo $value; ?>
				</td>
				<td>
					<?php echo (!empty($value))?$subcrypt->decode($value):''; ?>
				</td>
			</tr>
			
		<?php endforeach;?>
		</table>
		
		
	</body>
</html>