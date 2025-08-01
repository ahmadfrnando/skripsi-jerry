<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaun extends Model
{
    protected $table = 'gaun';

    protected $guarded= ['id'];

     protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at",
        "get_star",
        "get_images"
    ];

    public function getGetStarAttribute(){
        if(isset($this->attributes['star'])){
            $star = "";

            if($this->attributes['star'] == 0){
                for($i=0;$i<5;$i++){
                    $star .= "<i class='fe fe-star'
                        style='color:gray'></i>";
                }     
                     
                return $star;
            }
    
            for($i=0;$i<$this->attributes['star'];$i++){
                $star .= "<i class='fe fe-star' style='color:green'></i>";
            }        

            return $star;
        }

        return Null;
    }

    public function getGetImagesAttribute(){                    
        if(isset($this->attributes['foto_gaun'])){    
            return $this->attributes['foto_gaun'];
        }

        return Null;
    }
}
