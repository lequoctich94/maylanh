<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagination extends Model
{
    use HasFactory;

    public $currentPage;
    public $recordOnPage;
    public $totalSearchResult;
    public $totalPage;
    public $indexTo;
    public $indexFrom;
    public $resultSearch;

    public function __construct($currentPage = 1, $recordOnPage = 10, $totalSearchResult = 0, $totalPage = 0, $indexTo = 0, $indexFrom=0, $resultSearch = 0)
    {
        $this->currentPage = $currentPage;
        $this->recordOnPage = $recordOnPage;
        $this->totalSearchResult = $totalSearchResult;
        $this->totalPage = $totalPage;
        $this->indexTo = $indexTo;
        $this->indexFrom = $indexFrom;
        $this->resultSearch = $resultSearch;
    }
}
