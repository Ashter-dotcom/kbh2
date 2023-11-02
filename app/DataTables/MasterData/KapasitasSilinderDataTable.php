<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\KapasitasSilinder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KapasitasSilinderDataTable extends DataTable
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
            ->addColumn('action', function($q) {
                return '
                    <a href="'.route('master-data-kapasitas-silinder-edit',['id' => $q->id]).'" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger btn-sm delete-item" href="javascript:void(0)" data-action="'.route('master-data-kapasitas-silinder-delete',['id' => $q->id]).'" data-method="POST" title="Apakah Anda yakin untuk menghapus data?"><i class="fas fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\KapasitasSilinder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(KapasitasSilinder $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('kapasitassilinder-table')
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
            Column::make('nama_kelompok'),
            Column::make('minimal')->title('Minimal (CC)'),
            Column::make('maksimal')->title('Maksimal (CC)'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
                  ->width(100)
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
        return 'KapasitasSilinder_' . date('YmdHis');
    }
}
