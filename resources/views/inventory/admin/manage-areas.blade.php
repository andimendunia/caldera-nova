<div id="content" class="py-12 max-w-xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
   <x-modal name="create-area">
       <livewire:inv-areas-create wire:key="areas-create" lazy />
   </x-modal>
   <livewire:inv-areas wire:key="areas" />
   <script>
       document.addEventListener("DOMContentLoaded", () => {
           Livewire.hook('commit', ({ component, respond }) => {
               const pgbar = document.getElementById('pgbar');
               component.name == 'inv-areas' ? pgbar.classList.remove('hidden') : false;
               respond(() => {
                   component.name == 'inv-areas' ? pgbar.classList.add('hidden') : false;
               });
           });
           Livewire.hook('element.init', ({ component }) => {
                const n = component.name;
                if (n == 'inv-areas-create' || n == 'inv-areas-edit') {
                    const i = component.el.getElementsByTagName('input');
                    i.length > 0 ? i[0].focus() : false;
                }
            });
       });
   </script>
</div>
