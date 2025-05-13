<?php namespace AppUtil\Util\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
		return [
			'id'         => $this->id,
			'path'       => $this->path,
			'sort_order' => $this->sort_order
		];
    }
}
