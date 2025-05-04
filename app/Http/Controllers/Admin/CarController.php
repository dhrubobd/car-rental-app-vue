<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    function createCar(Request $request){
        return inertia('Backend/Cars/AddCar');  
    }
    function saveCar(Request $request){
        
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'car_type' => 'required',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        try {
            // Prepare Car Image File Name & Path
            $img=$request->file('image');

            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="car-{$t}-{$file_name}";
            $img_url="uploads/{$img_name}";


            // Upload Car Image File
            $img->move(public_path('uploads'),$img_name);

            if($request->input('availability')=="1"){
                $carAvailability = true;
            }else{
                $carAvailability = false;
            }
            Car::create([
                'name'=>$request->input('name'),
                'brand'=>$request->input('brand'),
                'model'=>$request->input('model'),
                'year'=>$request->input('year'),
                'car_type'=>$request->input('car_type'),
                'daily_rent_price'=>$request->input('daily_rent_price'),
                'availability'=>$carAvailability,
                'image'=>$img_url,
            ]);
            return redirect()->route('dashboard.cars')->with('success', 'Car Created Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Car Creation Failed');
        }

        /*
        if($this->isAdmin($request)==true){
            // Prepare Car Image File Name & Path
            $img=$request->file('carImg');

            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="car-{$t}-{$file_name}";
            $img_url="uploads/{$img_name}";


            // Upload Car Image File
            $img->move(public_path('uploads'),$img_name);

            if($request->input('carAvailability')=="1"){
                $carAvailability = true;
            }else{
                $carAvailability = false;
            }
            
            // Save To Database
            return Car::create([
                'name'=>$request->input('carName'),
                'brand'=>$request->input('carBrand'),
                'model'=>$request->input('carModel'),
                'year'=>$request->input('carYear'),
                'car_type'=>$request->input('carType'),
                'daily_rent_price'=>$request->input('carRentPrice'),
                'availability'=>$carAvailability,
                'image'=>$img_url,
            ]);
        }else{
            return view('page.auth.login-page');
        }
        */
    }

    function deleteCar(String $id){
        try {
            
            $theCar = Car::findOrFail($id);
            $theImagePath = $theCar->image;
            if ($theImagePath == null) {
                return $theCar->delete();
            }
            //$theImagePath = public_path($theImagePath);
            File::delete($theImagePath);
            $theCar->delete();
            return redirect()->back()->with('success', 'Car Deleted Successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }

            
    }

    function carByID(Request $request){
        if($this->isAdmin($request)==true){
            $carID=$request->input('id');
            return Car::where('id',$carID)->first();
        }else{
            return view('page.auth.login-page');
        }
    }
    function updateCar(Request $request){
        if($this->isAdmin($request)==true){
            $carID=$request->input('id');

            if($request->input('carAvailability')=="1"){
                $carAvailability = true;
            }else{
                $carAvailability = false;
            }

            if ($request->hasFile('carImage')) {

                // Upload New Car Photo File
                $img=$request->file('carImage');
                $t=time();
                $file_name=$img->getClientOriginalName();
                $img_name="car-{$t}-{$file_name}";
                $img_url="uploads/{$img_name}";

                // Upload Car Photo File
                $img->move(public_path('uploads'),$img_name);

                // Delete Old Car Photo File
                $filePath=$request->input('imagePath');
                File::delete($filePath);

                // Update Car
                return Car::where('id',$carID)->update([
                    'name'=>$request->input('carName'),
                    'brand'=>$request->input('carBrand'),
                    'model'=>$request->input('carModel'),
                    'year'=>$request->input('carYear'),
                    'car_type'=>$request->input('carType'),
                    'daily_rent_price'=>$request->input('carRentPrice'),
                    'availability'=>$carAvailability,
                    'image'=>$img_url,
                ]);

            }
            else {
                return Car::where('id',$carID)->update([
                    'name'=>$request->input('carName'),
                    'brand'=>$request->input('carBrand'),
                    'model'=>$request->input('carModel'),
                    'year'=>$request->input('carYear'),
                    'car_type'=>$request->input('carType'),
                    'daily_rent_price'=>$request->input('carRentPrice'),
                    'availability'=>$carAvailability,
                ]);
            }
        }else{
            return view('page.auth.login-page');
        }
    }

    function isAdmin(Request $request){
        $userID = $request->header('id');
        $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
        if($theUser->role=="admin"){
            return true;
        }else{
            return false;
        }
    }
}
