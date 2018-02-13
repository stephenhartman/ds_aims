<?php

namespace App\DataTables;

use App\User;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Html;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param $query
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('last_login_at', function ($user) {
                if ($user->last_login_at !== null)
                    return Carbon::parse($user->last_login_at)->format('m/d/Y g:i A ');
            })
            ->editColumn('name', function ($user) {
                return Html::linkAction('UserController@show', $user->name, $user->id) ;
            })
            ->editColumn('email', function ($user) {
                return Html::mailto($user->email) ;
            })
            ->addColumn('state', function (User $user) {
                return $user->alumnus ? $user->alumnus->state : '';
            })
            ->addColumn('zipcode', function (User $user) {
                return $user->alumnus ? $user->alumnus->zipcode : '';
            })
            ->addColumn('year_graduated', function (User $user) {
                return $user->alumnus ? $user->alumnus->year_graduated : '';
            })
            ->addColumn('volunteer', function (User $user) {
                if ($user->alumnus)
                    if ($user->alumnus->volunteer == 1)
                        return 'Yes';
                    elseif ($user->alumnus->volunteer == 0)
                        return 'No';
                    else
                        return '';
            })
            ->addColumn('loyal_lion', function (User $user) {
                if ($user->alumnus)
                    if ($user->alumnus->loyal_lion == 1)
                        return 'Yes';
                    elseif ($user->alumnus->loyal_lion == 0)
                        return 'No';
                    else
                        return '';
            })
            ->addColumn('date_sort', function ($user) {
                if ($user->last_login_at !== null)
                    return Carbon::parse($user->last_login_at)->format('YmdHis');
            })
            ->rawColumns(['name', 'email']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->has('alumnus')
        ->select('id', 'name', 'email', 'last_login_at');
    }

    public function html()
    {
        $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($this->getParameters());
    }

    protected function getParameters()
    {
        return [
            'dom'          => 'Bfrtip',
            'buttons'      => ['export', 'print', 'reset', 'reload'],
            'lengthMenu'   => [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
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
            'name',
            'email',
            'state',
            'year_graduated',
            'volunteer',
            'loyal_lion',
            'last_login_at' => [ 'orderData' => 8],
            'date_sort' => [ 'type' => 'num', 'visible' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Alumni_' . date('YmdHis');
    }
}
