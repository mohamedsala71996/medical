<?php


namespace App\Http\repositories;



use App\Http\interfaces\DashboardInterface;


use App\Models\Visit;
use Carbon\Carbon;


class DashboardRepository implements DashboardInterface
{


    /**
     * @return mixed
     *
     * the information that appear in dashboard page
     */
    public function Information()
    {
        $data=array();

        //visits

        //get the total count of visits
        $visits_count = Visit::sum('count');

        //Today's app visits (android)
        $today_android = Visit::where('date', date('Y-m-d'))
            ->where('type', 0)
            ->first();
        if ($today_android) {
            $data['today_android'] = $today_android->count;
        } else {
            $data['today_android'] = 0;
        }


        //Today's app visits (ios)
        $today_ios = Visit::where('date', date('Y-m-d'))
        ->where('type', 1)
            ->first();
        if ($today_ios) {
            $data['today_ios'] = $today_ios->count;
        } else {
            $data['today_ios'] = 0;
        }





        //All IOS visits so far
        $total_ios = Visit::where('type', 1)
            ->whereMonth('created_at', date('n'))
            ->get('count');


        if ($total_ios->count()>0){
            $data['total_ios_count']=0;
            foreach ($total_ios as $item){
                $data['total_ios_count']+=$item->count;
            }
        }else{
            $data['total_ios_count'] =0;
        }

        $total_android = Visit::where('type', 0)
            ->whereMonth('created_at', date('n'))
            ->get('count');

        if ($total_android->count()>0){

            $data['total_android_count']=0;
            foreach ($total_android as $item){
                $data['total_android_count']+=$item->count;
            }

        }else{
            $data['total_android_count'] = 0;
        }

        return $data;
    }

}//end class