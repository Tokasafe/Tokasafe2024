
@props([
'value',
'name',
'closed',
'error',
])
<select  {{ $attributes->class([
    'select select-bordered select-xs  px-3  border shadow-sm border-slate-300 placeholder-slate-400
focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full  sm:text-sm font-semibold focus:ring-1',
'border-rose-500 ring-1 ring-rose-500 outline-none ' => $error,])}} @if ($closed) disabled @endif>

 {{ $slot }}

</select>