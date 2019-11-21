<?php
    namespace Controllers;

    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\PriceDAO as PriceDAO;
    use Models\Price as Price;
    use Helpers\PriceHelper as PriceHelper;

    class PriceController
    {
        private $repo;
        private $functionRepo;
        private $priceHelper;

        public function __construct()
        {
            $this->repo = new PriceDAO();
            $this->functionRepo = new MovieFunctionDAO();
            $this->priceHelper = new PriceHelper();
        }

        public function ShowListView()
        {
            $priceList = $this->repo->GetAll();

            require_once(VIEWS_PATH."price-list.php");
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."price-add.php");
        }

        private function isAvailableDescription($priceList, $description) 
        {
            foreach($priceList as $price)
            {
                if($price->getDescription() == $description)
                {
                    return false;
                }
            }
            return true;
        }

        public function Add()
        {
            if($_POST)
            {
                if($this->isAvailableDescription($this->repo->GetAll(), $_POST["description"]))
                {
                    $price = new Price();
                    $price->setAmount($_POST["amount"]);
                    $price->setDescription($_POST["description"]);

                    $this->repo->Add($price);
                }
                else
                {
                    echo "<script> alert('Descripcion no disponible'); </script>";
                }

                $priceList = $this->repo->GetAll();
                require_once(VIEWS_PATH."price-list.php");
            }
        }

        public function IsUsed($id)
        {
            $functionList = $this->functionRepo->GetAll();
            foreach($functionList as $key =>$function)
            {
                if($function->getPrice()->getId() == $id)
                {
                    return true;
                }
            }
            return false;
        }

        public function Select()
        {   
            if($_POST)
            {
                if(isset($_POST["delete"]))
                {
                    if($this->IsUsed($_POST["delete"]))
                    {
                        echo "<script> alert('No se puede borra el precio, esta siendo usado'); </script>";
                    }
                    else
                    {
                        $price = $this->repo->GetById($_POST["delete"]);
                        $this->repo->Delete($price);
                    }

                    $priceList = $this->repo->GetAll();
                    require_once(VIEWS_PATH."price-list.php");
                }
            }
        }
    }

?>