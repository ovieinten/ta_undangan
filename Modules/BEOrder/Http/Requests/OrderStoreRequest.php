<?php
/**
 * Created by PhpStorm.
 * User: Cacing
 * Date: 25/06/2018
 * Time: 8:13
 */

namespace Modules\BEOrder\Http\Requests;

use App\Models\Product;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $rule = [
            'order.product' => 'exists:products,id' ,
            'order.user_id' => Auth::id(),
            'order.number'  => 'required ' ,
            'order.address' => 'required' ,
            'order.qty' => 'required' ,
            'order.date' => 'required' ,
            'order.address' => 'required' ,
            'order.province_id' => 'required' ,
            'order.regency_id' => 'required' ,
            'order.district_id' => 'required' ,
            'order.village_id' => 'required' ,
        ];

        return $rule;
    }
}