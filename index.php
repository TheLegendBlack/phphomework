<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Friend book</title>
  
</head>
<body>
<?php
include('header.html');
?>

<form action="index.php" method="post">
Name : <input type="text" name="input">
<input type="submit" value="Submit">
</form>
<h2>My Best Friends:</h2>

<?php

$filename = 'friends.txt';
$friendArray= array();
$file = fopen("friends.txt", "a" );
if(isset($_POST['input']) && $_POST['input'] != "" )
{
    $friend = $_POST['input'];
    fwrite( $file, $friend.PHP_EOL);
}
    fclose($file);

    // lecture
    $file = fopen( $filename, "r" );
      while(!feof($file)) 
      {
        $value = fgets($file);
        $friendArray[] = $value;
        if(isset($_POST['nameFilter']))
        {
          if(isset($_POST['startingWith']))
          {
              foreach($friendArray as $name)
              {
                $position = strpos(strtolower($name), strtolower($_POST['nameFilter']));
                if($position !== false)
                { 
                  if ($position === 0) {
                    echo "<li>$name</li>";
                  }
                  
                } 
              }
          } else 
          {
            foreach($friendArray as $name)
            {
              if(strstr(strtolower($name), strtolower($_POST['nameFilter'])))
              {
                echo "<li>$name</li>";
              } 
            }
          }
         
        } else 
        {
          echo "<li>$value</li>";
        }
        $friendArray = array();
      }
      fclose($file);

  /*  if (isset($_POST['input'])){
      while (!feof($file)) 
    {
        $line = fgets($file);
        echo "<li>$line</li>";
        $friendArray["$line"]="$line";
       }
    }
    fclose($file);
  */
?>
  <form action="index.php" method="post">
            Filter:<input type="text" name="nameFilter">
            <input type="checkbox" name="startingWith" value="TRUE">Only names starting with
            <input type="submit" value="filter">
  </form>

<?php
  include('footer.html');
?>
</body>
</html>