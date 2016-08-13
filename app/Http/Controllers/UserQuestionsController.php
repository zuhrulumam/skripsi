<?php

namespace App\Http\Controllers;

use App\DataTables\UserQuestionsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserQuestionsRequest;
use App\Http\Requests\UpdateUserQuestionsRequest;
use App\Repositories\UserQuestionsRepository;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Response;

class UserQuestionsController extends AppBaseController
{
    /** @var  UserQuestionsRepository */
    private $userQuestionsRepository;

    public function __construct(UserQuestionsRepository $userQuestionsRepo)
    {
        $this->userQuestionsRepository = $userQuestionsRepo;
    }

    /**
     * Display a listing of the UserQuestions.
     *
     * @param UserQuestionsDataTable $userQuestionsDataTable
     * @return Response
     */
    public function index(UserQuestionsDataTable $userQuestionsDataTable)
    {
        return $userQuestionsDataTable->render('userQuestions.index');
    }

    /**
     * Show the form for creating a new UserQuestions.
     *
     * @return Response
     */
    public function create()
    {
        return view('userQuestions.create');
    }

    /**
     * Store a newly created UserQuestions in storage.
     *
     * @param CreateUserQuestionsRequest $request
     *
     * @return Response
     */
    public function store(CreateUserQuestionsRequest $request)
    {
        $input = $request->all();

        $userQuestions = $this->userQuestionsRepository->create($input);

        Flash::success('UserQuestions saved successfully.');

        return redirect(route('userQuestions.index'));
    }

    /**
     * Display the specified UserQuestions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userQuestions = $this->userQuestionsRepository->findWithoutFail($id);

        if (empty($userQuestions)) {
            Flash::error('UserQuestions not found');

            return redirect(route('userQuestions.index'));
        }

        return view('userQuestions.show')->with('userQuestions', $userQuestions);
    }

    /**
     * Show the form for editing the specified UserQuestions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userQuestions = $this->userQuestionsRepository->findWithoutFail($id);

        if (empty($userQuestions)) {
            Flash::error('UserQuestions not found');

            return redirect(route('userQuestions.index'));
        }

        return view('userQuestions.edit')->with('userQuestions', $userQuestions);
    }

    /**
     * Update the specified UserQuestions in storage.
     *
     * @param  int              $id
     * @param UpdateUserQuestionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserQuestionsRequest $request)
    {
        $userQuestions = $this->userQuestionsRepository->findWithoutFail($id);

        if (empty($userQuestions)) {
            Flash::error('UserQuestions not found');

            return redirect(route('userQuestions.index'));
        }

        $userQuestions = $this->userQuestionsRepository->update($request->all(), $id);

        Flash::success('UserQuestions updated successfully.');

        return redirect(route('userQuestions.index'));
    }

    /**
     * Remove the specified UserQuestions from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userQuestions = $this->userQuestionsRepository->findWithoutFail($id);

        if (empty($userQuestions)) {
            Flash::error('UserQuestions not found');

            return redirect(route('userQuestions.index'));
        }

        $this->userQuestionsRepository->delete($id);

        Flash::success('UserQuestions deleted successfully.');

        return redirect(route('userQuestions.index'));
    }
}
