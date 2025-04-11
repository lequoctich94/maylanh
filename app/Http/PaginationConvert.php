<?php

namespace App\Http;

use App\Http\Resources\PaginationResource;
use App\Models\Pagination;

class PaginationConvert
{
    public static function convert($data, Pagination $pagination)
    {
        $recordOnPage = $pagination->recordOnPage;
        $totalSearchResult = $pagination->totalSearchResult;
        $totalPage = (int)($totalSearchResult / $recordOnPage);
        $pagination->totalPage = $totalPage;
        $pagination->indexFrom = ($pagination->currentPage - 1) * $recordOnPage + 1;
        $pagination->indexTo =  $pagination->currentPage * $recordOnPage;
        if ($totalPage * $recordOnPage < $totalSearchResult) {
            $pagination->totalPage = $totalPage + 1;
        }

        return [
            'result' => $data,
            'pagination' => new PaginationResource($pagination)
        ];
    }
}