<?php
    namespace Controllers;

    use DAO\EntryDAO as EntryDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\PriceDAO as PriceDAO;
    use Helpers\MovieFunctionHelper as MovieFunctionHelper;
    use Models\Entry as Entry;

class EntryController
    {
        private $repo;
        private $movieRepo;
        private $functionRepo;
        private $functionHelper;
        private $priceRepo;

        public function __construct()
        {
            $this->repo = new EntryDAO();
            $this->movieRepo = new MovieDAO();
            $this->functionRepo = new MovieFunctionDAO();
            $this->functionHelper = new MovieFunctionHelper();
            $this->priceRepo = new PriceDAO();
        }

        public function ShowAddView()
        {
            if ($_SESSION) 
            {
                if ($_SESSION["loggedUser"]->getTypeId() == 2) 
                {
                    $movie = $this->movieRepo->GetById($_POST['movie']);
                    $functionList = $this->GetFunctionListByMovieId($movie->getId());
                    
                    require_once(VIEWS_PATH."entries-add.php");
                } 
            }
             else
            {
                echo "<script> alert('Debe iniciar sesion antes de comprar.'); </script>";
                echo "<script> document.getElementById('homeNavegation').click(); </script>";
            }
        }

        public function Payment()
        {
            require_once(VIEWS_PATH."payment.php");
        }

        public function Add()
        {
            $function = $this->functionRepo->GetById($_POST['function']);
            $function->setEntriesList($this->GetEntriesListByFunctionId($function->getId()));

            if(!$this->functionHelper->IsFull($function))
            {
                $price = $this->priceRepo->GetById($_POST['price']);
                $entry = new Entry();
                $entry->setCinema($function->getRoom()->getCinema());
                $entry->setRoom($function->getRoom());
                $entry->setPrice($price);
                $entry->setMovie($function->getMovie());
                $entry->setFunction($function);
                $entry->setPayment($_POST['paymentmethod']);
                $entry->setUser($_SESSION['loggedUser']);
                $entry->setDiscount($_POST['discount'] / $_POST['amount']);
                $entry->setTotal($_POST['total'] / $_POST['amount']);

                for($i = 0; $i < $_POST['amount']; $i++)
                {
                    $this->repo->Add($entry);
                }

                $entryList = $this->repo->GetAll();

                $userEntries = array();
                foreach($entryList as $key =>$entry)
                {
                    if($entry->getUser()->getId() == $_SESSION['loggedUser']->getId())
                    {
                        array_push($userEntries,$entry);
                    }
                }
                require_once(VIEWS_PATH."user-purchase.php");
            }
            else
            {
                echo "<script> alert('La funcion esta completa'); </script>";
            }
        }

        private function GetEntriesListByFunctionId($id)
        {
            $entriesList = $this->repo->GetAll();
            $newEntriesList = array();
            foreach ($entriesList as $key => $value) {
                if($value->getFunction()->getId() == $id)
                {
                    array_push($newEntriesList,$value);
                }
            }
            return $newEntriesList;
        }

        private function GetFunctionListByMovieId($id)
        {
            $functionList = $this->functionRepo->GetAll();
            $functionListByMovieId = array();
            foreach($functionList as $key => $function)
            {
                if($function->getMovie()->getId() == $id)
                {
                    array_push($functionListByMovieId,$function);
                }
            }
            return $functionListByMovieId;
        }
    }
?>