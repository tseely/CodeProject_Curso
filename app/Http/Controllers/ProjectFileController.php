<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;

class ProjectFileController extends Controller
{
    private $repository;
    private $service;
    
    public function __construct(ProjectFileRepository $repository, ProjectFileService $service) {
        $this->service = $service;
        $this->repository = $repository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $id)
    {
        if(empty($request->file('file'))) {
            return [
                'error'     => true,
                'message'   => 'Please select file to upload.',
            ];
        }       
        
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        
        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['project_id'] = $id;
        
        return $this->service->createFile($data);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $fileId
     * @return Response
     */
    public function show($id, $fileId)
    {   
        return $this->service->find($id, $fileId);
    }
    
    public function showFile($id, $fileId) {
        return $this->service->showFile($id, $fileId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $fileId
     * @return Response
     */
    public function update(Request $request, $id, $fileId)
    {   
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($data, $fileId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $fileId
     * @return Response
     */
    public function destroy($id,$fileId)
    {
        return $this->service->delete($id, $fileId);
    }
}
