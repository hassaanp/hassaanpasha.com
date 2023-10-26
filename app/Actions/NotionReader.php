<?php

namespace App\Actions;

use DateTime;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Notion\Notion;
use OpenAI\Laravel\Facades\OpenAI;


use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class NotionReader
{
    use AsAction;

    public string $commandSignature = 'notion:read';

    public function __invoke(Request $request)
    {
        $this->handle();

        return response()->json(['message' => 'generated successfully']);
    }

    public function handle()
    {
        $token = "secret_WVPCuE7LLJhC4JQyUDFGZijXC894HhWNI2vugLMzc0o";
        $notion = Notion::create($token);

        // $users = $notion->users()->findAll();

        // dd($users);
        $pageId = $this->extractNotionPageId('https://www.notion.so/Blogs-23ea96ddb4ad42ec8ef3d411706a549c?pvs=4');
        $blogs = $notion->blocks()->findChildren($pageId);

        // filter the blogs which are published
        $blogs = array_filter($blogs, function ($blog) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $blog->title)));
            return !Storage::disk('local')->exists('blog/' . $slug . '.md');
        });

        foreach ($blogs as $blog) {
            Log::info('Processing blog: ' . $blog->title);
            // convert title to slug
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $blog->title)));
            $date = $blog->metadata()->createdTime->format(DateTime::ATOM);
            $blocksOfBlog = $notion->blocks()->findChildren($blog->metadata()->id);
            $content = $this->extractContentAsMarkdown($blocksOfBlog);
            $description = $this->generateDescription($blog->title, $content);

            // add Front matter to markdown
            $frontMatter = <<<EOD
---
title: {$blog->title}
date: {$date}
description: {$description}
author: Hassaan Pasha
---
EOD;
            $markdown = $frontMatter . "\n\n" . $content;

            Log::info('Writing blog to file: ' . $slug);
            // write to file
            Storage::disk('local')->put('blog/' . $slug . '.md', $markdown);
        }

        $process = new Process(['npm', 'run', 'build']);
        $process->setWorkingDirectory(base_path()); // Ensure we're in the root directory of the project
        $process->run();

        // Check if the process was successful
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    private function extractNotionPageId($url)
    {
        // Extract the part of the URL after 'notion.so/'
        $path = parse_url($url, PHP_URL_PATH);
        // Get the last segment of the path (the part after the last '/')
        $pathSegments = explode('/', $path);
        $lastSegment = end($pathSegments);
        // Use regex to extract the page ID
        if (preg_match('/([a-f0-9]{8})([a-f0-9]{4})([a-f0-9]{4})([a-f0-9]{4})([a-f0-9]{12})/', $lastSegment, $matches)) {
            // Reformat the page ID according to the specified pattern
            $formattedPageId = implode('-', array_slice($matches, 1));
            return $formattedPageId;
        } else {
            // Return null if the URL doesn't match the expected format
            return null;
        }
    }


    private function extractContentAsMarkdown($blocks)
    {
        $markdownContent = '';
        foreach ($blocks as $block) {
            if (isset($block->metadata()->type->value)) {
                $type = $block->metadata()->type->value;
                $content = '';
                switch ($type) {
                    case 'image':
                        if (isset($block->file->url)) {
                            $caption = count($block->file->caption) > 0 ? $block->file->caption[0]->plainText : '';
                            $content = "![{$caption}]({$block->file->url})\n\n";
                        }
                        break;
                    case 'heading_1':
                        if (isset($block->text[0]->plainText)) {
                            $content = "# " . $block->text[0]->plainText . "\n\n";
                        }
                        break;
                    case 'heading_2':
                        if (isset($block->text[0]->plainText)) {
                            $content = "## " . $block->text[0]->plainText . "\n\n";
                        }
                        break;
                    case 'heading_3':
                        if (isset($block->text[0]->plainText)) {
                            $content = "### " . $block->text[0]->plainText . "\n\n";
                        }
                        break;
                    case 'paragraph':
                        if (isset($block->text) && is_array($block->text)) {
                            foreach ($block->text as $text) {
                                if (isset($text->plainText)) {
                                    $richText = $text->plainText;
                                    if ($text->annotations->isBold) {
                                        $richText = '**' . $richText . '**';
                                    }
                                    if ($text->annotations->isItalic) {
                                        $richText = '*' . $richText . '*';
                                    }
                                    $content .= $richText . "\n\n";
                                }
                            }
                        }
                        break;
                        // ... other cases for other block types
                }

                if (isset($block->text) && count($block->text) > 0 && $block->text[0]->href) {
                    $content = '[' . trim($content, "\n") . '](' . $block->text[0]->href . ')' . "\n\n";
                }

                $markdownContent .= $content;
            }
        }
        return $markdownContent;
    }

    private function generateDescription($title, $content)
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Generate a single line description for a blog post.\n\nBlog title: " . $title . "\n\nBlog content: " . $content . "\n\nDescription:",
                ]
            ],
        ]);

        return $result->choices[0]->message->content;
    }
}
