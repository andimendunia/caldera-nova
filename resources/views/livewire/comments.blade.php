<div>
    <h1 class="text-xl text-neutral-900 dark:text-neutral-100">{{ __('Komentar').' '.'(0)'}}</h1>
    <textarea class="block w-full border-neutral-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 focus:border-caldy-500 dark:focus:border-caldy-600 focus:ring-caldy-500 dark:focus:ring-caldy-600 rounded-md shadow-sm"></textarea>
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
            <div class="absolute bottom-0 left-0">
                <livewire:user-select />
            </div>
        </div>
        <textarea name="comment" x-ref="comment" x-on:input="updateUserq"></textarea>
        <button type="button" x-on:click="replaceWord">REPLACE</button>
        <p>Current word (if starts with '@'): <span x-text="userq"></span></p>
    </div>
</div>
