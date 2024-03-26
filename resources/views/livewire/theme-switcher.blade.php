<div x-data="window.themeSwitcher()" x-init="switchTheme()" @keydown.window.tab="switchOn = false" class="fixed bottom-4 right-4">
    <div class="flex items-center justify-center p-2 space-x-2 bg-white rounded-full shadow-lg dark:bg-gray-800">
        <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">

        <button
            x-ref="switchButton"
            type="button"
            @click="switchOn = ! switchOn; switchTheme()"
            :class="switchOn ? 'bg-blue-600' : 'bg-gray-300'"
            class="relative inline-flex items-center justify-center h-8 w-14 py-0.5 focus:outline-none rounded-full transition duration-300 ease-in-out"
        >
            <span class="absolute left-0.5 top-0.5 w-7 h-7 bg-white rounded-full shadow-md transition duration-300 ease-in-out flex items-center justify-center" :class="switchOn ? 'translate-x-6' : ''">
                <span x-show="switchOn">🌙</span>
                <span x-show="!switchOn">☀️</span>
            </span>
        </button>

        <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
            :class="{ 'text-blue-600': switchOn, 'text-gray-400': ! switchOn }"
            class="text-sm font-medium transition duration-300 ease-in-out select-none"
        >
        <div class="hidden lg:block">
            <span x-show="!switchOn">Light</span>
            <span x-show="switchOn">Dark</span>
        </div>
        </label>
    </div>
</div>
