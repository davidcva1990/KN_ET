<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;




class CreatePosCmd extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pos:createpos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta el comando para crear posiciones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $campo1 = $this->ask('Ingrese el Id de empresa');
        $campo2 = $this->ask('Ingrese el Id de producto');
        $campo3 = $this->ask('Ingrese la fecha de entrega, en formato YYYY-MM-DD');
        $campo4 = $this->ask('Ingrese el Tipo de moneda: ej ARS, USD o EUR');
        $campo5 = $this->ask('Ingrese el precio en valor numerico');

        try {
            $response = Http::post('http://localhost:8000/api/posiciones', [
                // Aquí puedes enviar los datos necesarios para crear una nueva posición
                'idEmpresa' => $campo1,
                'idProducto' => $campo2,
                'fechaEntregaInicio' => $campo3,
                'moneda' => $campo4,
                'precio' => $campo5,
                // Agrega los campos y valores necesarios según tu API
            ]);
        
            $this->info('API response: ' . $response->body());
            } catch (ConnectionException $exception) {
                $this->error('Failed to connect to API: ' . $exception->getMessage());
            }
    }
}
