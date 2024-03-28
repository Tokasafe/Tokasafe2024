@extends('navigation.homebase')
@section('content')

    <div>

        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold ">Reference</div>
            <div class="w-40 text-xs font-semibold">: {{ $EventReport }}</div>
        </div>
        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold ">Date</div>
            <div class="w-40 text-xs font-semibold">: {{ $Tanggal }}</div>
        </div>
        <div class="flex flex-row pl-2 sm:pl-0">
            <div class="w-20 text-xs font-semibold ">Workgroup</div>
            <div class="text-xs font-semibold w-96">: {{ $Workgroup }}</div>
        </div>
    </div>





    <div class="flex justify-center m-2 shadow-md shadow-inherit tabs ">
        <a href="{{ route('eventReportRegister', [$EventReport]) }}"
            class="{{ Request::is('eventReport/details/*') ? 'tab-active font-semibold text-green-500  ' : '' }}tab tab-lifted tab-xs">Report
            Details</a>
        <a href="{{ route('action', [$EventReport]) }}"
            class="{{ Request::is('eventReport/action/*') ? 'tab-active font-semibold text-green-500  ' : '' }}tab tab-lifted tab-xs">{{ __('Action') }}</a>
        @if ($Workflow_Template != 1)
            <a href="{{ route('eventParticipants', [$EventReport]) }}"
                class="{{ Request::is('eventReport/eventParticipants/*') ? 'tab-active font-semibold text-green-500 ' : '' }}tab tab-lifted tab-xs">Pihak
                Terlibat Langsung</a>
            <a class="tab tab-lifted tab-xs">Partisipan Investigasi</a>
            <a class="tab tab-lifted tab-xs">PEEPO</a>
            <a class="tab tab-lifted tab-xs">Time Line dan Analisis Informasi</a>
            <a class="tab tab-lifted tab-xs">Investigasi Kecelakaan</a>
            <a class="tab tab-lifted tab-xs">Tindakan Perbaikan</a>
            <a class="tab tab-lifted tab-xs">Penerimaan & Komentar Investigasi</a>
        @endif
        <a href="{{ route('document', [$EventReport]) }}"
            class=" {{ Request::is('eventReport/document/*') ? 'tab-active font-semibold text-green-500 ' : '' }}tab tab-lifted tab-xs">Dokumen</a>
    </div>



    @livewire('event-report.panel.index', ['id' => $EventReport])
    <div class="mb-2 overflow-y-auto lg:h-125 2xl:h-127">
        @if (Request::is('eventReport/details/*'))
            @livewire('event-report.register.update', ['id' => $EventReport])
        @elseif(Request::is('eventReport/eventParticipants/*'))
            @livewire('event-report.participan.index', ['id' => $EventReport])
        @elseif(Request::is('eventReport/action/*'))
            @livewire('event-report.action-event.index', ['id' => $EventReport])
        @elseif(Request::is('eventReport/document/*'))
            @livewire('event-report.document.index', ['id' => $EventReport])
        @endif
    </div>

@stop
