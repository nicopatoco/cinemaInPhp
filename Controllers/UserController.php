<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use DAO\EntryDAO as EntryDAO;
use Models\User as User;

class UserController
{
    private $repo;
    private $entryRepo;

    public function __construct()
    {
        $this->repo = new UserDAO();
        $this->entryRepo = new EntryDAO();
    }

    public function ShowListView()
    {
        $userList = $this->repo->GetAll();

        require_once(VIEWS_PATH . "user-list.php");
    }

    public function Add($email, $password)
    {
        $userList = $this->repo->GetAll();

        if ($_POST) 
        {
            $flag = true;
            $username = $_POST["username"];
            $password = $_POST["password"];
            $secondPassword = $_POST["secondPassword"];

            if ($password == $secondPassword) 
            {
                foreach ($userList as $key => $value) 
                {
                    if ($username == $value->getEmail())
                    {
                        $flag = false;
                    }
                }
                if($flag)
                {
                    $user = new User();
                    $user->setEmail($email);
                    $user->setPassword($password);
                    //Normal
                    $user->setTypeId(2);
                    //Admin $user->setTypeId(1);             
                    $this->repo->Add($user);
                    $this->CheckLogin();
                }
                else
                {
                    echo "<script> alert('Existe un usuario con ese nombre.'); </script>";
                }
            }
            else
            {
                echo "<script> alert('Tus contraseñas no coinciden.'); </script>";
            }
        }
        else
        {
            echo "<script> alert('Error al procesar tu registro.'); </script>";
        }
    }

    public function Delete($id)
    {
        $this->repo->Delete($id);

        $this->ShowListView();
    }

    public function Select()
    {
        if ($_POST) 
        {
            if (isset($_POST["edit"])) 
            {
                $id = $_POST["edit"];
                $user = $this->repo->GetById($id);
                require_once(VIEWS_PATH . "user-update.php");
            } 
            else if (isset($_POST["delete"])) 
            {
                $id = $_POST["delete"];
                $user = $this->repo->GetById($id);
                $this->repo->Delete($user);
                $this->ShowListView();
            }
        }
    }

    public function Update()
    {
        if ($_POST) {
            $updatedUser = $_POST;
            $user = $this->repo->GetById($updatedUser["user_id"]);
            $this->repo->Update($user, $updatedUser);
            $this->ShowListView();
        }
    }

    public function CheckLogin()
    {
        $repo = new UserDAO();
        $userList = $repo->GetAll();

        if($_POST)
        {
            if(isset($_POST["username"]) && isset($_POST["password"]))
            {    
                $username = $_POST["username"];
                $password = $_POST["password"];
                $loggedUser = null;
                foreach ($userList as $key => $value)
                {
                    if($username == $value->getEmail())
                    {
                        if($password == $value->getPassword())
                        {
                            $loggedUser = new User();
                            $loggedUser->setId($value->getId());
                            $loggedUser->setEmail($value->getEmail());
                            $loggedUser->setPassword($value->getPassword());
                            $loggedUser->setTypeId($value->getTypeId());
                        }
                    }
                }
                if($loggedUser != null)
                {
                    $_SESSION["loggedUser"] = $loggedUser;
                    echo "<script> document.getElementById('homeNavegation').click(); </script>";
                }
                else
                {
                    echo "<script> alert('Verifique que los datos ingresados sean correctos'); </script>";
                }
            }
            else
            {
                echo "<script> alert('Hubo un problema al procesar los datos, vuelva a intentarlo !'); </script>";
            }
        }
        else
        {
            echo "<script> alert ('No es posible procesar informacion si no es por metodo POST !')); </script>";  
        }
    }

