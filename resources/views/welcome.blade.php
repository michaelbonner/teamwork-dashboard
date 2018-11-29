@extends('layouts.master')

@section('title', 'Teamwork Dashboard')


@section('content')
    <div class="flex items-center justify-center mt-6">
        <div class="flex flex-col justify-around">
            <div>
                <h1 class="text-grey-darker text-center font-thin tracking-wide text-5xl mb-6">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <div class="flex">
                    @foreach($teams as $team)
                        <div class="rounded shadow-lg m-2 bg-white w-1/2">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2 tracking-wide">{{ $team->name }}</div>
                            </div>
                            {{-- <div class="px-6 py-4">
                                <a class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                                    View
                                </a>
                            </div> --}}
                            <div class="px-6 py-4">
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
                    @endforeach
                </div>
                <div class="flex justify-center">
                    <div class="m-2 text-grey-darker">
                        <div class="font-bold text-xl mb-2 mt-6 tracking-wide">Unassigned:</div>
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
        </div>
    </div>
@stop

