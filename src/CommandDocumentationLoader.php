<?php

namespace Bestmomo\NiceArtisan;

use Illuminate\Support\Facades\File;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class CommandDocumentationLoader
{
    /**
     * Markdown to HTML converter instance
     *
     * @var MarkdownConverter
     */
    protected $converter;

    /**
     * Path to the directory containing command documentation files
     *
     * @var string
     */
    protected $docsPath;

    /**
     * Constructor - Initializes the Markdown converter and documentation path
     */
    public function __construct()
    {
        // Configure CommonMark environment with Markdown extensions
        $environment = new Environment([]);
        $environment->addExtension(new CommonMarkCoreExtension()); // Core Markdown syntax
        $environment->addExtension(new TableExtension()); // Table support
        $this->converter = new MarkdownConverter($environment);

        // Set the path to command documentation resources
        $this->docsPath = __DIR__ . '/../resources/commands';
    }

    /**
     * Get documentation for a specific command
     *
     * @param string $commandName The name of the command (e.g., 'make:controller')
     * @return array|null Returns parsed documentation array or null if not found
     */
    public function get(string $commandName): ?array
    {
        // Convert command name to filename format (replace ':' with '-')
        $filename = $this->getFilename($commandName);
        $filePath = $this->docsPath . '/' . $filename;

        // Return null if documentation file doesn't exist
        if (!File::exists($filePath)) {
            return null;
        }

        // Read file content and parse Markdown
        $content = File::get($filePath);
        return $this->parseMarkdown($content, $commandName);
    }

    /**
     * Convert command name to filename format
     *
     * @param string $commandName Command name with colons (e.g., 'make:controller')
     * @return string Filename with hyphens (e.g., 'make-controller.md')
     */
    protected function getFilename(string $commandName): string
    {
        return str_replace(':', '-', $commandName) . '.md';
    }

    /**
     * Parse Markdown content and extract metadata
     *
     * @param string $content Raw Markdown content
     * @param string $commandName Original command name
     * @return array Structured documentation data
     */
    protected function parseMarkdown(string $content, string $commandName): array
    {
        // Convert Markdown to HTML
        $html = $this->converter->convert($content);

        // Extract metadata from the Markdown content
        $metadata = $this->extractMetadata($content);

        return [
            'command' => $commandName,  // Original command name
            'html' => $html->getContent(),  // Rendered HTML content
            'metadata' => $metadata,  // Extracted metadata (category, related commands)
            'raw' => $content  // Original Markdown content
        ];
    }

    /**
     * Extract metadata from Markdown content using regex patterns
     *
     * @param string $content Markdown content to parse
     * @return array Extracted metadata
     */
    protected function extractMetadata(string $content): array
    {
        $metadata = [];

        // Extract category if present in format: **Category**: CategoryName
        if (preg_match('/\*\*Category\*\*:\s*(.+)/', $content, $matches)) {
            $metadata['category'] = trim($matches[1]);
        }

        // Extract related commands if present in format: **Related**: cmd1, cmd2, cmd3
        if (preg_match('/\*\*Related\*\*:\s*(.+)/', $content, $matches)) {
            $metadata['related'] = array_map('trim', explode(',', $matches[1]));
        }

        return $metadata;
    }

    /**
     * Get documentation for all available commands
     *
     * @return array Array of all command documentation, keyed by command name
     */
    public function getAll(): array
    {
        $files = File::files($this->docsPath);
        $commands = [];

        foreach ($files as $file) {
            // Process only .md files
            if ($file->getExtension() === 'md') {
                // Convert filename back to command name format
                $commandName = $this->getCommandNameFromFilename($file->getFilename());
                $commands[$commandName] = $this->get($commandName);
            }
        }

        return $commands;
    }

    /**
     * Convert filename back to command name format
     *
     * @param string $filename Filename with hyphens (e.g., 'make-controller.md')
     * @return string Command name with colons (e.g., 'make:controller')
     */
    protected function getCommandNameFromFilename(string $filename): string
    {
        return str_replace('-', ':', pathinfo($filename, PATHINFO_FILENAME));
    }
}