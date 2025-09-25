<?php
namespace Bestmomo\NiceArtisan;
use Illuminate\Support\Facades\Storage;
use Exception;

class JsonListManager
{
    /**
     * The file path relative to the 'storage/app' directory.
     *
     * @var string
     */
    protected $filePath;

    /**
     * @param string $fileName
     */
    public function __construct($fileName = 'liste.json')
    {
        // Set the file path in a package-specific subdirectory
        $this->filePath = 'niceartisan/' . $fileName;

        // Ensure the directory and file exist upon initialization
        $this->ensureFileAndDirectoryExists();
    }

    /**
     * Ensures that the storage directory and file exist.
     *
     * @return void
     */
    protected function ensureFileAndDirectoryExists(): void
    {
        $directory = dirname($this->filePath);
        // 1. Ensure the directory exists
        if (! Storage::disk('local')->exists($directory)) {
            Storage::disk('local')->makeDirectory($directory);
        }
        // 2. Ensure the file exists and create it with an empty array if not
        if (! Storage::disk('local')->exists($this->filePath)) {
            Storage::disk('local')->put($this->filePath, json_encode([]));
        }
    }

    /**
     * Retrieves the list from the JSON file.
     *
     * @return array
     */
    public function getList(): array
    {
        if (! Storage::disk('local')->exists($this->filePath)) {
            return [];
        }
        try {
            $contenuJson = Storage::disk('local')->get($this->filePath);
            $liste = json_decode($contenuJson, true);
            return is_array($liste) ? $liste : [];
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Saves the list to the JSON file.
     *
     * @param array $liste
     * @return void
     */
    public function saveList(array $liste): void
    {
        $contenuJson = json_encode($liste);
        Storage::disk('local')->put($this->filePath, $contenuJson);
    }

    /**
     * Adds an element to the list and saves it, avoiding duplicates.
     *
     * @param mixed $element
     * @return void
     */
    public function addElement($element): void
    {
        $liste = $this->getList();
        // Check if the element is not already in the list
        if (! in_array($element, $liste)) {
            $liste[] = $element;
            $this->saveList($liste);
        }
    }

    /**
     * Removes an element from the list and saves it.
     *
     * @param mixed $element
     * @return void
     */
    public function removeElement($element): void
    {
        $liste = $this->getList();
        $key = array_search($element, $liste);

        if ($key !== false) {
            unset($liste[$key]);
            $this->saveList(array_values($liste)); // Re-index the array
        }
    }

    /**
     * Completely clears the list.
     *
     * @return void
     */
    public function clearList(): void
    {
        $this->saveList([]);
    }
}
