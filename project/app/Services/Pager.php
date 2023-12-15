<?php

namespace App\Services;

class Pager
{

    public function getPages(int $page, int $max): array
    {

        $start = $page - 2;
        $start = ($start <= 0)? 1:$start;
        $end = $page+2;
        $end = ($end >= $max)? $max:$end;

        $pages = [];

        for($i=$start;$i <= $end;$i ++){
            $pages[] = $i;
        }

        return $pages;
    }

}
