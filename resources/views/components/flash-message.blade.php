@if(session()->has('success'))
<div 
x-data="{show: true}" 
x-init="setTimeout(() => show = false, 3000)" 
x-show="show"
class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
  <p>
    {{session('success')}}
  </p>
</div>
@endif   
   