<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApp\App\CreateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\CarColor;
use App\Models\CarModel;
use App\Models\CarType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CreateCarController extends Controller
{
    public function carType()
    {
        $data = CarType::all();

        return response()->json([
            'message' => 'Car types retrieved successfully',
            'data' => new JsonResource($data),
        ], 200);
    }

    public function carModel($id)
    {
        $data = CarModel::where('car_type_id',$id)->get();

        return response()->json([
            'message' => 'Car Model retrieved successfully',
            'data' => new JsonResource($data),
        ], 200);
    }

    public function carColor()
    {
        $data = CarColor::all();

        return response()->json([
            'message' => 'Car Color retrieved successfully',
            'data' => new JsonResource($data),
        ], 200);
    }

    public function createCar(CreateCarRequest $request)
    {
        $car=Car::create(array_merge(
            $request->validated(),
            ['user_id'=>auth()->id() ]
        ));
        return response()->json([
            'success' => true,
            'message' => 'Car created successfully',
            'data' => CarResource::make($car),
        ], 201);


    }
    public function myCar()
    {
        $driver_id=Auth::id();
        $cars=Car::where('user_id',$driver_id)->paginate(3);

        return CarResource::collection($cars)->additional([
            'message' => 'Car retrieved successfully',
            'status' => 'success',
        ]);
    }
    public function activeCar($id)
    {
        $car=Car::find($id);
        $car->status = $car->status === "active" ? "inactive" : "active";
        $car->save();
        return response()->json([
            'success' => true,
            'message' => 'Status changed successfuly',
            'data' => null
        ], 200);
    }

}
