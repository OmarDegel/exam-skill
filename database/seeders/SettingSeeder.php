<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'email'=>"osamy8088@gmail.com",
            'phone'=>"01019631989",
            'facebook'=>"https://www.facebook.com/eslam.ozil.52",
            'twitter'=>"https://x.com/OmarDegel",
            'instgram'=>"https://www.instagram.com/omar_degel/",
            'linkedin'=>"https://www.linkedin.com/in/omar-samy-b28200316?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app",
            
        ]);
    }
}
