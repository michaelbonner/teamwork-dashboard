@extends('layouts.master')

@section('title', 'Teamwork Dashboard')


@section('content')
    <div
        class="mt-6"
    >
        <h1 class="text-grey-darker text-center font-thin tracking-wide text-5xl mb-6">
            {{ config('app.name', 'Teamwork Dashboard') }}
        </h1>
        <div
            class="flex flex-wrap mb-4"
        >
            @foreach($teams as $team)
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
                                {{ $team->name }}
                            </div>
                            <p
                                class="mt-4"
                            >
                                <a 
                                    href="#"
                                    class="bg-transparent hover:bg-blue no-underline text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded"
                                    >
                                    View Status
                                </a>
                            </p>
                        </div>
                        <div
                            class="px-6 py-4"
                        >
                            @foreach($team->teamMembers as $member)
                                <span 
                                    class="inline-block bg-grey-lighter rounded-full my-1 px-3 py-1 text-sm font-semibold text-grey-darker mr-2"
                                    id="member-{{ $member->id }}"
                                >
                                {{ $member->{'first-name'} }} {{ $member->{'last-name'} }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div
            class="flex justify-center"
        >
            <div
                class="m-2 text-grey-darker"
            >
                <div
                    class="font-bold text-xl mb-2 mt-6 tracking-wide"
                >
                    Unassigned:
                </div>
                <ul>
                    @foreach($unassigned as $member)
                        <li
                            id="member-{{ $member->id }}"
                        >
                            {{ $member->{'first-name'} }} {{ $member->{'last-name'} }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop
