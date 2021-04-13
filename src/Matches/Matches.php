<?php

namespace San4ezZ\Parser777\Matches;

use San4ezZ\Parser777\Match\Match;
use San4ezZ\Parser777\Request\RequestInterface;

require_once __DIR__ . '/../phpQuery/phpQuery.php';

class Matches implements MatchesInterface
{
    private RequestInterface $request;
    private array $categories;
    private array $allMatches;
    private array $tempArray;
    private string $url;
    private string $date;
    private \phpQueryObject $pq;

    /**
     * Matches constructor
     * @param RequestInterface $request
     * @param array $categories
     * @param string $date
     * @param string $prefix
     */
    public function __construct(RequestInterface $request, array $categories, string $date, string $prefix = '/?d=')
    {
        $this->request = $request;
        $this->url = $prefix . $date;
        $this->categories = $categories;
        $this->date = $date;
        $this->allMatches = array();
        $this->tempArray = array();
        $this->pq = \phpQuery::newDocument($this->request->get($this->url));
    }

    public function getMatches(): array
    {
        $allMatchesCategory = $this->pq->find('.caption');
        foreach ($allMatchesCategory as $category) {
            $pqDiv = pq($category);
            if (in_array(trim($pqDiv->text()), $this->categories)) {
                $pqAllMathes = pq($pqDiv->parent()->parent()->parent())->find('.tournaments-match');
                foreach ($pqAllMathes as $pqMatch) {
                    $this->tempArray = array();
                    $this->tempArray['date'] = $this->date;
                    $this->tempArray['category'] = trim($pqDiv->text());
                    $this->tempArray['home command'] = trim(pq($pqMatch)->find('.team')->eq(0)->text());
                    $this->tempArray['guest command'] = trim(pq($pqMatch)->find('.team')->eq(1)->text());
                    $this->tempArray['link'] = substr(pq($pqMatch)->find('a')->attr('href'), 1);
                    $match = new Match($this->request, $this->tempArray['link']);
                    $this->tempArray['full'] = $match->getFullMatchInfo();
                    if (!isset($this->allMatches[pq($pqMatch)->find('a')->attr('href')])) {
                        $this->allMatches[pq($pqMatch)->find('a')->attr('href')] = $this->tempArray;
                    }
                }
            }
        }

        return $this->allMatches;
    }
}
