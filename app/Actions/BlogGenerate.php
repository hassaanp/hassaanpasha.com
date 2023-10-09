<?php

namespace App\Actions;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class BlogGenerate
{
    use AsAction;

    public string $commandSignature = 'blog:generate {title} {--tag=}';

    public function handle(Command $command)
    {
        // write a file to storage with the title provided
        $title = $command->argument('title');
        $tag = $command->option('tag') ?? 'general';
        $slug = str_replace(' ', '-', strtolower($title));
        $date = now()->format('Y-m-d H:i:s');
        $content = <<<EOT
---
title: $title
date: $date
description: This is a description
slug: $slug
tag: $tag
author: Hassaan Pasha
---
# $title
This is a blog post
EOT;

        $filename = 'blog/' . str_replace(' ', '-', strtolower($title)) . '.md';
        $command->info('Writing file ' . $filename);
        $command->info($content);
        // write the file to storage
        Storage::disk('local')->put($filename, $content);
    }
}
