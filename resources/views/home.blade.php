@extends('layouts.master')

@section('title', 'Management Dashboard')

@section('content')
    
    <div class="min-h-screen flex w-full items-center">
        <div class="md:w-1/2 md:mx-auto">
            <div class="rounded shadow">
                <div class="font-medium text-lg text-teal-darker bg-teal p-3 rounded-t">
                    Management Dashboard
                </div>
                <div class="bg-white p-3 rounded-b">
                    @if (session('status'))
                        <div class="bg-green-lightest border border-green-light text-green-dark text-sm px-4 py-3 rounded mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-grey-dark">
                        You are logged in!
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop