<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'password' => Hash::make('12345678'),
            'email' => '456@gmail.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'password' => Hash::make('12345678'),
            'email' => '789@gmail.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // insert note info into notes
        DB::table('notes')->insert([
            'title' => 'note1',
            'note' => 'good morning',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('notes')->insert([
            'title' => 'note2',
            'note' => 'good afternoon',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('notes')->insert([
            'title' => 'note3',
            'note' => 'good evening',
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // insert note info into notes
        DB::table('notes')->insert([
            'title' => 'note1',
            'note' => 'good morning',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('notes')->insert([
            'title' => 'note2',
            'note' => 'good afternoon',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('notes')->insert([
            'title' => 'note3',
            'note' => 'good evening',
            'user_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}



