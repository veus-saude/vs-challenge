<?php

use App\Models\Institutions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class InstitutionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('institutions')->delete();
        $intitution0 = Institutions::create([
            'id'             =>1,
            'name'           =>'Shield Force',
            'document'       =>'10142449784',
            'whatsapp'       =>'(21) 97018-5540',
            'phone_two'      =>'(21) 99999-9999',
            'tag'            =>'shield-force',
            'uuid'           => Uuid::uuid4()
        ]);
    }
}

