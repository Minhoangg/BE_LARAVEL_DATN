<?php

namespace App\Http\Controllers\admin\variantAttribute;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VariantAttribute;
use Illuminate\Database\QueryException;


class VariantAttributeController extends Controller
{

    public function index($id_variant)
    {
        try {
            $variantAttributes = VariantAttribute::where('id_variant', $id_variant)->get('name');
            return $variantAttributes;
        } catch (QueryException $exception) {
        }
    }
}
