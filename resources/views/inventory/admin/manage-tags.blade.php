<div id="content" class="py-12 max-w-2xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
   <livewire:inv-tags />
   <script>
       document.addEventListener("DOMContentLoaded", () => {
           Livewire.hook('commit', ({ component, respond }) => {
               const pgbar = document.getElementById('pgbar');
               component.name == 'inv-tags' ? pgbar.classList.remove('hidden') : false;
               respond(() => {
                   component.name == 'inv-tags' ? pgbar.classList.add('hidden') : false;
               });
           });
           Livewire.hook('element.init', ({ component }) => {
               const n = component.name;
               if (n == 'inv-tags-edit') {
                   const i = component.el.getElementsByTagName('input');
                   i.length > 0 ? i[0].focus() : false;
               }
           });
       });
   </script>
</div>
