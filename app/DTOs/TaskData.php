<?php

namespace App\DTOs;

class TaskData
{
    public $title;
    public $description;
    public $status;

    public function __construct(array $data = [])
    {
        $this->title = $data['title'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = $data['status'] ?? 'pending';
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}