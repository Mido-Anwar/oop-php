<?php
require 'db.php';

class Connection extends Database
{

    protected $hostName = self::DATABASEINFO['serverName'];
    protected $user = self::DATABASEINFO['userName'];
    protected $password = self::DATABASEINFO['password'];
    protected $dateBase = self::DATABASEINFO['databaseName'];

    public function conn()
    {
        $conn = mysqli_connect($this->hostName, $this->user, $this->password, $this->dateBase);
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
    protected $id;


    public function GetFirstName()
    {
        return $this->firstName;
    }
    public function GetLastName()
    {
        return $this->lastName;
    }
    public function GetEmail()
    {
        return $this->email;
    }
    public function GetId()
    {
        return $this->id;
    }
    public function SetFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    public function SetLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function SetEmail($email)
    {
        $this->email = $email;
    }
    public function SetId($id)
    {
        $this->id = $id;
    }
    protected function ValidationInputData()
    {
        if (empty($this->firstName)  || empty($this->lastName) || empty($this->email)) {
            echo "Please Fill All failds";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
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
    public function SelectQueryById()
    {
        $sqlSelectById = "SELECT * FROM users WHERE id ="
            . $this->id;
        $getedUser = mysqli_query($this->conn(), $sqlSelectById);
        $user =  mysqli_fetch_assoc($getedUser);
        mysqli_close($this->conn());
        return $user;
    }
    public function InsertQuery()
    {
        if ($this->ValidationInputData()) {
            $sqlInsert  =  "INSERT INTO users (first_name,last_name,email) VALUES ('$this->firstName' ,'$this->lastName', '$this->email')";
            mysqli_query($this->conn(), $sqlInsert);
            header('Location: ../index.php');
        } else {
            echo "Fail : " . mysqli_error($this->conn());
        }
    }
    public function UpdateQuery()
    {
        if ($this->ValidationInputData()) {
            $SqlUpdate = "UPDATE users SET first_name = '$this->firstName' , last_name = '$this->lastName',email = '$this->email' WHERE id = '$this->id'";
            mysqli_query($this->conn(), $SqlUpdate);
            header('Location: dashboard.php');
        } else {
            echo "Fail : " . mysqli_error($this->conn());
        }
    }
    public function DeleteQuery()
    {
        $SqlDelete = 'DELETE FROM users WHERE id =' . $this->id;
        if (mysqli_query($this->conn(), $SqlDelete)) {
            header('Location: dashboard.php');
        } else {
            echo "Fail : " . mysqli_error($this->conn());
        }
    }
}

if (isset($_POST["submit"])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $con = new SqlQeuaries();
    $con->SetFirstName($firstName);
    $con->SetLastName($lastName);
    $con->SetEmail($email);
    $con->InsertQuery();
}
if (isset($_POST["update"])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $con = new SqlQeuaries();
    $con->SetId($_POST['id']);
    $con->SetFirstName($firstName);
    $con->SetLastName($lastName);
    $con->SetEmail($email);
    $con->UpdateQuery();
}

if (isset($_GET['action']) === 'delete' && $_GET['id'] === filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT)) {
    # code...
    $con = new SqlQeuaries();
    $con->SetId($_GET['id']);
    $con->DeleteQuery();
}
