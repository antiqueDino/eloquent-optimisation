<?php

use App\Author;
use App\Company;
use App\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(App\User::class)->create(['name' => 'Jonathan Reinink', 'email' => 'jonathan@reinink.ca', 'company_id' => factory(App\Company::class)->create()->id]);
        factory(App\User::class)->create(['name' => 'Taylor Otwell', 'email' => 'taylor@laravel.com', 'company_id' => factory(App\Company::class)->create()->id]);
        factory(App\User::class)->create(['name' => 'Ian Landsman', 'email' => 'ian@userscape.com', 'is_admin' => true, 'company_id' => factory(App\Company::class)->create()->id]);

        $companies = factory(Company::class, 200)->create();
        
        $authors = factory(Author::class, 10)->create();

        factory(Post::class, 100)->create()->each(function ($post) use($authors){
            $post->update([
                'author_id' => $authors->random()->id,
            ]);

        });

        factory(App\User::class, 500)->create()->each(function ($user) use($companies){
            $user->update([
                'company_id' => $companies->random()->id,
            ]);
            $user->last_logins()->saveMany(
                factory(App\LastLogin::class, 5)->make()
            );
        });
        
    
        
        $features = factory(App\Features::class, 150)->create();
        
        factory(App\Comment::class, 200)->create()->each(function ($comment) use($features){
            $comment->update([
                'features_id' => $features->random()->id
            ]);
        });

        factory(App\LastLogin::class)->create(['user_id' => 1]);
        factory(App\LastLogin::class)->create(['user_id' => 2]);
        factory(App\LastLogin::class)->create(['user_id' => 3]);

        factory(App\Customer::class, 500)->create()->each(function ($customer) use($companies){
            $customer->update([
                'company_id' => $companies->random()->id,
                'sales_rep_id' => random_int(1, 2),
            ]);

            $customer->interactions()->saveMany(factory(App\Interaction::class, 500)->make());
        });


    }
}
