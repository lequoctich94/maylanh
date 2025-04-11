<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'current_page' => $this->currentPage,
            'record_on_page' => $this->recordOnPage,
            'total_search_result' => $this->totalSearchResult,
            'total_page' => $this->totalPage,
            'indexFrom' => $this->indexFrom,
            'indexTo' => $this->indexTo
        ];
    }
}
