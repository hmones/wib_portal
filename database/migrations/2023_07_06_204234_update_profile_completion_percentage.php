<?php

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Migrations\Migration;

class UpdateProfileCompletionPercentage extends Migration
{
    public function up(): void
    {
        $users = User::select(
            'id',
            'title',
            'name',
            'image',
            'bio',
            'education',
            'gender',
            'birth_year',
            'phone_country_code',
            'phone',
            'country_id',
            'city_id',
            'postal_code',
            'business_association_wom',
            'newsletter',
            'mena_diaspora',
            'notify_user',
            'notify_comment',
            'notify_post',
            'notify_message'
        )->with('links')->get()->toArray();
        $userRepository = resolve(UserRepository::class);

        foreach ($users as $user) {
            $data_percent = $userRepository->calculateCompletion($user);
            User::find($user['id'])->update(compact('data_percent'));
        }
    }

    public function down(): void
    {
        //
    }
}
