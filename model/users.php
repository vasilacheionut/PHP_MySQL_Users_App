<?php

class Users
{
   private $conn;
   private $table = 'users';
   private $is_login = false;
   private $id;
   private $firstname;
   private $lastname;
   private $email;
   private $displayname;
   private $role;
   private $image;
      
   public function __construct($db)
   {
      $this->conn = null;
      $this->conn = $db;
   }

   public function setFirstName($firstname)
   {
      $this->firstname = $firstname;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function setLastName($lastname)
   {
      $this->lastname = $lastname;
   }   

   public function setEmail($email)
   {
      $this->email = $email;
   }     
   
   public function setDisplayName($displayname)
   {
      $this->displayname = $displayname;
   }    
   
   public function setImage($image)
   {
      $this->image = $image;
   }    

   public function setRole($role)
   {
      $this->role = $role;
   }

   public function getFirstName()
   {
      return $this->firstname;
   }

   public function getLastName()
   {
      return $this->lastname;
   }   

   public function getEmail()
   {
      return  $this->email;
   }     
   
   public function getDisplayName()
   {
      return $this->displayname;
   }    
   
   public function getId()
   {
      return $this->id;
   }    
   
   public function getImage()
   {
      return $this->image;
   }     
   
   public function getRole()
   {
      return $this->role;
   }

   //Insert user
   public function insert($firstname, $lastname, $email, $password)
   {
      $hashpassword = hash('sha256', $password);
      if ($this->exist($firstname, $lastname, $email) < 1) {
         $sql = "
            INSERT INTO `$this->table` (`id`, `firstname`, `lastname`,  `displayname`, `email`, `password`) VALUES (NULL, '$firstname', '$lastname', '$firstname $lastname', '$email', '$hashpassword');
         ";
         $result = $this->conn->run_query($sql);
         return $result;
      }
   }

   //Update user
   public function update($id, $firstname, $lastname, $email, $password)
   {      
      $displayname = $firstname . ' ' . $lastname;
      $hashpassword = hash('sha256', $password);      
      $sql = "UPDATE `$this->table` SET `firstname` = '$firstname', `lastname` = '$lastname', `displayname` = '$displayname', `email` = '$email', `password` = '$hashpassword' WHERE `users`.`id` = $id; ";
      $result = $this->conn->run_query($sql);
      return $result;
   }

   //Update password
   public function updateImage($id, $image)
   {      
      $sql = "UPDATE `$this->table` SET `image` = '$image' WHERE `users`.`id` = $id; ";
      $result = $this->conn->run_query($sql);
      return $result;
   }   

   //Update password
   public function updatePassword($id, $password)
   {      
      $hashpassword = hash('sha256', $password);      
      $sql = "UPDATE `$this->table` SET `password` = '$hashpassword' WHERE `users`.`id` = $id; ";
      $result = $this->conn->run_query($sql);
      return $result;
   }   

   //Delete user
   public function delete($id)
   {
      $sql = "DELETE FROM `$this->table` WHERE `id` = $id";
      $result = $this->conn->run_query($sql);
      return $result;
   }

   //Read all users
   public function read()
   {
      $sql = "SELECT * FROM $this->table";
      $result = $this->conn->result_array($sql);
      return $result;
   }

   //Read sivgle user
   public function read_single($id)
   {
      $sql = "SELECT * FROM $this->table WHERE id = $id LIMIT 0,1";
      $result = $this->conn->result_array($sql);
      return $result;
   }


   //Search users
   public function search($column, $search)
   {
      $sql = "SELECT * FROM `users` where $column LIKE '%$search%';  ";
      $result = $this->conn->result_array($sql);
      return $result;
   }

   //Check if user exist
   public function exist($firstname, $lastname, $email)
   {
      $display_name  = "$firstname $lastname";
      $sql = "SELECT * FROM $this->table WHERE displayname LIKE '$display_name' or email like '$email' ";
      $results = $this->conn->result_array($sql);
      if ($results != null) {
         return true;
      } else {
         return false;
      }
   }

   //Register user
   public function register($firstname, $lastname, $email, $password)
   {
      if ($this->exist($firstname, $lastname, $email) == 1) {
         return false;
      } else {
         $this->insert($firstname, $lastname, $email, $password);
         return true;
      }
   }

   //Login user
   public function login($email, $password)
   {
      $hashpassword = hash('sha256', $password);
      $sql = "SELECT * FROM $this->table WHERE BINARY(email) like BINARY('$email') and BINARY(password) LIKE BINARY('$hashpassword') ";
      $results = $this->conn->result_array($sql);
      if ($results != null) {
         foreach ($results as $key) {
            $this->setId($key["id"]);
            $this->setFirstName($key["firstname"]);
            $this->setLastName($key["lastname"]);
            $this->setEmail($key["email"]);
            $this->setDisplayName($key["displayname"]);     
            $this->setImage($key["image"]);              
            $this->setRole($key["role"]);              
         }    
         return $this->is_login = true;
      } else {
         return $this->is_login = false;
      }
   }

   //verify Hash Password
   public function verifyHashPassword($id, $password)
   {
      $hashpassword = hash('sha256', $password);
      $sql = "SELECT * FROM $this->table WHERE id like '$id' and BINARY(password) LIKE BINARY('$hashpassword') ";
      $results = $this->conn->result_array($sql);
      if ($results != null) {
         return true;    
      } else {
         return false;
      }
   }

   //Return user state after login
   public function is_login()
   {
      return $this->is_login;
   }

   //Logout user      
   public function logout($location = 'index.php')
   {
      //session start
      session_start();

      // remove all session variables
      session_unset();

      // destroy the session
      session_destroy();

      header("location:$location");
   }
}
