<?php 
  include('./php/conexion.php');


// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $db->query("SELECT * FROM contacto WHERE email LIKE '%".$searchTerm."%'  ORDER BY email ASC"); 
 
// Generate array with skills data 
$skillData = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $data['id'] = $row['id']; 
        $data['value'] = $row['email']; 
        array_push($skillData, $data); 
    } 
} 
echo json_encode($skillData); 
?>