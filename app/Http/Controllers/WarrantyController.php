<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Provinces;
use App\Models\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function listWarranty(Request $request)
    {
        $warranties = Warranty::paginate(10);

        if($request->has('s')){
            $warranties = Warranty::where('name', 'LIKE', '%'.$request->get('s').'%')->paginate(10);
        }

        return view('admin.warranty.list', compact('warranties'));
    }

    public function detailWarranty(Request $request, $id = null)
    {
        $warranty = Warranty::findOrFail($id);
        $city = Provinces::all();
        $district = Districts::where('province_id', $warranty->city)->get();

        return view('admin.warranty.detail', compact('warranty', 'city', 'district'));
    }

    public function addWarranty(Request $request)
    {
        if($request->method() === 'POST'){
            $name = $request->get('name');
            $phone = $request->get('phone');
            $city = $request->get('city');
            $district = $request->get('district');
            $address = (string)$request->get('address');
            $avatar = $request->get('img_avatar_path');

            $address = json_encode($address);

            $add = Warranty::create([
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'district' => $district,
                'city' => $city,
                'avatar' => $avatar
            ]);

            if ($add) {
                return redirect()->route('admin.warranty.detail', ['id' => $add->id]);
            } else {
                return view('admin.warranty.add')->with('error', 'Thêm mới thất bại');
            }
        }else{
            $city = Provinces::all();

            $district = Districts::all();
            return view('admin.warranty.add', compact('city', 'district'));
        }
    }

    public function updateWarranty(Request $request, $id = null)
    {
        $warranty = Warranty::findOrFail($id);

        $name = $request->get('name');
        $phone = $request->get('phone');
        $city = $request->get('city');
        $district = $request->get('district');
        $address = (string)$request->get('address');
        $avatar = $request->get('img_avatar_path');

        $address = json_encode($address);

        $update = Warranty::where('id', $id)->update([
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'district' => $district,
            'city' => $city,
            'avatar' => $avatar
        ]);
        if ($update) {
            return redirect()->route('admin.warranty.detail', ['id' => $id])->with('success', 'Cập nhật thành công');
        } else {
            return view('admin.warranty.add')->with('error', 'Thêm mới thất bại');
        }

    }

    public function delWarranty(Request $request, $id = null)
    {
        $warranty = Warranty::findOrFail($id);
        $warranty->delete();

        return redirect()->route('admin.warranty.list');
    }
}
