<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return Datatables::of(User::query())->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->select('id', 'name', 'email', 'created_at', 'updated_at');
    }

    public function html()
    {
        $this->builder()
            ->columns($this->getColumns())
            ->parameters($this->getParameters())
            ->ajax('');
    }

    protected function getParameters()
    {
        return [
            'dom'          => 'Bfrtip',
            'buttons'      => ['export', 'print', 'reset', 'reload'],
        ];
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
