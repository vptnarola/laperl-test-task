<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
   
class Country extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'country_id'    => $this->country_id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'id_slug    '   => $this->id_slug    ,
            'created_at'    => $this->created_at->format('d/m/Y'),
            'updated_at'    => $this->updated_at->format('d/m/Y')
        ];
    }
}