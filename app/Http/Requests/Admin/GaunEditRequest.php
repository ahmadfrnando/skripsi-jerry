<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class GaunEditRequest extends FormRequest
{
    use RequestTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [           
            'nama_gaun' => 'required',
            "harga" => "required|integer",
            "status" => "required",
            "deskripsi" => "required",
        ];

        if(request()->hasFile("foto_gaun")){
          $rules = array_merge($rules,[
            "foto_gaun" => "required|image|mimes:image/jpeg,image/jpg,image/gif,image/png,jpeg,jpg,gif,png|max:10024|dimensions:max_width=5000,max_height=5000"
          ]);
        }

        return $rules;
    }
}
