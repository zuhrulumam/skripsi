<?php

namespace App\DataTables;

use App\Models\DataDosen;
use Form;
use Yajra\Datatables\Services\DataTable;

class DataDosenDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('actions', function ($data) {
                            return '
                            ' . Form::open(['route' => ['dataDosens.destroy', $data->id], 'method' => 'delete']) . '
                            <div class=\'btn-group\'>
                                <a href="' . route('dataDosens.show', [$data->id]) . '" class=\'btn btn-default btn-xs\'><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="' . route('dataDosens.edit', [$data->id]) . '" class=\'btn btn-default btn-xs\'><i class="glyphicon glyphicon-edit"></i></a>
                                ' . Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('Are you sure?')"
                            ]) . '
                            </div>
                            ' . Form::close() . '
                            ';
                        })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $dataDosens = DataDosen::query();

        return $this->applyScopes($dataDosens);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns(array_merge(
                $this->getColumns(),
                [
                    'actions' => [
                        'orderable' => false,
                        'searchable' => false,
                        'printable' => false,
                        'exportable' => false
                    ]
                ]
            ))
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => true,
                'buttons' => [
                    'csv',
                    'excel',
                    'pdf',
                    'print',
                    'reset',
                    'reload'
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'ID_STATUS_HENTI' => ['name' => 'ID_STATUS_HENTI', 'data' => 'ID_STATUS_HENTI'],
            'NAMA' => ['name' => 'NAMA', 'data' => 'NAMA'],
            'NIP' => ['name' => 'NIP', 'data' => 'NIP'],
            'ID_UNIT' => ['name' => 'ID_UNIT', 'data' => 'ID_UNIT'],
            'ID_SUB_UNIT' => ['name' => 'ID_SUB_UNIT', 'data' => 'ID_SUB_UNIT'],
            'ID_JENIS_STAF' => ['name' => 'ID_JENIS_STAF', 'data' => 'ID_JENIS_STAF'],
            'FAKULTAS' => ['name' => 'FAKULTAS', 'data' => 'FAKULTAS'],
            'NAMA1' => ['name' => 'NAMA1', 'data' => 'NAMA1']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'dataDosens';
    }
}
