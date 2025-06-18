@props([
    'type' => 'success', // success, error, warning, info, custom
    'position' => 'bottom-right', // top-left, top-right, bottom-left, bottom-right, center
    'message' => '',
    'title' => '',
    'icon' => true,
    'dismissible' => true,
    'timeout' => 4000, // ms
    'border' => true,
    'shadow' => 'medium',
    'animation' => 'slide', // fade, slide, none
    'customColor' => null, // для type='custom'
])

@php
    $colorSchemes = [
        'success' => [
            'bg' => 'bg-green-50 dark:bg-green-900/30',
            'text' => 'text-green-800 dark:text-green-200',
            'border' => 'border-green-200 dark:border-green-800',
            'icon' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>'
        ],
        'error' => [
            'bg' => 'bg-red-50 dark:bg-red-900/30',
            'text' => 'text-red-800 dark:text-red-200',
            'border' => 'border-red-200 dark:border-red-800',
            'icon' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>'
        ],
        'warning' => [
            'bg' => 'bg-yellow-50 dark:bg-yellow-900/30',
            'text' => 'text-yellow-800 dark:text-yellow-200',
            'border' => 'border-yellow-200 dark:border-yellow-800',
            'icon' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>'
        ],
        'info' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/30',
            'text' => 'text-blue-800 dark:text-blue-200',
            'border' => 'border-blue-200 dark:border-blue-800',
            'icon' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>'
        ],
        'custom' => [
            'bg' => $customColor ? "bg-{$customColor}-50 dark:bg-{$customColor}-900/30" : 'bg-gray-50 dark:bg-gray-900/30',
            'text' => $customColor ? "text-{$customColor}-800 dark:text-{$customColor}-200" : 'text-gray-800 dark:text-gray-200',
            'border' => $customColor ? "border-{$customColor}-200 dark:border-{$customColor}-800" : 'border-gray-200 dark:border-gray-800',
            'icon' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>'
        ]
    ];

    $positions = [
        'top-left' => 'top-4 left-4',
        'top-right' => 'top-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'bottom-right' => 'bottom-4 right-4',
        'center' => 'top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2'
    ];

    $shadows = [
        'none' => '',
        'small' => 'shadow-sm',
        'medium' => 'shadow-md',
        'large' => 'shadow-lg',
        'xl' => 'shadow-xl'
    ];

    $animations = [
        'fade' => 'transition-opacity duration-300 ease-in-out',
        'slide' => 'transition-all duration-500 ease-in-out',
        'bounce' => 'animate-bounce',
        'none' => ''
    ];

    $scheme = $colorSchemes[$type] ?? $colorSchemes['success'];
    $posClass = $positions[$position] ?? $positions['top-right'];
    $shadowClass = $shadows[$shadow] ?? $shadows['medium'];
    $animationClass = $animations[$animation] ?? $animations['fade'];
    $borderClass = $border ? 'border ' . $scheme['border'] : '';
@endphp

<div
    x-data="{
        show: false,
        toCloseTimeout: {{ $timeout }},
        init() {
            setTimeout(() => {
                this.show = true;

                if (this.toCloseTimeout) {
                    setTimeout(() => {
                        this.hide();
                    }, this.toCloseTimeout);
                }
            }, 200);
        },
        hide() {
            this.show = false;
        }
    }"
    x-show="show"
    x-cloak
    x-transition:enter="{{ $animation === 'slide' ? 'transform ease-out duration-100 transition' : 'transition ease-in duration-200' }}"
    x-transition:enter-start="{{ $animation === 'slide' ?
        ($position === 'top-right' || $position === 'bottom-right' ? 'translate-x-2 opacity-0' :
        ($position === 'top-left' || $position === 'bottom-left' ? '-translate-x-2 opacity-0' : 'opacity-0')) : 'opacity-0' }}"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed z-50 max-w-sm w-full sm:w-96 mx-4 {{ $posClass }}"
>
    <div @click="hide()" class="{{ $scheme['bg'] }} {{ $scheme['text'] }} {{ $borderClass }} {{ $shadowClass }} rounded-lg p-4 flex items-start cursor-pointer">
        @if($icon)
            <div class="flex-shrink-0 mt-0.5">
                {!! $scheme['icon'] !!}
            </div>
        @endif

        <div class="ml-3 w-0 flex-1 pt-0.5">
            @if($title)
                <p class="text-sm font-medium">
                    {{ $title }}
                </p>
            @endif
            <p class="text-sm">
                {{ $message }}
            </p>
        </div>

        @if($dismissible)
            <div class="ml-4 flex-shrink-0 flex">
                <button
                    @click="hide()"
                    class="inline-flex rounded-md focus:outline-none"
                >
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        @endif
    </div>
</div>
