
@props([
'value',
'name',
'for',
'error',
])

<input {{ $attributes->class([
'input input-bordered input-xs mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400
focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm font-semibold focus:ring-1 max-w-xs',
'border-rose-500 ring-1 ring-rose-500' => $error
]) }}
@isset($name) name="{{ $name }}" @endif
type="text"
@isset($value) value="{{ $value }}" @endif
{{ $attributes }}
/>