    public function CheckFacebookLogin()
    {
        //include autoload file from vendor folder
        require 'vendor/autoload.php';

        /*Step 1: Enter Credentials*/
        $fb = new \Facebook\Facebook([
            'app_id' => '2159056691069867',
            'app_secret' => 'c4b938c52afc357ed673f3d62681afdc',
            'default_graph_version' => 'v4.0',
            //'default_access_token' => '{access-token}', // optional
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $login_url = $helper->getLoginUrl("http://localhost/Framework/User/CheckFacebookLoged");
        
        echo "<script>";
        echo "window.location = '".$login_url."';</script>"; 
    
    }

    public function CheckFacebookLoged()
    {
        //include autoload file from vendor folder
        require 'vendor/autoload.php';

        /*Step 1: Enter Credentials*/
        $fb = new \Facebook\Facebook([
            'app_id' => '2159056691069867',
            'app_secret' => 'c4b938c52afc357ed673f3d62681afdc',
            'default_graph_version' => 'v4.0',
            //'default_access_token' => '{access-token}', // optional
        ]);

        $helper = $fb->getRedirectLoginHelper();
        
        try 
        {
            $accessToken = $helper->getAccessToken();
            if (isset($accessToken))
            {
                $_SESSION['access_token'] = (string) $accessToken;
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }

        //now we will get users first name , email , last name
        if (isset($_SESSION['access_token']))
        {
            try 
            {
                $fb->setDefaultAccessToken($_SESSION['access_token']);
                $res = $fb->get('/me?locale=en_US&fields=name,email');
                $user = $res->getGraphUser();

                //My users
                $repo = new UserDAO();

                $loggedUser = null;
                $flag = false;

                while(!$flag)
                {
                    $userList = $repo->GetAll();

                    foreach ($userList as $key => $value)
                    {
                        if($user->getField('email') == $value->getEmail())
                        {
                            if($user->getField('id') == $value->getPassword())
                            {
                                $loggedUser = new User();
                                $loggedUser->setId($value->getId());
                                $loggedUser->setEmail($value->getEmail());
                                $loggedUser->setPassword($value->getPassword());
                                $loggedUser->setTypeId($value->getTypeId());
                                $flag = true;
                            }
                        }
                    }

                    if(!$flag)
                    {
                        //Add facebook user to data base
                        $facebookUser = new User();
                        $facebookUser->setEmail($user->getField('email'));
                        $facebookUser->setPassword($user->getField('id'));
                        $facebookUser->setTypeId(2);             
                        $this->repo->Add($facebookUser);
                    }
                }
                //Logging in our page
                if($loggedUser != null)
                {
                    $_SESSION["loggedUser"] = $loggedUser;
                    echo "<script> document.getElementById('homeNavegation').click(); </script>";
                }
            } catch (Exception $exc)
            {
                echo $exc->getTraceAsString();
            }
        }
    }

    public function LogOut()
    {
        if(isset($_SESSION['access_token']))
        {
            session_destroy();
            unset($_SESSION['access_token']);
            unset($_SESSION["loggedUser"]);
            echo "<script> document.getElementById('homeNavegation').click(); </script>";
            
        }
        else
        {
            if ($_SESSION["loggedUser"]->getTypeId() == 1)
            {
                session_destroy();
                unset($_SESSION["loggedUser"]);
                header("location:".FRONT_ROOT);       
            }
            session_destroy();
            unset($_SESSION["loggedUser"]);
            echo "<script> document.getElementById('homeNavegation').click(); </script>";
        }
    }

    public function Profile()
    {
        if(isset($_SESSION['loggedUser']))
        {
            require_once(VIEWS_PATH . "user-profile.php");
        }

    }

    public function Purchase()
    {
        if(isset($_SESSION['loggedUser']))
        {
            $entryList = $this->entryRepo->GetAll();

            $userEntries = array();
            foreach($entryList as $key =>$entry)
            {
                if($entry->getUser()->getId() == $_SESSION['loggedUser']->getId())
                {
                    array_push($userEntries,$entry);
                }
            }

            require_once(VIEWS_PATH . "user-purchase.php");
        }

    }
}
?>
