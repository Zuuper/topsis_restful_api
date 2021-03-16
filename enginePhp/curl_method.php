<?php
    include 'requirement.php';

    function GetData($url){
        $curl = curl_init();

        // set url yang mau dituju pake curl_setopt()
        curl_setopt($curl,CURLOPT_URL,$url);

        // return hasil transfer sebagai string 
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

        // curl_exec() melakukan eksekusi untuk memulai session curl
        // $output menghasilkan output string
        $output = curl_exec($curl);
        if($e = curl_error($curl)){
            echo $e;
        }else{
            $decoded = json_decode($output,true);
            return $decoded['data'];
        }
    }
    function PutData($url,$data){
        // error dia gak mau ngirim data ke endpoint 
        $curl = curl_init();
        $out = http_build_query($data);
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");
        curl_setopt($curl,CURLOPT_POSTFIELDS,$out);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        // curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
        $output = curl_exec($curl);
        if($e = curl_error($curl)){
            return $e;
        }else{
            return $decoded = json_decode($output,true);
        }
        
    }
?>