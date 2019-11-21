<?php
    namespace Helpers;

    use DAO\RoomDAO as RoomDAO;

    class RoomHelper
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new RoomDAO();
        }
        
        public function GetRoomById($id)
        {
            return $this->repo->GetById($id);
        }

        public function GetRoomsListByCinemaId($id)
        {
            return $this->repo->GetRoomsByCinemaId($id);
        }
    }
?>