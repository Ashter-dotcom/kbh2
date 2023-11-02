<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->editColumn('status', function($q) {
                return $q->status == 1 ? 'Aktif' : 'Tidak Aktif';
            })
            ->addColumn('action', function($q) {

                $html = '
                        <a href="'.route('user.edituser',['user_id' => encrypt_decrypt($q->id)]).'" class="btn btn-primary btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="'.route('user.viewuser',['user_id' => encrypt_decrypt($q->id)]).'" class="btn btn-warning btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-danger btn-sm delete-item" href="javascript:void(0)" data-action="'.route('user.deleteuser',['user_id' => encrypt_decrypt($q->id)]).'" data-method="POST" title="Are you sure want to delete this data ?">
                            <i class="fas fa-trash"></i>
                        </a>';
                return $html;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(User $model)
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
                    ->setTableId('users-table')
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
            Column::make('name')->title('name'),
            Column::make('email')->title('email'),
            Column::make('status')->title('status'),
            Column::computed('action')->exportable(false)->printable(false)->width(150)->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
