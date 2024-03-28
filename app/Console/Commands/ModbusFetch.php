<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ModbusTcpClient\Network\NonBlockingClient;
use ModbusTcpClient\Composer\Read\ReadRegistersBuilder;

class ModbusFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:modbus-fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from HMI through ModBus';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // replace addresses from the database
        $addresses = ['tcp://localhost:502'];

        foreach ($addresses as $address) {
            
            $unitID = 1; // also known as 'slave ID'
            $fc3 = ReadRegistersBuilder::newReadHoldingRegisters($address, $unitID)
                ->int16(10, 'thick_act_left')
                ->int16(20, 'thick_act_right')
                ->build();

                try {
                    $responseContainer = (new NonBlockingClient(['readTimeoutSec' => 0.5]))->sendRequests($fc3);
                    print_r($responseContainer->getData());
                } catch (\Throwable $th) {
                    print_r($th->getMessage());
                }
        }

    }
}
