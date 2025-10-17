<?php

namespace Bestmomo\NiceArtisan;

class HistoryManager extends JsonListManager
{

    /**
     * The file path relative to the 'storage/app' directory.
     *
     * @var int
     */
    const MAX_HISTORY_SIZE = 10;

    public function __construct()
    {
        parent::__construct('history.json');
    }

    /**
     * Adds a formatted history record and manages the limit.
     *
     * @param string $commandName The name of the command (e.g., ‘make:controller’).
     * @param string $fullCommand The complete command line.
     * @param array $inputData The arguments and options of the form.
     * @return void
     */
    public function recordHistory(string $commandName, string $fullCommand, array $inputData): void
    {
        $history = $this->getList();
        $timestamp = time();

        $newEntry = [
            'id' => $commandName . '_' . $timestamp,
            'command_name' => $commandName,
            'timestamp' => $timestamp,
            'full_command' => $fullCommand,
            'input_data' => $inputData,
        ];

        array_unshift($history, $newEntry);

        $history = collect($history)
            ->unique(function ($item) {
                return $item['full_command'];
            })
            ->take(self::MAX_HISTORY_SIZE)
            ->values()
            ->toArray();

        $this->saveList($history);
    }

    /**
     * Get an element of history.
     *
     * @param string $id
     * @return array
     */
    public function getElement(string $id): array
    {
        $history = $this->getList();
        $result = array_filter($history, function ($item) use ($id) {
            return $item['id'] === $id;
        });

        return reset($result) ?: [];
    }
}
