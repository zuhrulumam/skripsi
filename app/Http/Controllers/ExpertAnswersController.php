<?php

namespace App\Http\Controllers;

use App\DataTables\ExpertAnswersDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExpertAnswersRequest;
use App\Http\Requests\UpdateExpertAnswersRequest;
use App\Repositories\ExpertAnswersRepository;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Response;

class ExpertAnswersController extends AppBaseController
{
    /** @var  ExpertAnswersRepository */
    private $expertAnswersRepository;

    public function __construct(ExpertAnswersRepository $expertAnswersRepo)
    {
        $this->expertAnswersRepository = $expertAnswersRepo;
    }

    /**
     * Display a listing of the ExpertAnswers.
     *
     * @param ExpertAnswersDataTable $expertAnswersDataTable
     * @return Response
     */
    public function index(ExpertAnswersDataTable $expertAnswersDataTable)
    {
        return $expertAnswersDataTable->render('expertAnswers.index');
    }

    /**
     * Show the form for creating a new ExpertAnswers.
     *
     * @return Response
     */
    public function create()
    {
        return view('expertAnswers.create');
    }

    /**
     * Store a newly created ExpertAnswers in storage.
     *
     * @param CreateExpertAnswersRequest $request
     *
     * @return Response
     */
    public function store(CreateExpertAnswersRequest $request)
    {
        $input = $request->all();

        $expertAnswers = $this->expertAnswersRepository->create($input);

        Flash::success('ExpertAnswers saved successfully.');

        return redirect(route('expertAnswers.index'));
    }

    /**
     * Display the specified ExpertAnswers.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $expertAnswers = $this->expertAnswersRepository->findWithoutFail($id);

        if (empty($expertAnswers)) {
            Flash::error('ExpertAnswers not found');

            return redirect(route('expertAnswers.index'));
        }

        return view('expertAnswers.show')->with('expertAnswers', $expertAnswers);
    }

    /**
     * Show the form for editing the specified ExpertAnswers.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $expertAnswers = $this->expertAnswersRepository->findWithoutFail($id);

        if (empty($expertAnswers)) {
            Flash::error('ExpertAnswers not found');

            return redirect(route('expertAnswers.index'));
        }

        return view('expertAnswers.edit')->with('expertAnswers', $expertAnswers);
    }

    /**
     * Update the specified ExpertAnswers in storage.
     *
     * @param  int              $id
     * @param UpdateExpertAnswersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpertAnswersRequest $request)
    {
        $expertAnswers = $this->expertAnswersRepository->findWithoutFail($id);

        if (empty($expertAnswers)) {
            Flash::error('ExpertAnswers not found');

            return redirect(route('expertAnswers.index'));
        }

        $expertAnswers = $this->expertAnswersRepository->update($request->all(), $id);

        Flash::success('ExpertAnswers updated successfully.');

        return redirect(route('expertAnswers.index'));
    }

    /**
     * Remove the specified ExpertAnswers from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $expertAnswers = $this->expertAnswersRepository->findWithoutFail($id);

        if (empty($expertAnswers)) {
            Flash::error('ExpertAnswers not found');

            return redirect(route('expertAnswers.index'));
        }

        $this->expertAnswersRepository->delete($id);

        Flash::success('ExpertAnswers deleted successfully.');

        return redirect(route('expertAnswers.index'));
    }
}
