<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TruckController extends Controller
{
    public function insertDeliverLogs(Request $request)
    {
        // dd($request);
        $params =
        [
            $request->TruckID,
            MyHelper::decrypt(Session::get('Employee_ID')),
            MyHelper::decrypt(Session::get('SLocation')),
            $request->longitude,
            $request->latitude,
            $request->OS
        ];


            // dd($params);

            $insert = DB::select('sp_DeliverLog_insert ?,?,?,?,?,?', $params);
            // dd($insert);
            $num = $insert[0]->RETURN;
            $datetime = $insert[0]->datetime;

            if ($num > 0) :
                $msg = 'Truck Log successfully saved!';
            else :
                $msg = Myhelper::errorMessages($num);
            endif;

            $result = array('num' => $num, 'msg' => $msg, 'datetime' => $datetime);
            return $result;
    }

}
