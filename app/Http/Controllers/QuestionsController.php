<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionsRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use App\Repositories\QuestionsRepository;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Response;

class QuestionsController extends AppBaseController
{
    /** @var  QuestionsRepository */
    private $questionsRepository;

    public function __construct(QuestionsRepository $questionsRepo)
    {
        $this->questionsRepository = $questionsRepo;
    }

    /**
     * Display a listing of the Questions.
     *
     * @param QuestionsDataTable $questionsDataTable
     * @return Response
     */
    public function index(QuestionsDataTable $questionsDataTable)
    {
        return $questionsDataTable->render('questions.index');
    }

    /**
     * Show the form for creating a new Questions.
     *
     * @return Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created Questions in storage.
     *
     * @param CreateQuestionsRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionsRequest $request)
    {
        $input = $request->all();

        $questions = $this->questionsRepository->create($input);

        Flash::success('Questions saved successfully.');

        return redirect(route('questions.index'));
    }

    /**
     * Display the specified Questions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questions = $this->questionsRepository->findWithoutFail($id);

        if (empty($questions)) {
            Flash::error('Questions not found');

            return redirect(route('questions.index'));
        }

        return view('questions.show')->with('questions', $questions);
    }

    /**
     * Show the form for editing the specified Questions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questions = $this->questionsRepository->findWithoutFail($id);

        if (empty($questions)) {
            Flash::error('Questions not found');

            return redirect(route('questions.index'));
        }

        return view('questions.edit')->with('questions', $questions);
    }

    /**
     * Update the specified Questions in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionsRequest $request)
    {
        $questions = $this->questionsRepository->findWithoutFail($id);

        if (empty($questions)) {
            Flash::error('Questions not found');

            return redirect(route('questions.index'));
        }

        $questions = $this->questionsRepository->update($request->all(), $id);

        Flash::success('Questions updated successfully.');

        return redirect(route('questions.index'));
    }

    /**
     * Remove the specified Questions from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questions = $this->questionsRepository->findWithoutFail($id);

        if (empty($questions)) {
            Flash::error('Questions not found');

            return redirect(route('questions.index'));
        }

        $this->questionsRepository->delete($id);

        Flash::success('Questions deleted successfully.');

        return redirect(route('questions.index'));
    }
}
