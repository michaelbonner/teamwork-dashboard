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
                    <div class="max-w-sm rounded overflow-hidden shadow-lg m-2">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2 tracking-wide">The Coldest Sunset</div>
                            <p class="text-grey-darker text-base">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                            </p>
                        </div>
                        <div class="px-6 py-4">
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#photography</span>
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#travel</span>
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">#winter</span>
                        </div>
                    </div>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg m-2">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2 tracking-wide">The Coldest Sunset</div>
                            <p class="text-grey-darker text-base">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                            </p>
                        </div>
                        <div class="px-6 py-4">
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#photography</span>
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#travel</span>
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">#winter</span>
                        </div>
                    </div>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg m-2">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2 tracking-wide">The Coldest Sunset</div>
                            <p class="text-grey-darker text-base">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                            </p>
                        </div>
                        <div class="px-6 py-4">
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#photography</span>
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#travel</span>
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">#winter</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

