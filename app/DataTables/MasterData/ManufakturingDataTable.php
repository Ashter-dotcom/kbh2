<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\ModelProduct;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ManufakturingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('masterDataApm.nama_perusahaan_apm', function($query) {
                return ($query->masterDataApm ? $query->masterDataApm->nama_perusahaan_apm : '-');
            })
            ->editColumn('masterDataMerek.merek', function($query) {
                return ($query->masterDataMerek ? $query->masterDataMerek->merek : '-');
            })
            ->addColumn('action', function($q) {
                return '
                    <a href="'.route('master-data-model-edit',['id' => $q->id]).'" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger btn-sm delete-item" href="javascript:void(0)" data-action="'.route('master-data-model-delete',['id' => $q->id]).'" data-method="POST" title="Apakah Anda yakin untuk menghapus data?"><i class="fas fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\ModelProduct $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModelProduct $model)
    {
        return $model->with(['masterDataApm' => function ($query) {
            return $query->orderBy('nama_perusahaan_apm', 'ASC');
        }])->with(['masterDataMerek' => function ($query) {
            return $query->orderBy('merek', 'ASC');
        }]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('manufakturing-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // Column::make('id'),
            Column::make('masterDataApm.nama_perusahaan_apm')->title('Nama Perusahaan APM')->orderable(false),
            // Column::make('masterDataMerek.merek')->title('Merek Produk')->orderable(false),
            Column::make('nama_model'),
            Column::make('nama_tipe'),
            // Column::make('jenis_kbm'),
            // Column::make('nama_varian'),
            // Column::make('nama_kapasitas_silinder'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
                  ->width(120)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Model_' . date('YmdHis');
    }
}
