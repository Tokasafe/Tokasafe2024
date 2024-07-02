
@props([
'value',
'name',
'for',
'error',
])

<input {{ $attributes->class([
'file-input file-input-bordered file-input-secondary  file-input-xs  border shadow-sm border-slate-300 placeholder-slate-400
focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full  sm:text-sm font-semibold focus:ring-1 ',
'border-rose-500 ring-1 ring-rose-500 outline-none ' => $error
]) }}
@isset($name) name="{{ $name }}" @endif
type="file"
@isset($value) value="{{ $value }}" @endif
{{ $attributes }}
/>