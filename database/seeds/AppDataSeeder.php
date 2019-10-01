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
        $seedCnf = (object)config('app.app_seed');

        // populate the tables with categories, posts, comments and uploaded files
        factory(App\Category::class, (int)$seedCnf->categories)->create()->each(
            function ($category) use ($seedCnf) {
                // categories posts
                $category->posts()->createMany(
                    factory(App\Post::class, (int)$seedCnf->categories_posts)->make()->toArray())->each(
                        function ($post) use ($seedCnf) {
                            // post uploaded file
                            $post->file()->create(
                                factory(App\PostUpload::class)->make()->toArray()
                            );
                            // post comments
                            $post->comments()->createMany(
                                factory(App\Comment::class, (int)$seedCnf->posts_comments)->states('post')->make()->toArray()
                            );
                        }
                    );
                // category comments
                $category->comments()->createMany(
                    factory(App\Comment::class, (int)$seedCnf->categories_comments)->states('category')->make()->toArray()
                );
            }
        );

        // populate the visitors table
        factory(App\Visitor::class, (int)$seedCnf->visitors)->create();

    }

}
