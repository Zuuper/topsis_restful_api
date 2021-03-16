<?php

namespace App\Listeners;

use App\Events\CheckTopUpStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\DetailTopUp;
use App\Models\Nasabah;
class CreateDetailTopUP
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
        $nasabah = Nasabah::where('id_nasabah', $data['id_nasabah'])->first();
        $result = DetailTopUp::create([
            'id_topup' => $data['id_topup'],
            'id_fintech' => $nasabah['id_fintech'],
            'id_dompet' => $nasabah['id_dompet'],
            'no_rekening' =>$nasabah['no_rekening'],
            'jumlah_transaksi' => $data['jumlah_transaksi'],
            'status' => 'pending'
        ]);
        return true;
    }
}
