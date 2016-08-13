<?php

namespace App\Http\Controllers;

use App\DataTables\ExpertsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExpertsRequest;
use App\Http\Requests\UpdateExpertsRequest;
use App\Repositories\ExpertsRepository;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Response;

class ExpertsController extends AppBaseController
{
    /** @var  ExpertsRepository */
    private $expertsRepository;

    public function __construct(ExpertsRepository $expertsRepo)
    {
        $this->expertsRepository = $expertsRepo;
    }

    /**
     * Display a listing of the Experts.
     *
     * @param ExpertsDataTable $expertsDataTable
     * @return Response
     */
    public function index(ExpertsDataTable $expertsDataTable)
    {
        return $expertsDataTable->render('experts.index');
    }

    /**
     * Show the form for creating a new Experts.
     *
     * @return Response
     */
    public function create()
    {
        return view('experts.create');
    }

    /**
     * Store a newly created Experts in storage.
     *
     * @param CreateExpertsRequest $request
     *
     * @return Response
     */
    public function store(CreateExpertsRequest $request)
    {
        $input = $request->all();

        $experts = $this->expertsRepository->create($input);

        Flash::success('Experts saved successfully.');

        return redirect(route('experts.index'));
    }

    /**
     * Display the specified Experts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $experts = $this->expertsRepository->findWithoutFail($id);

        if (empty($experts)) {
            Flash::error('Experts not found');

            return redirect(route('experts.index'));
        }

        return view('experts.show')->with('experts', $experts);
    }

    /**
     * Show the form for editing the specified Experts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $experts = $this->expertsRepository->findWithoutFail($id);

        if (empty($experts)) {
            Flash::error('Experts not found');

            return redirect(route('experts.index'));
        }

        return view('experts.edit')->with('experts', $experts);
    }

    /**
     * Update the specified Experts in storage.
     *
     * @param  int              $id
     * @param UpdateExpertsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpertsRequest $request)
    {
        $experts = $this->expertsRepository->findWithoutFail($id);

        if (empty($experts)) {
            Flash::error('Experts not found');

            return redirect(route('experts.index'));
        }

        $experts = $this->expertsRepository->update($request->all(), $id);

        Flash::success('Experts updated successfully.');

        return redirect(route('experts.index'));
    }

    /**
     * Remove the specified Experts from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $experts = $this->expertsRepository->findWithoutFail($id);

        if (empty($experts)) {
            Flash::error('Experts not found');

            return redirect(route('experts.index'));
        }

        $this->expertsRepository->delete($id);

        Flash::success('Experts deleted successfully.');

        return redirect(route('experts.index'));
    }
}
