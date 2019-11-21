<?php
    namespace DAO;

    use DAO\IPaymentMethodDAO as IPaymentMethodDAO;
    use DAO\Connection as Connection;
    use Models\PaymentMethod as PaymentMethod;

    class PaymentMethodDAO implements IPaymentMethodDAO
    {
        private $connection;
        private $tableName = "Payments";

        public function Add(PaymentMethod $paymentMethod)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (payment_name) VALUES (:payment_name);";
                
                $parameters["payment_name"] = $paymentMethod->getPaymentName();

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
                $paymentMethodList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {   
                    $paymentMethod = new PaymentMethod();

                    $paymentMethod->setId($row["payment_id"]);
                    $paymentMethod->setPaymentName($row["payment_name"]);

                    array_push($paymentMethodList, $paymentMethod);
                }

                return $paymentMethodList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function Delete(PaymentMethod $paymentMethod)
        {   
            try
            {
                $id = $paymentMethod->getId();
                $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".payment_id ='$id'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function Update(PaymentMethod $paymentMethod, $updatedPaymentMethod)
        {
            try
            {
                $id = $paymentMethod->getId();
                $newPaymentName = $updatedPaymentMethod['payment_name'];
                $query = "UPDATE ". $this->tableName ." SET payment_name='$newPaymentName' WHERE payment_id ='$id'";
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
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".payment_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $paymentMethod = NULL;

                foreach ($resultSet as $row)
                {   
                    $paymentMethod = new PaymentMethod();

                    $paymentMethod->setId($row["payment_id"]);
                    $paymentMethod->setPaymentName($row["payment_name"]);
                }

                return $paymentMethod;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>