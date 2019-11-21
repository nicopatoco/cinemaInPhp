<?php
    namespace Controllers;

    use DAO\PaymentMethodDAO as PaymentMethodDAO;
    use Models\PaymentMethod as PaymentMethod;
    use Helpers\PaymentMethodHelper as PaymentMethodHelper;

    class PaymentMethodController
    {
        private $repo;
        private $paymentMethodHelper;

        public function __construct()
        {
            $this->repo = new PaymentMethodDAO();
            $this->paymentMethodHelper = new PaymentMethodHelper();            
        }

        public function ShowListView()
        {
            $paymentList = $this->repo->GetAll();

            require_once(VIEWS_PATH."payment-list.php");
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."payment-add.php");
        }

        private function isAvailablePaymentName($paymentList, $paymentName) 
        {
            foreach($paymentList as $payment)
            {
                if($payment->getPaymentName() == $paymentName)
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
                if($this->isAvailablePaymentName($this->repo->GetAll(), $_POST["description"]))
                {
                    $payment = new PaymentMethod();
                    $payment->setPaymentName($_POST["description"]);

                    $this->repo->Add($payment);
                    $paymentList = $this->repo->GetAll();
                }
                else
                {
                    echo "<script> alert('Nombre no disponible'); </script>";
                }
                
                $paymentList = $this->repo->GetAll();
                require_once(VIEWS_PATH."payment-list.php");
            }
        }

        public function Select()
        {   
            if($_POST)
            {
                if(isset($_POST["delete"]))
                {
                    if($this->paymentMethodHelper->IsUsed($_POST["delete"]))
                    {
                        echo "<script> alert('No se puede borra el metodo de pago, esta siendo usado'); </script>";
                    }
                    else
                    {
                        $paymentMethod = $this->repo->GetById($_POST["delete"]);

                        $this->repo->Delete($paymentMethod);
                        
                        $paymentList = $this->repo->GetAll();
                        
                        require_once(VIEWS_PATH."payment-list.php");
                    }
                }
            }
        }
    }

?>
