<div id="content" class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
   <livewire:ins-rtm-metrics />
   <script>
       document.addEventListener("DOMContentLoaded", () => {
           Livewire.hook('commit', ({ component, respond }) => {
               const pgbar = document.getElementById('pgbar');
               component.name == 'ins-rtm-metrics' ? pgbar.classList.remove('hidden') : false;
               respond(() => {
                   component.name == 'ins-rtm-metrics' ? pgbar.classList.add('hidden') : false;
               });
           });
       });
   </script>
</div>
   