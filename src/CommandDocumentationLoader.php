<?php

namespace Bestmomo\NiceArtisan;

use Illuminate\Support\Facades\File;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class CommandDocumentationLoader
{
    protected $converter;
    protected $docsPath;

    public function __construct()
    {
        $environment = new Environment([]);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());
        $this->converter = new MarkdownConverter($environment);

        $this->docsPath = __DIR__ . '/../resources/commands';
    }

    public function get(string $commandName): ?array
    {
        $filename = $this->getFilename($commandName);
        $filePath = $this->docsPath . '/' . $filename;

        if (!File::exists($filePath)) {
            return null;
        }

        $content = File::get($filePath);
        return $this->parseMarkdown($content, $commandName);
    }

    protected function getFilename(string $commandName): string
    {
        return str_replace(':', '-', $commandName) . '.md';
    }

    protected function parseMarkdown(string $content, string $commandName): array
    {
        $html = $this->converter->convert($content);

        // Extraire les métadonnées si présentes
        $metadata = $this->extractMetadata($content);

        return [
            'command' => $commandName,
            'html' => $html->getContent(),
            'metadata' => $metadata,
            'raw' => $content
        ];
    }

    protected function extractMetadata(string $content): array
    {
        $metadata = [];

        if (preg_match('/\*\*Category\*\*:\s*(.+)/', $content, $matches)) {
            $metadata['category'] = trim($matches[1]);
        }

        if (preg_match('/\*\*Related\*\*:\s*(.+)/', $content, $matches)) {
            $metadata['related'] = array_map('trim', explode(',', $matches[1]));
        }

        return $metadata;
    }

    public function getAll(): array
    {
        $files = File::files($this->docsPath);
        $commands = [];

        foreach ($files as $file) {
            if ($file->getExtension() === 'md') {
                $commandName = $this->getCommandNameFromFilename($file->getFilename());
                $commands[$commandName] = $this->get($commandName);
            }
        }

        return $commands;
    }

    protected function getCommandNameFromFilename(string $filename): string
    {
        return str_replace('-', ':', pathinfo($filename, PATHINFO_FILENAME));
    }
}
