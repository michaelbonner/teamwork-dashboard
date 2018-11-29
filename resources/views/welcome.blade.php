@extends('layouts.master')

@section('title', 'Teamwork Dashboard')


@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <div class="flex flex-col justify-around h-full">
            <div>
                <h1 class="text-grey-darker text-center font-thin tracking-wide text-5xl mb-6">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <div class="flex">
                    @foreach($teams as $team)
                        <div class="max-w-sm rounded overflow-hidden shadow-lg m-2 bg-white">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2 tracking-wide">{{ $team->name }}</div>
                            </div>
                            <div class="px-6 py-4">
                                <span class="inline-block bg-grey-lighter rounded-full my-1 px-3 py-1 text-sm font-semibold text-grey-darker mr-2">photography</span>
                                <span class="inline-block bg-grey-lighter rounded-full my-1 px-3 py-1 text-sm font-semibold text-grey-darker mr-2">travel</span>
                                <span class="inline-block bg-grey-lighter rounded-full my-1 px-3 py-1 text-sm font-semibold text-grey-darker">winter</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

