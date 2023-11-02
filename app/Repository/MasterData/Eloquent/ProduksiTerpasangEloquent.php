<?php

namespace App\Repository\MasterData\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Repository\MasterData\Interfaces\MerekInterface;
use App\Models\MasterData\Merek;

class ProduksiTerpasangEloquent implements ProduksiTerpasangInterface
{
    public function all()
    {
        return ProduksiTerpasang::select('*')->orderBy('merek')->get();
    }

    public function store(array $attributes)
    {
        try {
            return ProduksiTerpasang::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $produksiterpasang = $this->findById(request()->id);
            $attributes = request()->except(['_token']);

            return Merek::where('id', $produksiterpasang->id)->update($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->findById($id)->delete();
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function findById($id)
    {

        return Merek::findOrFail($id);
    }

    public function cari($q=false,$apmId)
    {
        return response()->json(
            Merek::select("id", "merek AS name")
                ->where('merek', 'LIKE', "%$q%")
                ->where('apm_id', $apmId)
                ->get()
        );
    }
}
