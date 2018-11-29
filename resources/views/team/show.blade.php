@extends('layouts.master')

@section('title', 'Teamwork Dashboard')


@section('content')
    <div
        class="mt-6"
    >
        <h1 class="text-grey-darker text-center font-thin tracking-wide text-5xl mb-6">
            Team {{ $team->name }}
        </h1>
        <p>
            Start Date: {{ $startDate }}
        </p>
        <p>
            End Date: {{ $endDate }}
        </p>
        <div
            class="flex flex-wrap mb-4"
        >
            @foreach($members as $member)
            <div
                class="w-full sm:w-1/2 xl:w-1/3 mb-4"
            >
                <div
                    class="rounded shadow-lg bg-white m-2 h-full"
                >
                    <div
                        class="px-6 py-4"
                    >
                        <div
                            class="font-bold text-xl mb-2 tracking-wide"
                        >
                            {{ $member->{'first-name'} }} {{ $member->{'last-name'} }}
                        </div>
                    </div>
                    <div
                        class="px-6 py-4"
                    >
                            <span 
                                class="inline-block bg-grey-lighter rounded-full my-1 px-3 py-1 text-sm font-semibold text-grey-darker mr-2"
                                id="member-{{ $member->id }}"
                            >
                                 {{ $member->estimatedMinutes / 60 }} hrs
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
