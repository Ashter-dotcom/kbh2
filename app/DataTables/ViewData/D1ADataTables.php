<?php

namespace App\DataTables\ViewData;

use App\Models\ProductionForm\Supplier;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class D1ADataTables extends DataTable
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
            ->addColumn('perusahaan', function(Supplier $supplier){
                return ($supplier->in_house) ? '' : $supplier->masterDataSupplier->nama_perusahaan_supplier;
            })
            ->addColumn('alamat', function(Supplier $supplier){
                return ($supplier->in_house) ? '' : $supplier->masterDataSupplier->alamat_pabrik;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Supplier $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Supplier $model)
    {
        return $model->with(['masterDataSupplier','masterDataSubSupplier','masterDataModel']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('supplier-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    // ->orderBy(1)
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
            Column::make('perusahaan')->orderable(false),
            Column::make('alamat')->orderable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Data_D1A_' . date('YmdHis');
    }
}
