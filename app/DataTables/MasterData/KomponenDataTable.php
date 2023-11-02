<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Komponen;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KomponenDataTable extends DataTable
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
            ->editColumn('masterDataKategoriKomponen.nama_kategori_komponen', function ($query) {
                return ($query->masterDataKategoriKomponen ? $query->masterDataKategoriKomponen->nama_kategori_komponen : '-');
            })
            ->addColumn('action', function ($q) {
                return '
                    <a href="'.route('master-data-komponen-edit', ['id' => $q->id]).'" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger btn-sm delete-item" href="javascript:void(0)" data-action="'.route('master-data-komponen-delete', ['id' => $q->id]).'" data-method="POST" title="Apakah Anda yakin untuk menghapus data?"><i class="fas fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Komponen $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Komponen $model)
    {
        return $model->with(['masterDataKategoriKomponen' => function ($query) {
            return $query->orderBy('nama_kategori_komponen', 'ASC');
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
                    ->setTableId('komponen-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('masterDataKategoriKomponen.nama_kategori_komponen')->title('Nama Kategori')->orderable(false),
            Column::make('nama_komponen'),
            Column::make('unit'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
                  ->width(100)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Komponen_' . date('YmdHis');
    }
}
