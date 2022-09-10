<?php 

namespace App\Services\Task;

use App\Models\Developer;
use App\Models\Task;
use App\Services\Task\Utils\PlannerAlgorithm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class TaskPlanService
{

    public function assign(): void
    {

        $developers = Developer::all();
        $limit = Task::whereNull('developer_id')->count() / $developers->count();

        for($i = 1; $i <= ceil($limit); $i++){

            $tasks = Task::orderBy('estimated_duration', 'ASC')
                ->whereNull('developer_id')
                ->limit($developers->count())
                ->get();

            $developers = $this->matrisDifference($tasks, $developers);
            
            $matris = [];
            foreach($developers as $developerKey => $developer){
                foreach($tasks as $taskKey => $task){
                    $exceptedDuration = $this->exceptedDuration($task, $developer);
                    $matris[$developerKey][$taskKey] =  $exceptedDuration <= $task->estimated_duration ? intval($exceptedDuration * 100) : 1000;
                }
            }

            $solves = (new PlannerAlgorithm($matris))->solve();
            $this->assignToDevelopers($solves, $tasks, $developers);
            
        }
    }

    private function assignToDevelopers($solves, $tasks, $developers): void
    {
        foreach($solves as $key => $work){
            $tasks[$work]->update([
                'developer_id' => $developers[$key]->id,
                'expected_duration' => $this->exceptedDuration($tasks[$work], $developers[$key])
            ]);
        }
    }

    private function exceptedDuration(Task $task, Developer $developer): float
    {
        return (($task->level * 100) / $developer->difficulty) / 100;
    }

    private function matrisDifference(Collection $tasks, Collection $developers): Collection|SupportCollection
    {
        $diff = 0;
        if(count($tasks) !== count($developers)){
            $diff = count($developers) - count($tasks);
        }

        if($diff > 0){    
            $developerIds = Task::selectRaw('SUM(expected_duration) as total_developer_duration, developer_id')
                ->groupBy('developer_id')
                ->orderBy('total_developer_duration', 'DESC')
                ->limit($diff)
                ->pluck('developer_id')
                ->toArray();
            
            $developers = collect($developers)->filter(function($value) use ($developerIds){
                return !in_array($value->id, $developerIds);
            })->values();
        }
        return $developers;
    }
}