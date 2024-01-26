<?php


namespace App\MyHellepr;

use Illuminate\Pagination\Paginator;


class PaginateHellper
{
    public function paginatePage()
    {
        // I don't know why but paginate it doesn't work on this server
        // PaginateHellper::paginatePage();

        $currentPage = explode('=', $_SERVER['REQUEST_URI'])[1];

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

       
        return $currentPage;
    }

}
