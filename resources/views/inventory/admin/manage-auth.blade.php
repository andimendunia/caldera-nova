<div id="content" class="py-12 max-w-2xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
   <livewire:inv-auths />
   <script>
       document.addEventListener("DOMContentLoaded", () => {
           Livewire.hook('commit', ({ component, respond }) => {
               const pgbar = document.getElementById('pgbar');
               component.name == 'inv-auths' ? pgbar.classList.remove('hidden') : false;
               respond(() => {
                   component.name == 'inv-auths' ? pgbar.classList.add('hidden') : false;
               });
           });
       });
   </script>
</div>
