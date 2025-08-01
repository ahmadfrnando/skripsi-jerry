<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestTrait;

class OrderRequest extends FormRequest
{
    use RequestTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_pemesan' => 'required|string',
            'tanggal_sewa_mulai' => 'required|date_format:Y-m-d',
            'tanggal_sewa_selesai' => 'required|date_format:Y-m-d',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'catatan' => 'nullable|string'
        ];
    }
    // public function rules()
    // {
    //     return [   
    //         'product' => 'required|integer',
    //         'date_start' => 'required',
    //         'hour_start' => 'required|integer',
    //         'hours' => 'required|integer'         
    //     ];
    // }
}
