<?php

namespace App\Http\Controllers;

use App\DataTables\ExpertsQuestionsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExpertsQuestionsRequest;
use App\Http\Requests\UpdateExpertsQuestionsRequest;
use App\Repositories\ExpertsQuestionsRepository;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Response;

class ExpertsQuestionsController extends AppBaseController
{
    /** @var  ExpertsQuestionsRepository */
    private $expertsQuestionsRepository;

    public function __construct(ExpertsQuestionsRepository $expertsQuestionsRepo)
    {
        $this->expertsQuestionsRepository = $expertsQuestionsRepo;
    }

    /**
     * Display a listing of the ExpertsQuestions.
     *
     * @param ExpertsQuestionsDataTable $expertsQuestionsDataTable
     * @return Response
     */
    public function index(ExpertsQuestionsDataTable $expertsQuestionsDataTable)
    {
        return $expertsQuestionsDataTable->render('expertsQuestions.index');
    }

    /**
     * Show the form for creating a new ExpertsQuestions.
     *
     * @return Response
     */
    public function create()
    {
        return view('expertsQuestions.create');
    }

    /**
     * Store a newly created ExpertsQuestions in storage.
     *
     * @param CreateExpertsQuestionsRequest $request
     *
     * @return Response
     */
    public function store(CreateExpertsQuestionsRequest $request)
    {
        $input = $request->all();

        $expertsQuestions = $this->expertsQuestionsRepository->create($input);

        Flash::success('ExpertsQuestions saved successfully.');

        return redirect(route('expertsQuestions.index'));
    }

    /**
     * Display the specified ExpertsQuestions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $expertsQuestions = $this->expertsQuestionsRepository->findWithoutFail($id);

        if (empty($expertsQuestions)) {
            Flash::error('ExpertsQuestions not found');

            return redirect(route('expertsQuestions.index'));
        }

        return view('expertsQuestions.show')->with('expertsQuestions', $expertsQuestions);
    }

    /**
     * Show the form for editing the specified ExpertsQuestions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $expertsQuestions = $this->expertsQuestionsRepository->findWithoutFail($id);

        if (empty($expertsQuestions)) {
            Flash::error('ExpertsQuestions not found');

            return redirect(route('expertsQuestions.index'));
        }

        return view('expertsQuestions.edit')->with('expertsQuestions', $expertsQuestions);
    }

    /**
     * Update the specified ExpertsQuestions in storage.
     *
     * @param  int              $id
     * @param UpdateExpertsQuestionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpertsQuestionsRequest $request)
    {
        $expertsQuestions = $this->expertsQuestionsRepository->findWithoutFail($id);

        if (empty($expertsQuestions)) {
            Flash::error('ExpertsQuestions not found');

            return redirect(route('expertsQuestions.index'));
        }

        $expertsQuestions = $this->expertsQuestionsRepository->update($request->all(), $id);

        Flash::success('ExpertsQuestions updated successfully.');

        return redirect(route('expertsQuestions.index'));
    }

    /**
     * Remove the specified ExpertsQuestions from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $expertsQuestions = $this->expertsQuestionsRepository->findWithoutFail($id);

        if (empty($expertsQuestions)) {
            Flash::error('ExpertsQuestions not found');

            return redirect(route('expertsQuestions.index'));
        }

        $this->expertsQuestionsRepository->delete($id);

        Flash::success('ExpertsQuestions deleted successfully.');

        return redirect(route('expertsQuestions.index'));
    }
}
