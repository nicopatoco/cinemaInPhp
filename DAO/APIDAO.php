<?php
    namespace DAO;

    use DAO\IAPIDAO as IAPIDAO;

    class APIDAO implements IAPIDAO
    {
        public function UpdateAllMovies()
        {
            try
            {
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                    CURLOPT_URL => MOVIE_DB_API_URL . MOVIE_DB_API_KEY,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10000,
                    CURLOPT_TIMEOUT => 10000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "{}",
                ));

                $response = curl_exec($curl);
                
                $err = curl_error($curl);

                curl_close($curl);
                $arrayToDecode = json_decode($response,true);
                
                return $arrayToDecode["results"];
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
        
        public function UpdateAllGenres()
        {
            try
            {
                $curl = curl_init();

                curl_setopt_array
                (
                    $curl,
                    array
                    (
                        CURLOPT_URL => MOVIE_DB_API_GENRES_URL . MOVIE_DB_API_KEY,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_POSTFIELDS => "{}",
                    )
                );

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
                $arrayToDecode = json_decode($response,true);

                return $arrayToDecode["genres"];
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function RetrieveRuntime($id)
        {
            try
            {
                $curl = curl_init();

                curl_setopt_array
                (
                    $curl,
                    array
                    (
                        CURLOPT_URL => MOVIE_DB_API_GET_BY_ID_BASE_URL . $id . MOVIE_DB_API_GET_BY_ID_PARAMS_URL . MOVIE_DB_API_KEY,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10000,
                        CURLOPT_TIMEOUT => 10000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_POSTFIELDS => "{}",
                    )
                );

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                $arrayToDecode=json_decode($response,true);
            
                return $arrayToDecode['runtime'];
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
    }
?>