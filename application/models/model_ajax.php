<?php
session_start();
class Model_Ajax extends Model
{
    private $empTable = 'tasks';
    private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){
            $conn = new mysqli('localhost', 'root', '12345', 'test_work');
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }
    private function getData($sqlQuery) {
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if(!$result){
            die('Error in query: '. mysqli_error());
        }
        $data= array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[]=$row;
        }
        return $data;
    }
    private function getNumRows($sqlQuery) {
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if(!$result){
            die('Error in query: '. mysqli_error());
        }
        $numRows = mysqli_num_rows($result);
        return $numRows;
    }
    public function employeeList(){
        $sqlQuery = "SELECT * FROM ".$this->empTable." ";
        if(!empty($_POST["search"]["value"])){
            $sqlQuery .= 'where(id LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR name LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR address LIKE "%'.$_POST["search"]["value"].'%" ';
            $sqlQuery .= ' OR skills LIKE "%'.$_POST["search"]["value"].'%") ';
        }
        if(!empty($_POST["order"])){
            $sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if($_POST["length"] != -1){
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $numRows = mysqli_num_rows($result);
        $employeeData = array();
        while( $employee = mysqli_fetch_assoc($result) ) {
            $empRows = array();
            if($employee['status']==1){$status = '<div>Выполнено</div>';} else {$status = '';}
            if($employee['date_edit']){$edited = '<div>отредактировано администратором</div>';} else {$edited = '';}
            $empRows[] = $employee['id'];
            $empRows[] = ucfirst($employee['author']);
            $empRows[] = $employee['email'];
            $empRows[] = htmlspecialchars($employee['description']);
            $empRows[] = $status.$edited;
            $empRows[] = '<button type="button" name="update" id="'.$employee["id"].'" class="btn btn-warning btn-xs update">Update</button>';
            $empRows[] = '<button type="button" name="delete" id="'.$employee["id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
            $employeeData[] = $empRows;
        }
        $output = array(
            "draw"				=>	intval($_POST["draw"]),
            "recordsTotal"  	=>  $numRows,
            "recordsFiltered" 	=> 	$numRows,
            "data"    			=> 	$employeeData
        );
        echo json_encode($output);
    }
    public function getEmployee(){
        if($_POST["taskId"]) {
            $sqlQuery = "
				SELECT * FROM ".$this->empTable." 
				WHERE id = '".$_POST["taskId"]."'";
            $result = mysqli_query($this->dbConnect, $sqlQuery);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo json_encode($row);
        }
    }
    public function updateEmployee(){
        if($_POST['taskId']  && $_SESSION['login']) {
            $updateQuery = "UPDATE ".$this->empTable." 
			SET author = '".$_POST["taskAuthor"]."', email = '".$_POST["taskEmail"]."', description = '".$_POST["taskDescription"]."', status = '".$_POST["taskStatus"]."' , date_edit = NOW()
			WHERE id ='".$_POST["taskId"]."'";
            $isUpdated = mysqli_query($this->dbConnect, $updateQuery);
        } else { echo 'error';}
    }
    public function addEmployee(){
        $insertQuery = "INSERT INTO ".$this->empTable." (author, email, description) 
			VALUES ('".$_POST["taskAuthor"]."', '".$_POST["taskEmail"]."', '".$_POST["taskDescription"]."')";
        $isUpdated = mysqli_query($this->dbConnect, $insertQuery);
    }
    public function deleteEmployee(){
        if($_POST["taskId"] && $_SESSION['login']) {
            $sqlDelete = "
				DELETE FROM ".$this->empTable."
				WHERE id = '".$_POST["taskId"]."'";
            mysqli_query($this->dbConnect, $sqlDelete);
        } else { echo 'error';}
    }

}
