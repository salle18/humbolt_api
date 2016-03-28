<?php

use Illuminate\Database\Seeder;

class CsmpSimulationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $simulations = $this->read_simulations();
        foreach ($simulations as $simulation) {
            DB::table('csmp_simulations')->insert([
                'user_id' => 1,
                'description' => $simulation['description'],
                'data' => json_encode($simulation),
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        }
    }

    private function read_simulations()
    {
        $simulations = [];
        $files = File::files(__DIR__ . '/csmp_simulations');
        natsort($files);
        foreach ($files as $filename) {
            $file = File::get($filename);
            $simulations[] = json_decode($file, true);
        }
        return $simulations;
    }
}
