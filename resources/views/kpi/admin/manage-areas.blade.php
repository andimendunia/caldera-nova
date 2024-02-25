<div id="content" class="py-12 max-w-xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
   <livewire:kpi-areas wire:key="areas" />
   <script>
       document.addEventListener("DOMContentLoaded", () => {
           Livewire.hook('commit', ({ component, respond }) => {
               const pgbar = document.getElementById('pgbar');
               component.name == 'kpi-areas' ? pgbar.classList.remove('hidden') : false;
               respond(() => {
                   component.name == 'kpi-areas' ? pgbar.classList.add('hidden') : false;
               });
           });
       });
   </script>
</div>
