<?php

use App\Models\Guest;
use App\Models\Invitation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

function guests(): Builder
{
    return Guest::query();
}

function invitations(): Builder
{
    return Invitation::query();
}

function success(string $message): void
{
    session()->flash('success', $message);
}

function error(string $message): void
{
    session()->flash('error', $message);
}

function strToSnakeCase(string $string): string
{
    return Str::snake($string);
}

function snakeToWords(string $string): string
{
    $str = str_replace('_', ' ', $string);
    return ucwords($str);
}

function khebabToWords(string $string): string
{
    $names = explode('-', trim($string));
    foreach ($names as $k => $name) {
        $names[$k] = ucwords(strtolower($name));
    }
    return trim(implode('-', $names));
}
