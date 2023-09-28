<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Browsershot\Browsershot;

class ScreenshotCreator
{
    use AsAction;

    public string $commandSignature = 'blog:screenshot';

    public function handle(BlogReader $reader)
    {
        // find all the blog posts
        $posts = $reader->handle();
        $posts->each(function ($post) {
            $this->takeScreenshot($post['slug']);
        });
        // go to each page and take capture a screenshot
        // store to storage/app/public/screenshots

    }

    private function takeScreenshot($slug)
    {
        $url = url('/blog/' . $slug);
        Browsershot::url($url)
            ->windowSize(600, 315)
            ->save(storage_path('app/public/screenshots/' . $slug . '.jpg'));
    }
}
