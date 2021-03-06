<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class Teamwork
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function getRequest($path)
    {
        try {
            // Cache::forget('teamwork-' . $path);
            return Cache::remember('teamwork-' . $path, 15, function () use ($path) {
                $request = $this->client->request('GET', $path);
                return json_decode($request->getBody());
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            echo $e->getMessage();
            die;
        }
    }

    public function getProjects()
    {
        return collect(
            $this->getRequest('/projects.json')->projects
        );
    }
    
    public function getPeople()
    {
        return collect(
            $this->getRequest(
                '/companies/' .
                config('teamwork.company') .
                '/people.json'
            )->people
        );
    }
    
    public function getTasksForPerson(int $person)
    {
        return collect(
            $this->getRequest(
                '/tasks.json?responsible-party-ids=' .
                $person
            )->{'todo-items'}
        );
    }
    
    public function getWeeklyTasksForPerson(int $person, Carbon $date)
    {
        $startDate = $date->copy()->startOfWeek();
        $endDate = $date->copy()->endOfWeek();

        return collect(
            $this->getRequest(
                '/tasks.json?' .
                'responsible-party-ids=' . $person .
                '&startDate=' . $startDate->format('Ymd') .
                '&endDate=' . $endDate->format('Ymd')
            )->{'todo-items'}
        );
    }
    
    public function getTasksForPersonBetweenDates(
        int $person,
        Carbon $startDate,
        Carbon $endDate
    ) {
        return collect(
            $this->getRequest(
                '/tasks.json?' .
                'responsible-party-ids=' . $person .
                '&startDate=' . $startDate->format('Ymd') .
                '&includeCompletedTasks=true' .
                '&includeCompletedSubtasks=true' .
                '&endDate=' . $endDate->format('Ymd')
            )->{'todo-items'}
        );
    }

    public function getPerson(int $id)
    {
        return collect(
            $this->getRequest(
                '/people/' .
                $id .
                '.json'
            )
        );
    }
}
