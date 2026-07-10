<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // 1. Admin User Create
        \App\Models\User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => '01700000000',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        // 2. 22 Members Data Array
        $members = [
            [1, 'MD. Sobuj Ahmed', 3, '8801776683087'],
            [2, 'MD. Ahmed Ullah Labib', 1, '8801736514891'],
            [3, 'MD. Pervej', 1, '8801626024010'],
            [4, 'Mohammad Feroz Shikder', 1, '8801722665514'],
            [5, 'MD. Sheikh Shawon', 1, '8801926921573'],
            [6, 'MD. Abid Bhuiyan', 1, '8801765754709'],
            [7, 'Mohammad Rayhan Mia', 1, '96671150351'],
            [8, 'MD. Selim Sordar', 3, '8801770606957'],
            [9, 'MD. Tanvir Shikder', 0.5, '8801712002664'],
            [10, 'Sheikh Awal', 0.5, '8801721735455'],
            [11, 'Md. Alim Sordar', 0.5, '8801613227571'],
            [12, 'MD. Milon Khan', 1, '8801911153520'],
            [13, 'Abu Sayed', 1, '8801772302888'],
            [14, 'Nojrul Islam', 1, '8801618879606'],
            [15, 'Jasim Ahmed', 1, '8801621721417'],
            [16, 'Rakib Khan', 1, '8801983350073'],
            [17, 'MD. Rajib', 0.5, '97431253220'],
            [18, 'Md.Nojrul Ahmed (Savar)', 0.5, '8801937994382'],
            [19, 'Mosaraf Hossain Shawon', 1, '8801869811799'],
            [20, 'Abdur Rahman', 1, '971567956661'],
            [21, 'Mousumi Afrin', 0.5, '8801990879545'],
            [22, 'Parul Akter', 0.5, '8801846066685'],
        ];

        // 3. Loop through and create User & Member
        foreach ($members as $data) {
            $accountNo = $data[0];
            $name = $data[1];
            $shares = $data[2];
            $mobile = $data[3];
            
            // Password is last 6 digits of mobile
            $passwordStr = substr($mobile, -6);

            // Create User for Login
            $user = User::create([
                'name' => $name,
                'username' => $mobile,
                'phone' => $mobile,
                'password' => Hash::make($passwordStr),
            ]);

            // Create Member Profile
            Member::create([
                'account_no' => $accountNo,
                'name_english' => $name,
                'shares' => $shares,
                'mobile' => $mobile,
                'gender' => in_array($accountNo, [21, 22]) ? 'Female' : 'Male', // Last 2 are Female
                'registration_date' => now()->toDateString(),
                'user_id' => $user->id,
            ]);
        }

        
        \App\Models\SmsTemplate::insert([
            [
                'name' => 'Due Reminder - 10th', 
                'category' => 'Due SMS', 
                'message' => 'সমিতির মাসিক কিস্তির সময় হয়েছে। অনুগ্রহ করে ১৫ তারিখের মধ্যে জমা দিন।',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Last Reminder - 14th', 
                'category' => 'Due SMS', 
                'message' => 'সতর্কতা: আপনার মাসিক কিস্তি বাকি। আজ ১৫ তারিখ শেষ দিন, জমা না দিলে ফাইন বসবে।',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Loan Installment', 
                'category' => 'Loan SMS', 
                'message' => 'আপনার লোনের কিস্তির তারিখ ঘনিয়ে এসেছে। অনুগ্রহ করে সময়মতো পরিশোধ করুন।',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}