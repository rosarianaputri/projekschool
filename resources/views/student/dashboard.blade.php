@extends('layouts.student')

@section('content')

<div class="nxl-content-right">
    <div class="nxl-content-inner" style="padding-top: 60px; padding-left: 40px; padding-right: 40px; padding-bottom: 40px;">
        
        @if($step == 0)
            @include('student.dashboard-main')
        @else
            @include('student.dashboard-step', ['step' => $step])
        @endif

    </div>
</div>

@endsection