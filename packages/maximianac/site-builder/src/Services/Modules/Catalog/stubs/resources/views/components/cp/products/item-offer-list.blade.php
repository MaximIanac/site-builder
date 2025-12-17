@props([
    'variant' => [],
    'propertyValues' => [],
])

<div x-data="{ open: false }" @click.outside="open = false" class="relative">
    <button
        @click.stop="open = !open"
        class="p-2 bg-bg-secondary transition-transform duration-200 rounded-full"
        :class="{'rounded-full' : !open, 'bg-b-secondary rounded-t-full' : open}"
        title="View Details"
    >
        <x-icons.arrow class="w-6 h-6 text-accent-primary" />
    </button>
    <div
        x-show="open"
        x-cloak
        x-transition
        class="absolute top-full right-0 bg-gradient-to-br from-bg-primary to-bg-secondary rounded-2xl rounded-tr-none shadow-2xl p-5 w-96 z-20 border-2 border-b-secondary"
    >
        <div class="mb-4">
            <h4 class="text-sm font-semibold text-text-primary mb-2">Properties</h4>
            <div class="grid grid-cols-2 gap-x-8 gap-y-1 text-xs text-text-secondary bg-bg-primary/50 rounded-lg p-1">
                @foreach($propertyValues as $value)
                    <div class="flex justify-between">
                        <span class="text-text-primary font-semibold">{{ $value->property->name }}:</span>
                        <span>{{ $value->value }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            <h4 class="text-sm mb-2 font-semibold text-text-primary">Offers</h4>
            <div class="space-y-3 max-h-40 overflow-y-auto pr-1">
                @foreach($offers as $offer)
                    <div class="rounded-xl border border-b-secondary bg-white/5 shadow p-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-sm font-semibold text-accent-primary">
                                ${{ number_format($offer->price, 2) }}
                            </div>
                            <span class="text-xs bg-muted px-2 py-0.5 rounded text-muted-foreground">Stock: {{ $offer->quantity }}</span>
                        </div>
                        <div class="border-t border-b-secondary pt-2 text-xs space-y-1">
                            @foreach($offer->propertyValues as $value)
                                <div class="flex justify-between text-muted-foreground">
                                    <span class="capitalize">{{ $value->property->name }}</span>
                                    <span class="text-right text-text-primary">{{ $value->value }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
