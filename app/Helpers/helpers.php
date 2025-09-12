<?php

if (! function_exists('format_status')) {
    function format_status(string $status): string
    {
        $map = [
            'pending' => 'Pendente',
            'done' => 'Concluída',
        ];

        return $map[$status] ?? $status;
    }
}