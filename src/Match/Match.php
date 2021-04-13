<?php

namespace San4ezZ\Parser777\Match;

use San4ezZ\Parser777\Request\RequestInterface;

require_once __DIR__ . '/../phpQuery/phpQuery.php';


class Match implements MatchInterface
{
    private RequestInterface $request;
    private \phpQueryObject $matchPage;
    private string $url;
    private array $matchInfo;
    private array $odds;

    public function __construct(RequestInterface $request, string $link)
    {
        $this->url = $link;
        $this->request = $request;
        $this->matchPage = \phpQuery::newDocument($this->request->get($this->url));
        $this->odds = array();
    }

    public function getFullMatchInfo(): array
    {
        $this->matchInfo['date'] = self::getDate();
        $this->matchInfo['time'] = self::getTime();
        $this->matchInfo['home command'] = self::getHomeCommand();
        $this->matchInfo['guest command'] = self::getGuestCommand();
        $this->matchInfo['home command image'] = self::getHomeCommandImage();
        $this->matchInfo['guest command image'] = self::getGuestCommandImage();
        $this->matchInfo['score home command'] = self::getScoreHomeCommand();
        $this->matchInfo['score guest command'] = self::getScoreGuestCommand();
        $this->matchInfo['status'] = self::getStatus();
        $this->matchInfo['odds'] = self::getOdds();
        return $this->matchInfo;
    }

    private function getDate(): string
    {
        return trim(pq($this->matchPage)->find('.time')->find('span')->eq(0)->text());
    }

    private function getTime(): string
    {
        return trim(pq($this->matchPage)->find('.time')->find('span')->eq(1)->text());
    }

    private function getHomeCommand(): string
    {
        return trim(pq($this->matchPage)->find('.team_link')->eq(0)->text());
    }

    private function getGuestCommand(): string
    {
        return trim(pq($this->matchPage)->find('.team_link')->eq(1)->text());
    }

    private function getScoreHomeCommand(): string
    {
        return trim(pq($this->matchPage)->find('.scoreHost')->text());
    }

    private function getScoreGuestCommand(): string
    {
        return trim(pq($this->matchPage)->find('.scoreGuest')->text());
    }

    private function getStatus(): string
    {
        return trim(pq($this->matchPage)->find('.matchStatus')->text());
    }

    private function getHomeCommandImage(): string
    {
        $div_find = pq(trim(pq($this->matchPage)->find('.team_link')->eq(0)));
        $img = $div_find->find('img')->attr('src');
        return $img;
    }

    private function getGuestCommandImage(): string
    {
        $div_find = pq(trim(pq($this->matchPage)->find('.team_link')->eq(1)));
        $img = $div_find->find('img')->attr('src');
        return $img;
    }

    private function getOdds(): array
    {
        $this->odds['home'] = trim(pq($this->matchPage)->find('.odd-source-onexbet')->find('.odd-1')->text());
        $this->odds['x'] = trim(pq($this->matchPage)->find('.odd-source-onexbet')->find('.odd-2')->text());
        $this->odds['guest'] = trim(pq($this->matchPage)->find('.odd-source-onexbet')->find('.odd-3')->text());

        return $this->odds;
    }

}
