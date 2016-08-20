<?php

namespace App\Http\Controllers;

use App\DataTables\SubCategoriesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSubCategoriesRequest;
use App\Http\Requests\UpdateSubCategoriesRequest;
use App\Repositories\SubCategoriesRepository;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Response;

class SubCategoriesController extends AppBaseController
{
    /** @var  SubCategoriesRepository */
    private $subCategoriesRepository;

    public function __construct(SubCategoriesRepository $subCategoriesRepo)
    {
        $this->subCategoriesRepository = $subCategoriesRepo;
    }

    /**
     * Display a listing of the SubCategories.
     *
     * @param SubCategoriesDataTable $subCategoriesDataTable
     * @return Response
     */
    public function index(SubCategoriesDataTable $subCategoriesDataTable)
    {
        return $subCategoriesDataTable->render('subCategories.index');
    }

    /**
     * Show the form for creating a new SubCategories.
     *
     * @return Response
     */
    public function create()
    {
        return view('subCategories.create');
    }

    /**
     * Store a newly created SubCategories in storage.
     *
     * @param CreateSubCategoriesRequest $request
     *
     * @return Response
     */
    public function store(CreateSubCategoriesRequest $request)
    {
        $input = $request->all();

        $subCategories = $this->subCategoriesRepository->create($input);

        Flash::success('SubCategories saved successfully.');

        return redirect(route('subCategories.index'));
    }

    /**
     * Display the specified SubCategories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subCategories = $this->subCategoriesRepository->findWithoutFail($id);

        if (empty($subCategories)) {
            Flash::error('SubCategories not found');

            return redirect(route('subCategories.index'));
        }

        return view('subCategories.show')->with('subCategories', $subCategories);
    }

    /**
     * Show the form for editing the specified SubCategories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subCategories = $this->subCategoriesRepository->findWithoutFail($id);

        if (empty($subCategories)) {
            Flash::error('SubCategories not found');

            return redirect(route('subCategories.index'));
        }

        return view('subCategories.edit')->with('subCategories', $subCategories);
    }

    /**
     * Update the specified SubCategories in storage.
     *
     * @param  int              $id
     * @param UpdateSubCategoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubCategoriesRequest $request)
    {
        $subCategories = $this->subCategoriesRepository->findWithoutFail($id);

        if (empty($subCategories)) {
            Flash::error('SubCategories not found');

            return redirect(route('subCategories.index'));
        }

        $subCategories = $this->subCategoriesRepository->update($request->all(), $id);

        Flash::success('SubCategories updated successfully.');

        return redirect(route('subCategories.index'));
    }

    /**
     * Remove the specified SubCategories from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subCategories = $this->subCategoriesRepository->findWithoutFail($id);

        if (empty($subCategories)) {
            Flash::error('SubCategories not found');

            return redirect(route('subCategories.index'));
        }

        $this->subCategoriesRepository->delete($id);

        Flash::success('SubCategories deleted successfully.');

        return redirect(route('subCategories.index'));
    }
}
