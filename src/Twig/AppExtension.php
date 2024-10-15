<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('nl_split', [$this, 'nlSplit']),
        ];
    }

    public function nlSplit($text): array
    {
        $text = preg_replace('/(\r\n|\n|\r){2,}/', '\n', $text);


        return explode('\n', $text);
    }
}