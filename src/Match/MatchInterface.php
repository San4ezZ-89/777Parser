<?php

namespace San4ezZ\Parser777\Match;

use San4ezZ\Parser777\Request\RequestInterface;

interface MatchInterface
{
    public function __construct(RequestInterface $request, string $link);

    public function getFullMatchInfo(): array;
}
