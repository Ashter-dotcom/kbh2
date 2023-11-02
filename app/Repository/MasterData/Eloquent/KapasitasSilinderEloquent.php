<?php

namespace App\Repository\MasterData\Eloquent;

use Illuminate\Support\Facades\Hash;
use App\Repository\MasterData\Interfaces\KapasitasSilinderInterface;
use App\Models\MasterData\KapasitasSilinder;

class KapasitasSilinderEloquent implements KapasitasSilinderInterface
{
    public function all()
    {
        return KapasitasSilinder::select('*')->orderBy('nama_kelompok')->get();
    }

    public function store(array $attributes)
    {
        try {
            return KapasitasSilinder::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $ks = $this->findById(request()->id);
            $attributes = request()->except(['_token']);

            return KapasitasSilinder::where('id', $ks->id)->update($attributes);
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
        return KapasitasSilinder::findOrFail($id);
    }

    public function cari($q)
    {
        return response()->json(
            KapasitasSilinder::select("id", "nama_kelompok AS name")
                ->where('nama_kelompok', 'LIKE', "%$q%")
                ->get()
        );
    }

}
