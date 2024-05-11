<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;

use App\Models\Resume;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helper\GoogleMaps;

class ProfileController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data['maps'] = $this->createMap();

        $user = Auth::user();

        if ($user){

            $data['user']=User::where('id',$user->id)->first();
            $data['resume']=Resume::where('user_id',$user->id)->first();
            if(!$data['resume']){
                $dataresume= new Resume();
                $dataresume->user_id=$user->id;
                $dataresume->save();
                $data['resume']=$dataresume;

            }

            return view('site.profile.myProfile',$data);

        }else{        return redirect(url('/'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    } public function resumes(Request $request)
{
    $re=Resume::where('user_id',$request->user_id)->first();
    $re->resume=$request->resume;
    $re->save();
    return back();
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[


            'image'=> 'mimes:jpeg,jpg,png,gif|max:1000',
            'banner'=> 'mimes:jpeg,jpg,png,gif|max:1000',
        ]);
        $user=User::where('id',Auth::user()->id)->first();
        if($request->image) {

            if ($user->image != null) {

                $usersImage = public_path("{$user->image}"); // get previous image from folder
                if (File::exists($usersImage)) { // unlink or remove previous image from folder
                    unlink($usersImage);
                }
            }///delete pr avatar

            $image = $request->file('image');
            $imageName = 'uploads/users/' . time() . '.' . request()->image->getClientOriginalExtension();
            $user->image = $imageName;
            $image->move('uploads/users/', $imageName);
        }
        if($request->banner) {
            if ($user->banner != null) {

                $usersImage1 = public_path("{$user->banner}"); // get previous image from folder
                if (File::exists($usersImage1)) { // unlink or remove previous image from folder
                    unlink($usersImage1);
                }
            }///delete pr avatar

            $image1 = $request->file('banner');
            $imageName1 = 'uploads/users/' .'2'. time() . '.' . request()->banner->getClientOriginalExtension();
            $user->banner = $imageName1;
            $image1->move('uploads/users/', $imageName1);
        }

        $user->save();
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user=User::find($id);
        if ($user){
            $Favorite=Like::where('user_id',$user->id)->pluck('ad_id')->toArray();
            $data['auctions']=Ad::where('is_special',2)->where('user_id',$user->id)->get();
            $data['favorites']=Ad::whereIn('id',$Favorite)->get();
            $data['countries']=Country::get();
            $data['ads']=Article::wher('user_id',$user->id)->orderby('id','desc')->take(3)->get();
            $data['user']=User::where('id',$user->id)->first();
            $uflo=Follow::where('follower_id',$id)->pluck('followed_id')->toArray();
            $data['followeds']=User::whereIn('id',$uflo)->get();
            $uflor=Follow::where('followed_id',$id)->pluck('follower_id')->toArray();
            $data['followers']=User::whereIn('id',$uflor)->get();

            return view('site.profile.profile',$data);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['langee']='ar';

        $user = User::find($id);



        $data['user']=User::where('id',$user->id)->first();
        $data['resume']=Resume::where('user_id',$user->id)->first();
        $data['ads']=Article::where('user_id',$user->id)->where('is_block',0)->get();

        if(!$data['resume']){
            $dataresume= new Resume();
            $dataresume->user_id=$user->id;
            $dataresume->save();
            $data['resume']=$dataresume;


        }
        return view('site.profile.edit',$data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'phone' => 'nullable|numeric|digits_between:1,20',
            'email' => 'required|max:190',
        ]);       $user=User::where('id',Auth::user()->id)->first();
        if($request->image) {

            if ($user->image != null) {

                $usersImage = public_path("{$user->image}"); // get previous image from folder
                if (File::exists($usersImage)) { // unlink or remove previous image from folder
                    unlink($usersImage);
                }
            }///delete pr avatar

            if($request->image){
                $image = $request->file('image');
                $imageName = time() . '.' . \request('image')->getClientOriginalExtension();

                $user->image = 'uploads/users/' . $imageName;
                $image->move('uploads/users', $imageName);

            }
        }

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->lName = $request->lName;
        $user->save();
        toastr()->success(trans('main.Message_successs'),trans('main.Messages'));

        return  back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function createMap($zoom = 9, $lat = 30.511411, $long = 30.720825, $draggable = true)
    {
        $settinges=User::where('id',\auth()->user()->id)->first();
        $la=$settinges->latitude;
        $lg=$settinges->longitude;
        $theMap = new GoogleMaps();
        $config = array();
        $config['zoom'] = $zoom;
        $config['center'] = "{$la}, {$lg}";//'auto';
        $config['onboundschanged'] = '  if (!centreGot) {
                                            var mapCentre = map.getCenter();
                                            marker_0.setOptions({
                                                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
                                            });
                                            $("#latitude").val(mapCentre.lat());
                                            $("#longitude").val(mapCentre.lng());
                                        }
                                        centreGot = true;';
        $config['geocodeCaching'] = TRUE;
        $marker = array();
        $marker['draggable'] = $draggable;
        $marker['ondragend'] = '$("#latitude").val(event.latLng.lat());$("#longitude").val(event.latLng.lng());';
        $marker['title'] = 'أنت هنا .. من فضلك قم بسحب العلامة ووضعها على المكان الصحيح';
        $theMap->initialize($config);
        $theMap->add_marker($marker);
        $data['maps'] = $theMap->create_map();
        return $data;
    }

}
