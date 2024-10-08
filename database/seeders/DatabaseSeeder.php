<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use App\Models\Conversation;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $john = User::factory()->create([
            "name" => "John Doe",
            "email" => "john@example.test",
            "password" => bcrypt("password"),
            "is_admin" => true
        ]);

        $jane = User::factory()->create([
            "name" => "Jane Doe",
            "email" => "jane@example.test",
            "password" => bcrypt("password"),
        ]);

        //Créer des users additionnels
        $additionalUsers = User::factory(20)->create();

        //Création de groupes
        for($i = 0; $i < 5; $i++){
            $group = Group::factory()->create([
                "owner_id" => $john->id
            ]);

            $userIds = User::inRandomOrder()->limit(rand(2, 5))->pluck('id')->toArray();
            $group->users()->attach(array_unique([$john->id, ...$userIds]));
        }
        
        Message::factory(1000)->create();

        //Création des conversations
        $messages = Message::whereNull('group_id')->orderBy('created_at')->get();

        $conversations = $messages->groupBy(function(Message $message) {
            return collect([$message->sender_id, $message->receiver_id])
            ->sort()
            ->implode('_');

        })->map(function ($groupedMessages) {
           
            return [
                "user_id1" => $groupedMessages->first()->sender_id,
                "user_id2" => $groupedMessages->first()->recever_id,
                "last_message_id" => $groupedMessages->last()->id,
                "created_at" => new \Carbon\Carbon(),
                "updated_at" => new \Carbon\Carbon()
            ];
        });

        Conversation::insert($conversations->toArray());


        $this->command->info("Seedage terminé avec succès !"); //loguer la complétion du seedage
    }
}
