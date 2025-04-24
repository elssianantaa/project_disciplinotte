<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CatatanPelanggaran;

class RefreshPelanggaran extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-pelanggaran';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pelanggarans = CatatanPelanggaran::with('student', 'pelanggaran')->get();

    foreach ($pelanggarans as $pelanggaran) {
        $this->info("Diproses pelanggaran ID: {$pelanggaran->id}");
    }

    $this->info('Pelanggaran data berhasil diproses!');
    }
}
