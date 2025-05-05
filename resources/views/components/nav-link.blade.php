
<a href="{{ url('/dashboard/' .$link) }}" @class([
    'hover:no-underline hover:text-[#151b28]',
    'hover:no-underline text-white hover:text-[#151b28]' =>
       $active
])>
    <button @class([
        'w-full p-2 gap-2 flex items-center h-full hover:bg-white hover:text-[#151b28] text-left text-sm transition-all rounded-sm cursor-pointer',
        'w-full p-2 gap-2 flex items-center h-full bg-[#151b28]' =>
           $active
    ])>
      <img width="25" height="25" src="{{ asset('/assets/' . $image ) }}" alt="icon">
     {{ $label }}   
    </button>
</a>
