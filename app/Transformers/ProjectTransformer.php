<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

/**
 * Description of ProjectTransformer
 *
 * @author thiago
 */
class ProjectTransformer extends TransformerAbstract {
    
    protected $defaultIncludes = [
        'members',
        'files',
        'tasks',
        'notes'
    ];
    
    public function transform(Project $project) {
        return [
            'id'    => (int) $project->id,
            'project' => $project->name,
            'client' => $project->client->name,
            'owner' => $project->owner_id,
            'project_id' => $project->id,
            'description' => $project->description,
            'progress' => (int) $project->progress,
            'status'    => $project->status,
            'due_date' => $project->due_date,
            'is_member' => $project->owner_id != \Authorizer::getResourceOwnerId(),
        ];
    }
    
    public function includeMembers(Project $project) {
        return $this->collection($project->members, new MemberTransformer());
    }
    
    public function includeFiles(Project $project) {
        return $this->collection($project->files, new ProjectFileTransformer());
    }
    
    public function includeTasks(Project $project) {
        return $this->collection($project->tasks, new ProjectTaskTransformer());
    }
    
    public function includeNotes(Project $project) {
        return $this->collection($project->notes, new ProjectNoteTransformer());
    }
    
}
