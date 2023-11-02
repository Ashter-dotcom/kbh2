<?php

namespace App\Repository\MasterData\Eloquent;

use App\Models\MasterData\Komponen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MasterData\KategoriKomponen;
use App\Repository\MasterData\Interfaces\KomponenInterface;

class KomponenEloquent implements KomponenInterface
{
    public function all()
    {
        return Komponen::with('masterDataKategoriKomponen')->get()->sortBy(['masterDataKategoriKomponen.nama_kategori_komponen','nama_komponen']);
    }

    public function store(array $attributes)
    {
        try {
            return Komponen::create($attributes);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function update(array $attributes)
    {
        try {
            $komponen = $this->findById(request()->id);
            $attributes = request()->except(['_token']);

            return Komponen::where('id', $komponen->id)->update($attributes);
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
        return Komponen::findOrFail($id);
    }

    public function findByMasterKategoriKomponen($id)
    {
        return KategoriKomponen::findOrFail($id);
    }

    public function findByMultipleId(array $id)
    {
        return Komponen::select('id','kategori_id','nama_komponen','unit')->whereIn('id', $id)->get();
    }

    public function cari($q)
    {
        return response()->json(
            KategoriKomponen::select("id", "nama_kategori_komponen AS name")
                ->where('nama_kategori_komponen', 'LIKE', "%$q%")
                ->get()
        );
    }

    public function kategori()
    {
        return KategoriKomponen::select('*')->get()->sortBy(['nama_kategori_komponen']);
    }
}
