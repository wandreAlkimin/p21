<?php

namespace App\Http\Controllers\ImportExport;

use App\Exports\Export;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class ExportTorcedoresController extends Controller
{

    public function export(){

        return Excel::download(new Export, 'torcedores.xlsx');
    }
}