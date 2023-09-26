<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class BlogReader
{
    use AsAction;

    public string $commandSignature = 'blog:read';

    public function handle()
    {
        // read files from storage
        $files = Storage::disk('local')->files('blog');

        // return a collection of blog posts
        return collect($files)->map(function ($file) {
            $content = Storage::disk('local')->get($file);
            $data = $this->parseMarkdown($content);
            return [
                'title' => $data['title'] ?? basename($file, '.md'),
                'date' => $data['date'] ?? null,
                'description' => $data['description'] ?? null,
                'content' => $data['content'] ?? null,
                'slug' => basename($file, '.md'),
            ];
        });

        // return $posts->sortBy('date', SORT_REGULAR, true);
    }

    protected function parseMarkdown($content)
    {
        $data = [];
        if (preg_match('/^---\s*\n(.*?)\n---/s', $content, $match)) {
            $metaLines = explode("\n", $match[1]);
            foreach ($metaLines as $line) {
                if (preg_match('/^(title|date|description):\s*(.*)$/', $line, $lineMatch)) {
                    $data[$lineMatch[1]] = trim($lineMatch[2]);
                }
            }
        }

        $data['content'] = preg_replace('/^---\s*\n(.*?)\n---/s', '', $content);

        return $data;
    }
}
