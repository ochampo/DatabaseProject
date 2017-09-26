<html>
<body>
<BODY BGCOLOR="#FFFFFF">
<h2> Database search engine </h2>
<?php
error_reporting(0);

?>


<form action= "380.php" method = "post"> 
	<select name = "table">
		<option>NASDAQ15</option>
		<option>NASDAQ16</option>
		<option>Dow15</option>
		<option>Dow16</option>
		<option>SP15</option>
		<option>SP16</option>
                <option>unemployment</option>

                
</select>
<form action= "380.php" method = "post"> 

<select name = "term">
	<option>no</option>
	 <option>low</option>
         <option>high</option>
</select>

<form action= "380.php" method = "post"> 

<select name = "constraint">
	<option>=</option>
	 <option>></option>
         <option><</option>
</select>

number input
<input name = "number" type = "text"/>
<input type = "submit" name = "submit1"  id = "submit1" value = "submit"  />

<br>


<form action= "380.php" method = "POST"> 
	<select name = "table1">
		<option>NASDAQ15</option>
		<option>NASDAQ16</option>
		<option>Dow15</option>
		<option>Dow16</option>
		<option>SP15</option>
		<option>SP16</option>
                <option>unemployment</option>

                
</select>

<form action= "380.php" method = "POST"> 
	<select name = "table2">
		<option>NASDAQ15</option>
		<option>NASDAQ16</option>
		<option>Dow15</option>
		<option>Dow16</option>
		<option>SP15</option>
		<option>SP16</option>
                <option>unemployment</option>

                </select>

<input type = "submit" value = "submit2" name = "submit2"/ id= 'submit2'>



<?php 
 $servername = "localhost";
 $username = "ochampo77";
 $password = "nahfoo12";
 $dbname = "data";

// Create connection


$mysqli = NEW MySQLi($servername, $username, $password, $dbname);//connect to database 

if($_POST['submit2']== 'submit2')
{
$table1 = $_POST['table1'];
$table2 = $_POST['table2'];
}//if
if($_POST['submit1'] == 'submit')
{

$term = $_POST['term'];
$table = $_POST['table'];
$constraint = $_POST['constraint'];
$number = $_POST['number'];
}//if
//echo " the Constraint number " . $number."<br>";
//echo "table1: ".$table1."<br>";
//echo "table2: ".$table2."<br>";

//echo " the Constraint " . $constraint."<br>";
//echo "The ". $term ."<br>";
//echo "For ".$table."<br>";



//echo "this is the table ".$table."<br>";
//echo "this the id input ".$search."<br>";
echo "<br>";


test($table1,$table2);


if($table=="unemployment")
{  
     
   echo  "<div style='padding-left:170px;'> Jan ". " Feb ". " Mar " . " Apr ". " May ". " Jun ". "July " ."Aug" ." Sept "." Oct ". " Nov ", " Dec "." <br> </div>";
   un($table);
}	



if(strlen($term) > 2)
{	
         
	 compare_low($table,$term,$constraint,$number );
}

if(strlen($term) == 2)
 
{
	echo " not a query "."<br>";
	find("$table");
 
}
function find($table)
{
	global $mysqli;
	//print_r($mysqli);
        	
	$resultSet = $mysqli->query("SELECT * FROM $table order by CAST( ID as SIGNED INTEGER) ASC ");
 //	printf("Error: %s\n", $mysqli->error);
if ($resultSet->num_rows != 0) {

	while($rows = $resultSet->fetch_assoc()) 
	{
	        $ID=$rows['ID'];
		$Date=$rows['Date'];
		$open=$rows['open'];
		$high=$rows['high'];
		$low=$rows['low'];
		$closed=$rows['closed'];
		$volume=$rows['volume'];
		$adj=$rows['adj'];
		
	 
	
	     echo " stock "." " .$ID." ".$Date." ".$open." ".$high." ".$low." ".$closed." ".$volume." ".$adj."<Br>";
	 
	  //  echo $ID."<BR>";
	}//while
	 	    
}//if
else 
{
	return  $table;
}


}//function

function compare_low($table,$term,$constraint,$number )
{
	global $mysqli;
	//print_r($mysqli);
        	
	$resultSet = $mysqli->query("SELECT $term,Date,ID FROM $table where $term $constraint $number ");
 //	printf("Error: %s\n", $mysqli->error);
if ($resultSet->num_rows != 0) {

	while($rows = $resultSet->fetch_assoc()) 
	{
	        
		
		           $Date=$rows['Date'];
	       		$ID= $rows['ID'];
		
	 if($term== "low") 
	 {
		 $low=$rows['low'];

		 echo $ID." ".$Date." ".$low."<Br>";
		  
	 }
	 if($term == "high")
	 {
         $high=$rows['high'];

            
          echo $ID." ".$Date." ".$high."<Br>";

	 }	 

	 else 
	 {
		 echo " ";
	 }
	 	    
        
	}
}
else 
{
	return  $table;
}

}










function un($table)// for unemployment rate 
{
	global $mysqli;
	//print_r($mysqli);
      // order by  ID ASC 	
	$resultSet = $mysqli->query("SELECT * FROM $table order by  ID ASC ");
 //	printf("Error: %s\n", $mysqli->error);
if ($resultSet->num_rows != 0) {

	while($rows = $resultSet->fetch_assoc()) 
	{
	        $year=$rows['year'];
		$jan=$rows['jan'];
		$feb=$rows['feb'];
		$mar=$rows['mar'];
		$ap=$rows['ap'];
		$may=$rows['may'];
		$june=$rows['june'];
		$july=$rows['july'];
		$aug=$rows['aug'];
	        $sept=$rows['sept'];
		$oct=$rows['oct'];
		$nov=$rows['nov'];
                $de=$rows['de'];
		$ID=$rows['ID'];
		

	       	
	     echo " Unemployment Rate". ": ". $year. " " .$ID."  ".$jan."% ".$feb."%".$mar."% ".$ap."%"." ".$june."%"." ".$july."% ".$aug. "% ".$sept."% ".$oct."% ".$nov."% ".$de."% "."<Br>";
	 
	  //  echo $ID."<BR>";
	}//while
	 	    
}//if
else 
{
	return  $table;
}


}//function




function test($table1,$table2)
{
	global $mysqli;
	//print_r($mysqli);
        	
	$resultSet = $mysqli->query("select n.Date,p.Date,n.high,p.high from $table1 p,$table2 n where n.Date =p.Date  ORDER BY p.high,n.high asc limit 10;     ");
 	printf("Error: %s\n", $mysqli->error);
if ($resultSet->num_rows != 0) {

	while($rows = $resultSet->fetch_assoc()) 
	{
	      //  $ID=$rows['ID'];
		$Date=$rows['Date'];
		

	//	$open=$rows['open'];
		$high=$rows['high'];
	//	$low=$rows['low'];
	//	$closed=$rows['closed'];
	//	$volume=$rows['volume'];
	//	$adj=$rows['adj'];
	 	
	 
	
	     //echo " stock "." " .$ID." ".$Date." ".$open." ".$high." ".$low." ".$closed." ".$volume." ".$adj."<Br>";
	 
	     echo $Date." ".$high. "<br>";
	}//while
	 	    
}//if
else 
{
	return  $table1;
}


}//function










?>




 </body>
</html>

