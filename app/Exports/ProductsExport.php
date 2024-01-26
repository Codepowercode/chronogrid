<?php


namespace App\Exports;


use App\Models\Product;
use App\MyHellepr\Hellper;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{

    public function collection()
    {

        return Product::query()->where('user_id', Hellper::companyId())
            ->select('brand','description','model_number','model','color','size','metal','condition','more_condition','year',
'bezel_size','bezel_type','bezel_metal','bracelet_type','band','dial_type','note','price','quantity','auction','auction_price','auction_min_bid',
'auction_start','auction_end','status_position','created_at','updated_at')
            ->get();
    }


}
