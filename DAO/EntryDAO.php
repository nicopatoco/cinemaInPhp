<?php
    namespace DAO;

    use Helpers\MovieFunctionHelper as MovieFunctionHelper;
    use Helpers\PriceHelper as PriceHelper;
    use Helpers\UserHelper as UserHelper;
    use Models\Entry as Entry;

    class EntryDAO implements IEntryDAO
    {
        private $connection;
        private $tableName = "Entries";
        private $functionHelper;
        private $priceHelper;
        private $userHelper;

        public function __construct()
        {
            $this->functionHelper = new MovieFunctionHelper();
            $this->priceHelper = new PriceHelper();
            $this->userHelper = new UserHelper();
        }

        public function Add(Entry $entry)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (function_id, payment_method, user_id, discount, total, price_id) VALUES (:function_id, :payment_method, :user_id, :discount, :total, :price_id);";
                
                $parameters["function_id"] = $entry->getFunction()->getId();
                $parameters["payment_method"] = $entry->getPayment();
                $parameters["user_id"] = $entry->getUser()->getId();
                $parameters["discount"] = $entry->getDiscount();
                $parameters["total"] = $entry->getTotal();
                $parameters["price_id"] = $entry->getPrice()->getId();

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
                $entriesList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {          
                    $function = $this->functionHelper->GetFunctionById($row["function_id"]);
                    $room = $function->getRoom();
                    $cinema = $function->getRoom()->getCinema();
                    $price = $this->priceHelper->GetPriceById($row['price_id']);
                    $movie = $function->getMovie();
                    $user = $this->userHelper->GetUserById($row['user_id']);

                    $entry = new Entry();

                    $entry->setId($row["entry_id"]);
                    $entry->setCinema($cinema);
                    $entry->setRoom($room);
                    $entry->setPrice($price);
                    $entry->setMovie($movie);
                    $entry->setFunction($function);
                    $entry->setPayment($row['payment_method']);
                    $entry->setUser($user);
                    $entry->setDiscount($row['discount']);
                    $entry->setTotal($row['total']);

                    array_push($entriesList, $entry);
                }

                return $entriesList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetEntriesListByFunctionId($id)
        {
            $entriesList = array();

            $query = 'CALL SPGetEntriesListByFunctionId("' . $id . '");';

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach($resultSet as $row)
            {          
                $function = $this->functionHelper->GetFunctionById($row["function_id"]);
                $room = $function->getRoom();
                $cinema = $function->getRoom()->getCinema();
                $price = $this->priceHelper->GetPriceById($_POST['price_id']);
                $movie = $function->getMovie();
                $user = $this->userHelper->GetUserById($row['user_id']);

                $entry = new Entry();

                $entry->setId($row["entry_id"]);
                $entry->setCinema($cinema);
                $entry->setRoom($room);
                $entry->setPrice($price);
                $entry->setMovie($movie);
                $entry->setFunction($function);
                $entry->setPayment($row['payment']);
                $entry->setUser($user);
                $entry->setDiscount($row['discount']);
                $entry->setTotal($row['total']);

                array_push($entriesList, $entry);
            }

            return $entriesList;             
        }
    }
?>