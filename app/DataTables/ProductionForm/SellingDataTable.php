<?php

namespace App\DataTables\ProductionForm;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\ProductionForm\Selling;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SellingDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('harga', function($q) {
                return !empty($q->harga) ? number_format($q->harga, 0,'.','.') : '-';
            })
            ->addColumn('tanggal_produksi', function($q) {
                return !empty($q->tanggal_produksi) ? date('d-m-Y', strtotime($q->tanggal_produksi)) : '-';
            })
            ->addColumn('tanggal_penjualan', function($q) {
                return !empty($q->tanggal_penjualan) ? date('d-m-Y', strtotime($q->tanggal_penjualan)) : '-';
            })
            ->addColumn('action', function($q) {
                $html = '
                        <a class="btn btn-warning btn-sm" href="'.route('form_produksi.selling.edit-selling',['model_id' => $q->model_id, 'selling_id' => $q->id]).'">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm delete-item" href="javascript:void(0)" data-action="'.route('form_produksi.selling.delete-selling',['model_id' => $q->model_id, 'selling_id' => $q->id]).'" data-method="POST" title="Ingin menghapus data ini ?">
                            <i class="fas fa-trash"></i>
                        </a>';
                return $html;
            })
            ->rawColumns(['action','harga','tanggal_produksi','tanggal_penjualan']);
    }

    public function query(Selling $model)
    {
        return $model->where('model_id', request()->model_id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('selling-table')
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
                    )
                    ->parameters([
                        'searching' => true,
                        'info' => false
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
            Column::make('nik'),
            Column::make('tanggal_produksi'),
            Column::make('tanggal_penjualan'),
            Column::make('penjualan'),
            Column::make('harga'),
            Column::make('konsumen'),
            Column::computed('action')->exportable(false)->printable(false)->width('20%')->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ProductionForm/Selling_' . date('YmdHis');
    }
}
