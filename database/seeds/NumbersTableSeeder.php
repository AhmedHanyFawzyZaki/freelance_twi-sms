<?php

use App\Number;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class NumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('numbers')->delete();
        $json = File::get("database/data/numbers.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Number::create(
                array(
                    'number'    => $obj->number,
                    'msg'        => $obj->msg
                )
            );
        }
    }
}
