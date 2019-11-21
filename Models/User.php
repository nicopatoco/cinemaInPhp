<?php
    namespace Models;

    class User
    {
        private $id;
        private $email;
        private $password;
        private $typeId;

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of typeId
         */ 
        public function getTypeId()
        {
                return $this->typeId;
        }

        /**
         * Set the value of typeId
         *
         * @return  self
         */ 
        public function setTypeId($typeId)
        {
                $this->typeId = $typeId;

                return $this;
        }
    }
?>