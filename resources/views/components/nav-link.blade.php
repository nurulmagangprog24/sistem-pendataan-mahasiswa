{{-- @props(['active' => false])
<a class="w-full {{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md  px-3 py-2 text-sm font-medium " aria-current="{{ $active ? 'page' : false }}" {{ $attributes }}>{{ $slot }}</a> --}}
@props(['active' => false])

<a {{ $attributes->merge([
  'class' => 'block py-2 px-4 rounded-md text-sm font-medium ' . ($active 
    ? 'bg-blue-600 text-white' 
    : 'text-gray-300 hover:bg-blue-700 hover:text-white')
]) }}>
  {{ $slot }}
</a>
