<?php  

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'firstname' =>'Admin',
            'lastname' =>'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'status'=>1,
            'role_id'=>2,
        ]);
    }
}
