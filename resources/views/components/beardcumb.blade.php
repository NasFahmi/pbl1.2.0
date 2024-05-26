 @props(['menu', 'submenu', 'routemenu'])<!-- Breadcrumb Start -->
 <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

     <nav>
         <ol class="flex items-center gap-2">
             <li>
                 <a wire:navigate class="font-medium" href="{{ $routemenu }}">{{ $menu }} /</a>
             </li>
             <li class="text-primary">{{ $submenu }}</li>
         </ol>
     </nav>
 </div>
 <!-- Breadcrumb End -->
