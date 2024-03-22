<div>
    <button @click="darkMode = !darkMode; $wire.toggleTheme()" class="focus:outline-none">
        <span x-show="!darkMode">🌞</span>
        <span x-show="darkMode">🌜</span>
    </button>
</div>
