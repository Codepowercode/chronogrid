<?php
namespace App\Http\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
class CompanyAccess
{
    public function __construct()
    {
    }
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $companiesCountGlobal = User::where('login_blocked', 1)->where('company', 1)->where('blocked', 0)->count();
        $view->with('companiesCountGlobal', $companiesCountGlobal);
    }
}
