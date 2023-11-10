<div x-data="{ buttons: false }"  x-on:click.away="buttons = false" class="pb-32">
    <div class="flex w-full items-center justify-between mb-4">
        <h1 >{{ __('Komentar').' '.'(0)'}}</h1>
        <x-text-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-uom')">
            <i class="far fa-question-circle"></i>
        </x-text-button>
    </div>
    <div x-data="{ userq: @entangle('userq').live, updateUserq: function(event) { 
        const textarea = event.target;
        const word = this.getWordAtPosition(textarea);
    
        if (word.startsWith('@')) {
            this.userq = word.substring(1); // Removing '@' from the word
        } else {
            this.userq = '';
        }
    }, getWordAtPosition: function(textarea) {
        const value = textarea.value;
        const cursorPosition = textarea.selectionStart;
        const textBeforeCursor = value.slice(0, cursorPosition);
    
        const wordsArray = textBeforeCursor.split(/\s/);
        const lastWord = wordsArray[wordsArray.length - 1];
    
        return lastWord.trim(); // Trim to remove extra spaces
    }, replaceWord: function(event) {
        const textarea = this.$refs.comment;
        const value = textarea.value;
        const cursorPosition = textarea.selectionStart;
        const textBeforeCursor = value.slice(0, cursorPosition);
    
        const wordsArray = textBeforeCursor.split(/\s/);
        const lastWord = wordsArray[wordsArray.length - 1];
        const replacedWord = '@replaced '; // The word to replace with (keeping @)
    
        if (lastWord.startsWith('@')) {
            const replacedText = textBeforeCursor.slice(0, textBeforeCursor.length - lastWord.length) + replacedWord;
            const updatedText = replacedText + value.slice(cursorPosition);
            textarea.value = updatedText;
            this.userq = 'replaced'; // Update userq property
            this.$refs.comment.focus();
        }
    }}">
        <div class="relative">
            <div class="absolute flex w-full justify-center bottom-2 left-0">
                <livewire:user-select />
            </div>
        </div>
        <div class="relative mb-2">
            <textarea rows="1" name="comment" x-ref="comment"  x-on:focusin="buttons = true" x-on:input="updateUserq" placeholder="{{ __('Tulis komentar...') }}" style="min-height:66px;" class="w-full py-5 pl-14 border-transparent  dark:border-neutral-700 bg-transparent focus:bg-white dark:bg-neutral-900 dark:text-neutral-300 focus:border-caldy-500 dark:focus:border-caldy-600 focus:ring-caldy-500 dark:focus:ring-caldy-600 rounded-md focus:shadow-sm"></textarea>
            <div class="w-8 h-8 absolute top-4 left-3 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                @if(Auth::user()->photo)
                <img class="w-full h-full object-cover dark:brightness-75" src="/storage/users/{{ Auth::user()->photo }}" />
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                @endif
            </div>
        </div>
        <div x-show="buttons" x-cloak class="flex justify-between">
            <div class="text-sm ml-4">
                <x-text-button><i class="fa fa-paperclip mr-2"></i>{{ __('Lampirkan') }}</x-text-button>
            </div>
            <div>
                <x-secondary-button type="button" x-on:click="replaceWord">Replace</x-secondary-button>
                <x-primary-button type="submit">{{ __('Kirim') }}</x-primary-button>
            </div>
        </div>
    </div>
</div>
