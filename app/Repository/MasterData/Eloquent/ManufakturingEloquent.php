<?php

namespace App\Repository\MasterData\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Repository\MasterData\Interfaces\ManufakturingInterface;
use App\Models\MasterData\Manufakturing;

class ManufakturingEloquent implements ManufakturingInterface
{
    public function all()
    {
        return Manufakturing::select('*')->get();
    }

    // public function store(array $attributes)
    // {
    //     try {
    //         return Manufakturing::create($attributes);
    //     } catch (Throwable $e) {
    //         report($e);
    //         return false;
    //     }
    // }

    // public function update(array $attributes)
    // {
    //     try {
    //         $manufakturing = $this->findById(request()->id);
    //         $attributes = request()->except(['_token']);

    //         return Manufakturing::where('id', $manufakturing->id)->update($attributes);
    //     } catch (Throwable $e) {
    //         report($e);
    //         return false;
    //     }
    // }

    // public function delete($id)
    // {
    //     try {
    //         return $this->findById($id)->delete();
    //     } catch (Throwable $e) {
    //         report($e);
    //         return false;
    //     }
    // }

    // public function findById($id)
    // {

    //     return Merek::findOrFail($id);
    // }

    // public function cari($q=false,$apmId)
    // {
    //     return response()->json(
    //         Merek::select("id", "merek AS name")
    //             ->where('merek', 'LIKE', "%$q%")
    //             ->where('apm_id', $apmId)
    //             ->get()
    //     );
    // }
}
