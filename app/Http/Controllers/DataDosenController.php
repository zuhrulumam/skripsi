<?php

namespace App\Http\Controllers;

use App\DataTables\DataDosenDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDataDosenRequest;
use App\Http\Requests\UpdateDataDosenRequest;
use App\Repositories\DataDosenRepository;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Response;

class DataDosenController extends AppBaseController
{
    /** @var  DataDosenRepository */
    private $dataDosenRepository;

    public function __construct(DataDosenRepository $dataDosenRepo)
    {
        $this->dataDosenRepository = $dataDosenRepo;
    }

    /**
     * Display a listing of the DataDosen.
     *
     * @param DataDosenDataTable $dataDosenDataTable
     * @return Response
     */
    public function index(DataDosenDataTable $dataDosenDataTable)
    {
        return $dataDosenDataTable->render('dataDosens.index');
    }

    /**
     * Show the form for creating a new DataDosen.
     *
     * @return Response
     */
    public function create()
    {
        return view('dataDosens.create');
    }

    /**
     * Store a newly created DataDosen in storage.
     *
     * @param CreateDataDosenRequest $request
     *
     * @return Response
     */
    public function store(CreateDataDosenRequest $request)
    {
        $input = $request->all();

        $dataDosen = $this->dataDosenRepository->create($input);

        Flash::success('DataDosen saved successfully.');

        return redirect(route('dataDosens.index'));
    }

    /**
     * Display the specified DataDosen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dataDosen = $this->dataDosenRepository->findWithoutFail($id);

        if (empty($dataDosen)) {
            Flash::error('DataDosen not found');

            return redirect(route('dataDosens.index'));
        }

        return view('dataDosens.show')->with('dataDosen', $dataDosen);
    }

    /**
     * Show the form for editing the specified DataDosen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dataDosen = $this->dataDosenRepository->findWithoutFail($id);

        if (empty($dataDosen)) {
            Flash::error('DataDosen not found');

            return redirect(route('dataDosens.index'));
        }

        return view('dataDosens.edit')->with('dataDosen', $dataDosen);
    }

    /**
     * Update the specified DataDosen in storage.
     *
     * @param  int              $id
     * @param UpdateDataDosenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDataDosenRequest $request)
    {
        $dataDosen = $this->dataDosenRepository->findWithoutFail($id);

        if (empty($dataDosen)) {
            Flash::error('DataDosen not found');

            return redirect(route('dataDosens.index'));
        }

        $dataDosen = $this->dataDosenRepository->update($request->all(), $id);

        Flash::success('DataDosen updated successfully.');

        return redirect(route('dataDosens.index'));
    }

    /**
     * Remove the specified DataDosen from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dataDosen = $this->dataDosenRepository->findWithoutFail($id);

        if (empty($dataDosen)) {
            Flash::error('DataDosen not found');

            return redirect(route('dataDosens.index'));
        }

        $this->dataDosenRepository->delete($id);

        Flash::success('DataDosen deleted successfully.');

        return redirect(route('dataDosens.index'));
    }
}
