<nav class="w-full bg-gradient-to-b from-gray-900 to-gray-800 text-gray-300 p-3 rounded-xl border border-gray-700 shadow-2xl overflow-hidden">
    <!-- Animated background element -->
    <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-blue-500 to-purple-600 opacity-10"></div>

    <ul class="space-y-2 relative z-10">
        <!-- Dashboard -->
        <li>
            <a href="#" class="flex items-center gap-3 px-2 py-3 rounded-lg transition-all duration-300 group
                {{ request()->is('dashboard') ? 'bg-gray-700/50 shadow-inner border-l-4 border-blue-400' : 'hover:bg-gray-700/30' }}"
            >
                <span class="relative">
                    <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    @if(request()->is('dashboard'))
                        <span class="absolute -right-1 -top-1 w-2 h-2 bg-blue-400 rounded-full pulse-animation"></span>
                    @endif
                </span>
                <span class="font-medium group-hover:text-white transition-colors">Dashboard</span>
                @if(request()->is('dashboard'))
                    <span class="ml-auto text-xs px-2 py-0.5 rounded-full bg-blue-400/20 text-blue-300">Active</span>
                @endif
            </a>
        </li>

        <!-- Content Section -->
        <li>
            <div class="px-2 pt-6 pb-2 flex items-center gap-2 relative">
                <svg class="w-5 h-5 text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span class="text-xs font-bold uppercase tracking-wider text-purple-300">Content</span>
            </div>
            <ul class="mt-1 space-y-1 pl-2">
                <x-sb.sidebar.link
                    href="{{ route('cp.content.pages.index') }}"
                    :active="request()->routeIs('cp.content.pages.*')"
                    title="Pages"
                >
                    <x-slot:icon>
                        <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </x-slot:icon>
                </x-sb.sidebar.link>
                <x-sb.sidebar.link
                    href="{{ route('cp.content.modules.index') }}"
                    :active="request()->routeIs('cp.content.modules.*')"
                    title="Modules"
                >
                    <x-slot:icon>
                        <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                    </x-slot:icon>
                </x-sb.sidebar.link>
            </ul>
        </li>

        <!-- Settings Section -->
        <li>
            <div class="px-2 pt-6 pb-2 flex items-center gap-2 relative">
                <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-xs font-bold uppercase tracking-wider text-green-300">Settings</span>
            </div>
            <ul class="mt-1 space-y-1 pl-2">
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm rounded-lg transition-all
                        {{ request()->is('settings/preferences') ? 'bg-gray-700/50 text-white font-medium shadow-md' : 'hover:bg-gray-700/30 text-gray-400 hover:text-gray-200' }}">
                        <span class="relative flex items-center justify-center">
                            <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                            @if(request()->is('settings/preferences'))
                                <span class="absolute -right-1 -top-1 w-2 h-2 bg-blue-400 rounded-full"></span>
                            @endif
                        </span>
                        Preferences
                        @if(request()->is('settings/preferences'))
                            <svg class="ml-auto w-4 h-4 text-blue-400 animate-bounce-x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm rounded-lg transition-all
                        {{ request()->is('settings/profile') ? 'bg-gray-700/50 text-white font-medium shadow-md' : 'hover:bg-gray-700/30 text-gray-400 hover:text-gray-200' }}">
                        <span class="relative flex items-center justify-center">
                            <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            @if(request()->is('settings/profile'))
                                <span class="absolute -right-1 -top-1 w-2 h-2 bg-blue-400 rounded-full"></span>
                            @endif
                        </span>
                        Profile
                        @if(request()->is('settings/profile'))
                            <svg class="ml-auto w-4 h-4 text-blue-400 animate-bounce-x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<style>
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.3; }
        100% { opacity: 1; }
    }
    .animate-bounce-x {
        animation: bounce-x 1.5s infinite;
    }
    .animate-bounce-y {
        animation: bounce-y 1.5s infinite;
    }
    @keyframes bounce-x {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(4px); }
    }
    @keyframes bounce-y {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(4px); }
    }
</style>
