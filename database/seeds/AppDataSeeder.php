<?php

use Illuminate\Database\Seeder;

class AppDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedingConf = (object)config('app.seeding');

        // Populate the tables with categories, posts, comments and uploaded files
        factory(App\Category::class, (int)$this->random($seedingConf->categories))->create()->each(
            function ($category) use ($seedingConf) {
                // Categories Posts
                $category->posts()->createMany(
                    factory(App\Post::class, (int)$this->random($seedingConf->posts))->make()->toArray())->each(
                        function ($post) use ($seedingConf) {
                            // Post Uploaded File
                            $post->file()->create(
                                factory(App\PostUpload::class)->states('predefined')->make()->toArray()
                            );
                            // Post Comments
                            $post->comments()->createMany(
                                factory(App\Comment::class, (int)$this->random($seedingConf->posts_comments))->states('post')->make()->toArray()
                            );
                        }
                    );
                // Category Comments
                $category->comments()->createMany(
                    factory(App\Comment::class, (int)$this->random($seedingConf->categories_comments))->states('category')->make()->toArray()
                );
            }
        );

        // Populate the visitors table
        factory(App\Visitor::class, (int)$this->random($seedingConf->visitors))->create();

    }

    /**
     * Get a random number from the specified numbers range.
     * 
     * $numbersRange is a string in `from..to` format.
     * See DB_SEED_* options in the .env.example file for more details.
     */
    private function random ($numbersRange, $delimiter = '..')
    {
        list($from, $to) = explode($delimiter, $numbersRange);

        return rand((int)$from, (int)$to);
    }

}
