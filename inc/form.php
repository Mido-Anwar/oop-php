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

    public function DeleteQuery()
    {
    }

    public function UpdateQuery()
    {
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

