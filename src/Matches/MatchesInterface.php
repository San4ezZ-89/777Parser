<?php

namespace San4ezZ\Parser777\Matches;

use San4ezZ\Parser777\Request\RequestInterface;

interface MatchesInterface
{
    public function __construct(RequestInterface $request, array $categories, string $date, string $prefix);

    public function getMatches(): array;
}
