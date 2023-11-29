<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>OOP</title>
</head>
<body>
    
<?php
class DataBase {
    public const SERVERDB = 'localhost:3308';

    
    public $conn;
    public $table_name ;

   
   public  function __construct($t){
$this -> table_name = $t;

$this->conn = new mysqli(self::SERVERDB,"root","", "product");
$this->conn-> set_charset("utf8");




   }

  
  
 
    
   public function selectAll(){
    
    
$query1 ="SELECT * FROM {$this-> table_name}";
$result = $this ->conn ->query($query1);
return $result->fetch_all(MYSQLI_ASSOC);
   }

  

   
   public function select($col,$val){
    
  
    $query1 ="SELECT * FROM {$this-> table_name} WHERE {$col} = '{$val}' ";
    $result = $this ->conn ->query($query1);
    
    return $result->fetch_all(MYSQLI_ASSOC);
    
    
    
       }
       public function insert($row){
        $keys = array_keys($row);
        $implode_keys = implode(",",$keys);
        $values = array_values($row);
        $implode_values = implode("','",$values);
        $insert = "INSERT INTO {$this-> table_name} ($implode_keys) VALUES ('$implode_values')";
        $result = $this ->conn ->query($insert);
        if ($result) {
            return true;
          }else {
             echo $this->conn->error;
          }
       }

       public function delete($col,$val){
    $delete = "DELETE FROM {$this-> table_name} WHERE {$col} ='{$val}' ";
    $result = $this ->conn ->query($delete);
       }
       public function update($col,$val,$data){
$keys = array_keys($data);
$values =array_values($data);
$newdata = [];
for ($i=0; $i <count($keys) ; $i++) { 
$newdata[$i] = $keys[$i] ."='" .$values[$i] ."'";
$implode = implode(",",$newdata);

}
$update = "UPDATE {$this-> table_name} SET {$implode} WHERE {$col} ='{$val}'";
$result = $this ->conn ->query($update);
       }
   
}

$sql =new DataBase("users");
 $sql ->insert(["username"=>"mahmoud127904111","password"=>"198@9876m7904111"]);
 
 $sql->update("id_user", 45,["username"=>"Ebrahim","password"=>"1234567890"] );
$sql -> delete("id_user",140);
?>  
  <table class="table table-dark border border-1 w-75 m-auto text-center my-5"  >
    <tr>
        <?php
 $fetch = $sql -> selectAll();
 for ($i=0; $i <count($fetch) ; $i++) { 
    $array1 = $fetch[$i];
    $keys = array_keys($array1);
    $values = array_values($array1);
    for ($k=0; $k < count($keys); $k++) { 
        if($i==0){

      
        ?>
        <th class="border border-1"><?=$keys[$k]?></th>
        <?php
    }  
}
    ?>
    </tr>
    <tbody >
    <tr >
        <?php
       
        for ($v=0; $v < count($values); $v++) { 
        ?>
       
        <td class="border border-1"><?=$values[$v]?></td>
        
<?php

       } }?>
       </tr>
    </tbody>
  </table>
  <table class="table table-dark border border-1 w-75 m-auto text-center my-5"  >
    <tr>
        <?php
 $fetch = $sql -> select("id_user","54");
 for ($i=0; $i <count($fetch) ; $i++) { 
    $array1 = $fetch[$i];
    $keys = array_keys($array1);
    $values = array_values($array1);
    for ($k=0; $k < count($keys); $k++) { 
        if($i==0){

      
        ?>
        <th class="border border-1"><?=$keys[$k]?></th>
        <?php
    }  
}
    ?>
    </tr>
    <tbody >
    <tr >
        <?php
       
        for ($v=0; $v < count($values); $v++) { 
        ?>
       
        <td class="border border-1"><?=$values[$v]?></td>
        
<?php

       } }?>
       </tr>
    </tbody>
  </table>
</body>
</html>
