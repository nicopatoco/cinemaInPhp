<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO
    {
        private $connection;
        private $tableName = "Users";

        public function Add(User $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (user_email, user_password, type_id) VALUES (:user_email, :user_password, :type_id);";
                
                $parameters["user_email"] = $user->getEmail();
                $parameters["user_password"] = $user->getPassword();
                $parameters["type_id"] = $user->getTypeId();                

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $user = new User();

                    $user->setId($row["user_id"]);
                    $user->setEmail($row["user_email"]);
                    $user->setPassword($row["user_password"]);
                    $user->setTypeId($row["type_id"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function Delete(User $user)
        {   
            try
            {
                $id = $user->getId();
                $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".user_id ='$id'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function GetById($id)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".user_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $user = NULL;

                foreach ($resultSet as $row)
                {               
                    $user = new User();

                    $user->setId($row["user_id"]);
                    $user->setEmail($row["user_email"]);
                    $user->setPassword($row["user_password"]);
                    $user->setTypeId($row["type_id"]);
                }

                return $user;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>