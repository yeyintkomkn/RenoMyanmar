<?php

namespace App\Http\Controllers;

use App\Ads;
use App\AdsWebpage;
use App\Webpage;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    function create_or_edit_ads(Request $request){
//        return $request->all();
        $id=$request->get("ads_id");
        $webpage=$request->get("webpage");

        $link=$request->get('link');
        $start_date=$request->get('start_date');
        $end_date=$request->get('end_date');

        if($id==0){//if insert
            if ($request->hasFile('photo')){
                $file=$request->file('photo');
                $image_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/upload/ads/',$image_name);
            }
            $ads_id=Ads::create([
                'photo'=>$image_name,
                'link'=>$link,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ])->id;
            foreach ($webpage as $data){
                AdsWebpage::create([
                    'webpage_id'=>$data,
                    'ads_id'=>$ads_id
                ]);
            }
        }
//        else{
//            if ($request->hasFile('photo')) {
//                $file = $request->file('photo');
//                $image_name = uniqid() . '_' . $file->getClientOriginalName();
//                $file->move(public_path() . '/upload/ads/', $image_name);
//                $blog=Ads::findOrFail($id);
//                $image_path=public_path().'/upload/ads/'.$blog->photo;
//                if(file_exists($image_path)){
//                    unlink($image_path);
//                }
//
//                Ads::findOrFail($id)->update([
//                    'photo'=>$image_name
//                ]);
//            }
//        }

    }


    function all_ads(){
        $ads=Ads::all();
        $ads=$this->show_ads($ads);
        return json_encode($ads);
    }

    function ads_by_page($page_id){
        $ads_webpage=AdsWebpage::where('webpage_id',$page_id)->get();
        $ads_arr=[];
        foreach ($ads_webpage as $data){
            $ads=Ads::findOrFail($data->ads_id);
            array_push($ads_arr,$ads);
        }
        $ads_arr=$this->show_ads($ads_arr);
        $active_ads=self::filter_active_ads($ads_arr);
        return $active_ads;
    }
    public static function filter_active_ads($arr){
        $active_ads=[];
        foreach ($arr as $ads){
            if($ads['status']=="success" || $ads['status']=="warning"){
                array_push($active_ads,$ads);
            }
        }
        return $active_ads;
    }

    function show_ads($ads){
        foreach ($ads as $data){
            $data['photo_url']=RenoMyanmar::$domain_url.'upload/ads/'.$data->photo;

            $arr=[];
            foreach ($data->webpage as $webpage){
                $page=Webpage::findOrFail($webpage->webpage_id);
                array_push($arr,$page->name);
            }
            $data['webpage_name']=$arr;
//           compare date
            $today = date('Y-m-d');
            if($today>=$data['start_date'] && $today<=$data['end_date']){
                if(date('Y-m-d',strtotime("+10 day"))>=$data['end_date']){
                    $status="warning";
                }
                else{
                    $status='success';
                }
            }
            else if($data['start_date']>$today){
                $status='primary';
            }
            else{
                $status='danger';
            }

            $data['status']=$status;
        }
        return $ads;
    }
    function test($id){
//        $data=Ads::find($id);
//        $data['photo_url']=RenoMyanmar::$domain_url.'upload/ads/'.$data->photo;
//        $status='success';
//
//        $today = date('Y-m-d');
//        if($today>=$data['start_date'] && $today<=$data['end_date']){
//            if(Date('y:m:d', strtotime("+10 days"))>=$data['end_date']){
//                $status="warning";
//            }
//            else{
//                $status='success';
//            }
//        }
//        else{
//            $status='danger';
//        }
//
//        $data['status']=$status;
        $data=date('Y-m-d',strtotime("+1 day"));
        return $data;

    }



    function delete($id){
        $ads=Ads::findOrFail($id);
        $image_path=public_path().'/upload/ads/'.$ads->photo;
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $ads->delete();
        AdsWebpage::where('ads_id',$id)->delete();
    }

}
