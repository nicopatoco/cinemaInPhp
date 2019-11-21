<?php
    namespace DAO;

    use DAO\IPriceDAO as IPriceDAO;
    use DAO\Connection as Connection;
    use Models\Price as Price;

    class PriceDAO implements IPriceDAO
    {
        private $connection;
        private $tableName = "Prices";

        public function Add(Price $price)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (amount, price_description) VALUES (:amount, :price_description);";
                
                $parameters["amount"] = $price->getAmount();
                $parameters["price_description"] = $price->getDescription();

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
                $pricesList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {   
                    $price = new Price();

                    $price->setId($row["price_id"]);
                    $price->setAmount($row["amount"]);
                    $price->setDescription($row["price_description"]);

                    array_push($pricesList, $price);
                }

                return $pricesList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function Delete(Price $price)
        {   
            try
            {
                $id = $price->getId();
                $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".price_id ='$id'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function Update(Price $price, $updatedPrice)
        {
            try
            {
                $id = $price->getId();
                $newAmount = $updatedPrice['amount'];
                $newDescription = $updatedPrice['price_description'];
                $query = "UPDATE ". $this->tableName ." SET amount='$newAmount', price_description='$newDescription'"  . " WHERE price_id ='$id'";
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
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".price_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $price = NULL;

                foreach ($resultSet as $row)
                {   
                    $price = new Price();

                    $price->setId($row["price_id"]);
                    $price->setAmount($row["amount"]);
                    $price->setDescription($row["price_description"]);
                }

                return $price;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>