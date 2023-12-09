<?php

class Connection
{
    protected $hestName = 'localhost';
    protected $user = 'midoanawr';
    protected $password = 's1f4y5l1';
    protected $dateBase = 'win';

    public function conn()
    {
        $conn = mysqli_connect($this->hestName, $this->user, $this->password, $this->dateBase);
        if (!$conn) {
            echo 'fail' . mysqli_connect_error();
        } else {
            return  $conn;
        }
    }
}
class SqlQeuaries extends Connection
{
    protected $firstName;
    protected $lastName;
    protected $email;

    
    public function SetInputData($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName =  $lastName;
        $this->email = $email;
    }
    public function GetFirstName()
    {
        return $this->firstName . '<br>';
    }
    public function GetLastName()
    {
        return $this->lastName . '<br>';
    }
    public function GetEmail()
    {
        return $this->email . '<br>';
    }

    protected function ValidationInputData()
    {
        if (empty($this->firstName) || empty($this->lastName) || empty($this->email)) {
            echo "Please Fill All failds";
        } elseif (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            echo "Please write email corrctly";
        } else {
            return true;
        }
    }
    public  function SelectQuery()
    {
        $sqlSelect = "SELECT * FROM users";
        $geterUsers = mysqli_query($this->conn(), $sqlSelect);
        $users = mysqli_fetch_all($geterUsers, MYSQLI_ASSOC);
        mysqli_free_result($geterUsers);
        mysqli_close($this->conn());
        return $users;
    }
    public function InsertQuery()
    {
        $sqlInsert  =  "INSERT INTO users (first_name,last_name,email) VALUES ('$this->firstName' ,'$this->lastName', '$this->email')";
    }

}




if (isset($_POST['submit'])) {
    $firstName = isset($_POST['firstName']);
    $lastName = isset($_POST['lastName']);
    $email = isset($_POST['email']);
    $con = new SqlQeuaries();
    $con->SetInputData($firstName, $lastName, $email);
    if (mysqli_query($con->conn(), $sqlInsert)) {
        header('Location:  index.php');
    } else {
        echo "Fail : " . mysqli_error($con->conn());
    }
}
