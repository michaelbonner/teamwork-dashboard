@extends('layouts.master')

@section('title', 'Teamwork Dashboard')


@section('content')
    <div
        class="mt-6 mx-6"
    >
        <div
            class="text-center mb-6"
        >
            <h1 
                class="text-grey-darker font-thin tracking-wide text-5xl mb-2"
            >
                Team {{ $team->name }}
            </h1>
            <p
                class="text-grey-darkest"
            >
                Start Date: {{ $startDate }}
                | 
                End Date: {{ $endDate }}
            </p>
        </div>
        <div
            class="flex flex-wrap mb-4"
        >
            @foreach($members as $member)
            <team-member-component
                :member="{{ json_encode($member) }}"
            ></team-member-component>
            @endforeach
        </div>
    </div>
@stop
