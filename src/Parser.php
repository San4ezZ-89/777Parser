<?php

namespace San4ezZ\Parser777;

use San4ezZ\Parser777\Category\Category;
use San4ezZ\Parser777\Match\Match;
use San4ezZ\Parser777\Matches\Matches;
use San4ezZ\Parser777\Request\Request;

class Parser
{
    /**
     * Получаем доступные категории за определенную дату в формате дд-мм-гггг
     * @param $date
     * @return array
     */
    public function getCategory($date): array
    {
        $request = new Request();
        $category = new Category($request, '', $date);

        return $category->getList();
    }

    /**
     * Получаем все матчи в выбраных категория за определенную дату. Категории в виде массива
     * @param string $date
     * @param array $categories
     * @return array|int
     */
    public function getAllMatches(array $categories, string $date): array
    {
        $request = new Request();
        $matches = new Matches($request, $categories, $date, '');

        return $matches->getMatches();
    }


    /**
     * Получение данных за определенный матч
     * @param string $link
     * @return array
     */
    public function getMatch(string $link): array
    {
        $request = new Request();
        $match = new Match($request, $link);

        return $match->getFullMatchInfo();
    }
}
