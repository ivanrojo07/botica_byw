<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;

class ReportesSFTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reportes:paypal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reportes de paypal';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $files = Storage::disk('sftp')->AllFiles('/ppreports/outgoing');

        // $contenidoReporte = Storage::disk('sftp')->allFiles('/');
        // $filesystem = new Filesystem(new SftpAdapter([
        //     'host' =>'sftp://reports.paypal.com',
        //     'username' => 'sftpre_sistemas1rxlatinmed.com',
        //     'password' => 'Sistemas1#',
        //     'root'=>'/',
        //     // 'port' => 21,
        //     // 'timeout' => 10,
        // ]));
        if (!empty($files)) {
            // dd("hola");
            foreach ($files as $file) {
                dd($file);
                Storage::put('reportes/Reporte.xls', $fileContents);
            }
        }
        else{
            dd($files);
            
        }
        // $contenido = $filesystem->directories('/');
    }
}
