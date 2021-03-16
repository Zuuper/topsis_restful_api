<?php

namespace App\Listeners;

use App\Events\CheckTopUpStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\DetailTopUp;
use App\Models\Dompet;
class CheckStatusTopUp
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckTopUpStatus  $event
     * @return void
     */
    public function handle(CheckTopUpStatus $event)
    {
        $data = $event;
        $status = false;
        for($i = 0; $i >=5;$i++){
            sleep(1);
            $detail = DetailTopUp::where('id_topup',$data['id_topup'])->first();
            if($detail['status'] === 'sukses'){
                $saldo = Dompet::where('id_dompet',$data['id_dompet'])->update([
                    'saldo' => $data['jumlah_transaksi']
                ]);
                $status = true;
                break;
            }
        }
        return $status;
    }
}
