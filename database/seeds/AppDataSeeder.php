<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

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

        // Remove all previously created files
        Storage::delete(
            Storage::files(config('app.uploads_dir_name'))
        );

        // Populate the tables with categories, posts, comments and uploaded files
        factory(App\Category::class, (int)$this->random($seedingConf->categories))->create()->each(
            function ($category) use ($seedingConf) {
                // Categories Posts
                $category->posts()->createMany(
                    factory(App\Post::class, (int)$this->random($seedingConf->posts))->make()->toArray())->each(
                        function ($post) use ($seedingConf) {
                            // Post Uploaded File
                            $file = $post->file()->create(
                                factory(App\PostUpload::class)->make()->toArray()
                            );

                            // Create a file physically, by moving blank file
                            Storage::copy(config('app.blank_file_name'), $file->path);

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

    /**
     * It's a good idea to display the amount of data generated for each entity
     * after finished seeding process.
     * 
     * @todo make this optional function if time is left
     */
    private function seedLog()
    {
        // @todo optional (because it's for me only)
    }

}
