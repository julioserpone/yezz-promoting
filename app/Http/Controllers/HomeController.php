<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Store;
use App\Branch;
use App\LogActivityBranch;
use App\LogActivityBranchItem;
use DmitriyMarley\LaraGlobe\Models\Country;
use DmitriyMarley\LaraGlobe\Models\State;
use DmitriyMarley\LaraGlobe\Models\City;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function manage(Request $request, $module)
    {
        return view('dashboard');
    }

    public function construction(Request $request)
    {
        return view('construction');
    }

    public function download() {

        $url = storage_path().'/apk/app-trademarketing.apk';
        $filename = pathinfo($url, PATHINFO_FILENAME).'.'.pathinfo($url, PATHINFO_EXTENSION);
        header("Content-disposition:attachment; filename=$filename");
        return readfile($url);
    }
}
