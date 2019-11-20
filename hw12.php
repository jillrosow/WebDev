<?php
print <<<TABLE0
<html lang = "en">
<head>
<title> Sign-Up Sheet </title>
<meta charset="utf-8">
</head>

<body>
<center>
<h2> Sign-Up Sheet </h2>
TABLE0;


//check to see if the sign up sheet has been changed first, and then add to text file
$currentForm = array();
$indexes = array ("0" => "8:00 am", "1" => "9:00 am", "2" => "10:00 am", "3" => "11:00 am", "4" => "12:00 pm", "5" => "1:00 pm", "6" => "2:00 pm", "7" => "3:00 pm", "8" => "4:00 pm", "9" => "5:00 pm");
if (isset($_POST['got'])) {
	
	$read = fopen("./signup.txt","r"); 
	while (! feof($read)) {
		$row = fgets($read);
		$rows = explode(",", $row);
		$currentForm[$rows[0]] = $rows[1];
	}
	fclose($read);


	
	for ($i=0; $i < 10; $i++) {
		if ($_POST[$i] != null) {
			$newTime = $indexes[$i];
			$newName = $_POST[$i] . "\n";
			$index = $i;
		}
	}
	// replace new entry into the array 
	$currentForm[$newTime] = $newName;
	
	$formString;
	foreach ($currentForm as $date => $name) {
		$formString .= $date . "," . $name;
	}	
	
	//write to the file
	$writeFile = fopen("./signup.txt", "w");
        fwrite($writeFile, $formString);
	fclose($writeFile);	
	showTable();

	
}

else {
	showTable();

}

function showTable() {
PRINT <<<TABLE
	<form id = "signSheet" method = "POST" action = "./hw12.php">
<table width="40%" border="1">
<tbody><tr align="center">
<th> Time </th> <th> Name </th>
</tr>

TABLE;

// read in the file and populate the table
$arr = array();
$file = fopen("./signup.txt","r");
while(! feof($file))
{
	$line = fgets($file);
	$times = explode(",", $line);

	// get key, val from line`
	$arr[$times[0]] = $times[1];
}
fclose($file);
$j = 0;
foreach ($arr as $key => $entry){
	if ($entry == "\n"){
		$entry = "<input type = \"text\" name = \"$j\" />";
	}
	print "<tr align=\"center\"> <td>$key</td> <td align=\"center\">$entry</td> </tr>";
	$j++;
}

PRINT <<<TABLE2
<tr align = "center">
<td colspan = "2"><input type="submit" name = "got" value="submit"></td>
</tr>
</tbody></table>
</center>
</form>
</body>
</html>
TABLE2;
}
?>
