<?php

namespace Database\Seeders;

use App\Models\KebijakanPrivasi;
use Illuminate\Database\Seeder;
use Str;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'users']);

        $admin = User::create([
            'nama' => 'Admin SEC',
            'email' => 'adminsec@gmail.com',
            'password' => bcrypt('adminsec123'),
            'tentang_saya' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore dignissimos doloremque est unde eum voluptatum id, quas mollitia quod eaque iure architecto minima debitis aliquam, possimus, provident voluptas expedita. Repellat!',
            'foto_profil' => 'default.png',
            'status_member' => 'private',
            'email_verified_at' => now(),
            'is_active' => 'active',
            'remember_token' => Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($admin));
        $admin->assignRole('admin');

        $users = User::create([
            'nama' => 'User Demo',
            'email' => 'userdemo@gmail.com',
            'password' => bcrypt('userdemo123'),
            'tentang_saya' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore dignissimos doloremque est unde eum voluptatum id, quas mollitia quod eaque iure architecto minima debitis aliquam, possimus, provident voluptas expedita. Repellat!',
            'foto_profil' => 'default.png',
            'status_member' => 'reguler',
            'email_verified_at' => now(),
            'is_active' => 'active',
            'remember_token' => Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($users));
        $users->assignRole('users');

        $newKebijakan = new KebijakanPrivasi;
        $newKebijakan->konten = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet perferendis deleniti inventore unde ab ut voluptatem hic molestiae, reprehenderit et voluptate dolor nesciunt temporibus sint magni consequatur! Aut, mollitia illo!';
        $newKebijakan->save();
    }
}
