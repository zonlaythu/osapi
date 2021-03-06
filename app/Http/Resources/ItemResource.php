<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Brand;
use App\Subcategory;
class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = 'item';
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'item_id' => $this->id,
            'item_code' => $this->codeno,
            'item_name' => $this->name,
            'item_photo' => url($this->photo),

            'item_price' => $this->price,
            'item_discount' => $this->discount,
            'item_desc' => $this->description,
            'brand'=>Brand::find($this->brand_id),
            'subcategory'=>Subcategory::find($this->subcategory_id),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
 
    }
}
