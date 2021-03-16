<?php 

    function TopUpEngine($db_conn,$data){
        foreach($inp as $data){
            // cari data sesuai dengan id_fintechnya atau lpd
            if($data->{'id_fintech'} == $id_fintech){
                // melihat status data transaksi
                if($data->{'status'} == 'pending'){
                    $rekening_nasabah = $data->{'no_rekening'};
                    $transaksi = $data->{'jumlah_transaksi'};
                    $id_detail_topup = $data->{'id_detail_topup'};
                    // query buat nyari data nasabah di database LPD 
                    $sql = "SELECT no_rekening,saldo FROM tb_nasabah_lpd WHERE no_rekening=$rekening_nasabah";
                    $result = $conn->query($sql);
                    // ngecek hasil dari query diatas
                    if($result->num_rows > 0){
                        $result = mysqli_fetch_array($result);
                        // ngecek saldo yang tersisa di database LPD
                        if($transaksi < $result['saldo']){
                            $sisa_saldo = $result['saldo'] - $transaksi;
                            // melakukan update transaksi ketika jumlah saldo dibawah 
                            $sql_update = "UPDATE tb_nasabah_lpd SET saldo=$sisa_saldo WHERE no_rekening=$rekening_nasabah";
                            $sql_update = $conn->query($sql_update);
                            if($sql_update){
                                $data_array = array([
                                    'status' => 'sukses'
                                ]);
                                $new_url = $url."/".$id_detail_topup; 
                                $out = PutData($new_url,$data_array);
                                if($out){
                                    echo $out;
                                }
                                echo "Gagal update data ke cloud server endpoint : $new_url \n\n";
                            }
                        }
                    }
                }
            }
        }
    }

    function TransferEngine($db_conn,$data){
        
    }
?>