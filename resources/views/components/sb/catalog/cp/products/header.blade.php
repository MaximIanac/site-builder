<div class="flex justify-between items-center mb-2 gap-6">
    <div class="relative flex-1">
        <x-inputs.search placeholder="Search products..." class="w-full" />
    </div>
    <a href="{{ route('cp.content.modules.catalog.products.create') }}" class="cursor-pointer px-4 py-2 bg-gradient-to-r from-accent-primary to-accent-secondary text-white rounded-full hover:from-accent-secondary hover:to-accent-secondary transition-all duration-150 flex items-center gap-2 text-sm shadow-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Product
    </a>
</div>
