<?php

namespace App\DataTables\ProfilPerusahaan;

use App\Models\MasterData\Supplier;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PerusahaanSupplierDataTable extends DataTable
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
                    <a href="'.route('profil-perusahaan-supplier-sebelum-insentif-edit',['id' => $q->id]).'" class="btn btn-info btn-sm">Sebelum Insentif</i></a>
                    <a href="'.route('profil-perusahaan-supplier-setelah-insentif-edit',['id' => $q->id]).'" class="btn btn-success btn-sm">Setelah Insentif</a>
                    <a href="#" class="btn btn-dark btn-sm">Profil Perusahaan</a>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Supplier $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Supplier $model)
    {
        return $model->newQuery()->orderByDesc('created_at');
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
            Column::make('nama_perusahaan_supplier'),
            Column::make('alamat_pabrik'),
            // Column::make('keterangan'),
            // Column::make('tanggal_kesediaan_diverifikasi'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
                  ->width(245)
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
        return 'Profil-Perusahaan-Supplier_' . date('YmdHis');
    }
}
