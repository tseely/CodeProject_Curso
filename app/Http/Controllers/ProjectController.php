<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

class ProjectController extends Controller
{
    private $repository;
    private $service;
    
    public function __construct(ProjectRepository $repository, ProjectService $service) {
        $this->service = $service;
        $this->repository = $repository;
        $this->middleware('check.project.owner', ['except' => ['store','show','index']]);
        $this->middleware('check.project.permission', ['except' => ['store','update','destroy','index']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->findWithOwnerAndMember(\Authorizer::getResourceOwnerId());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {   
        return $this->service->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {   
        return $this->service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {   
        return $this->service->delete($id);
    }
    
    public function listMembers($id) {
        return $this->service->listMembers($id);
    }
    
    public function isMember($projectId, $memberId) {
        return $this->service->isMember($projectId, $memberId);
    }
    
    public function addMember($projectId, $memberId) {
        return $this->service->addMember($projectId, $memberId);
    }
    
    public function removeMember($projectId, $memberId) {
        return $this->service->removeMember($projectId, $memberId);
    }
}
