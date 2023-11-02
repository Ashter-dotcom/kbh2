<?php

namespace App\DataTables\ViewData\D2;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\ProductionForm\Selling;
use App\Models\MasterData\ModelProduct;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\MasterData\Interfaces\PeriodeInterface;

class D2DataTables extends DataTable
{
    public function __construct()
    {
        $this->apm = request()->apm ;
    }
    
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('masterDataModel.masterDataApm.nama_perusahaan_apm', function($query){
                return ($query->masterDataModel->masterDataApm ? $query->masterDataModel->masterDataApm->nama_perusahaan_apm: '-');
            })
            ->editColumn('masterDataModel.jenis_kbm', function($query){
                return ($query->masterDataModel ? $query->masterDataModel->jenis_kbm : '-');
            })
            ->editColumn('masterDataModel.nama_model', function($query){
                return ($query->masterDataModel ? $query->masterDataModel->nama_model: '-');
            })
            ->editColumn('masterDataModel.nama_tipe', function($query){
                return ($query->masterDataModel ? $query->masterDataModel->nama_tipe: '-');
            })
            ->editColumn('masterDataModel.nama_varian', function($query){
                return ($query->masterDataModel ? $query->masterDataModel->nama_varian: '-');
            })
            ->editColumn('masterDataModel.nama_kapasitas_silinder', function($query){
                return ($query->masterDataModel ? $query->masterDataModel->nama_kapasitas_silinder: '-');
            });
    }

    public function query(Selling $model, PeriodeInterface $dataPeriode)
    {
        return $model->with('masterDataModel')
                ->with('masterDataModel')
                ->when(request()->apm, function($query, $apm) {
                    $query->whereHas('masterDataModel.masterDataApm', function(Builder $queryApm) {
                        $queryApm->where('id', request()->apm);
                    });
                })
                ->when(request()->periode, function($query, $periode) use($dataPeriode) {

                    $dataPeriodeByPeriodeId = $dataPeriode->findById($periode);

                    return $query->whereRaw("DATE_FORMAT(tanggal_produksi, \"%Y-%m\") BETWEEN DATE_FORMAT(\"$dataPeriodeByPeriodeId->mulai\", \"%Y-%m\") AND DATE_FORMAT(\"$dataPeriodeByPeriodeId->selesai\", \"%Y-%m\")
                                AND
                                DATE_FORMAT(tanggal_penjualan, \"%Y-%m\") BETWEEN DATE_FORMAT(\"$dataPeriodeByPeriodeId->mulai\", \"%Y-%m\") AND DATE_FORMAT(\"$dataPeriodeByPeriodeId->selesai\", \"%Y-%m\")    
                            ");
                })
                ->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('d2-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'searching' => false
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('masterDataModel.masterDataApm.nama_perusahaan_apm')->title('Nama perusahaan APM')->width('25%'),
            Column::make('masterDataModel.jenis_kbm')->title('Jenis KBM'),
            Column::make('masterDataModel.nama_model')->title('Model'),
            Column::make('masterDataModel.nama_tipe')->title('Tipe')->width('10%'),
            Column::make('masterDataModel.nama_varian')->title('Varian'),
            Column::make('masterDataModel.nama_kapasitas_silinder')->title('Kapasitas Silinder'),
            Column::make('tanggal_produksi')->title('Tanggal Produksi'),
            Column::make('tanggal_penjualan')->title('Tanggal Penjualan'),
        ];
    }
    
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'app/DataTables/ViewData/D2/D2_' . date('YmdHis');
    }
}
