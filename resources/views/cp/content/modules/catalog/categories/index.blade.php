@extends('layouts.cp.app')

@section('title', 'Catalog Categories')

@section('content')
    <div x-data="categoryTreeManager()">
        <x-sb.common.wrappers.cp-default>
            <h2 class="text-xl mb-4">Root categories</h2>
            <div class="flex flex-wrap gap-3">
                @foreach($rootCategories as $category)
                    <button
                        @click="loadChildren({{ $category->id }})"
                        class="inline-flex items-center bg-bg-primary border-2 border-b-primary rounded-full px-4 py-2 text-sm font-medium text-text-secondary hover:bg-indigo-600 hover:shadow-md transition-all"
                        :class="{ 'bg-indigo-600 text-white': activeCategory === {{ $category->id }} }"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </x-sb.common.wrappers.cp-default>

        <div x-show="!activeCategory" x-cloak class="flex items-center justify-center h-36">
            <span class="text-gray-700 font font-mono uppercase">Select root category</span>
        </div>

        <!-- Children display area -->
        <div x-show="!loading && childCategories.length > 0" x-cloak class="space-y-2">
            <x-sb.common.wrappers.cp-default class="mt-6 flex gap-6">
                <div class="w-1/4 flex flex-col gap-3 border-r border-gray-700 pr-6">
                    <template x-for="category in childCategories" :key="category.id">
                        <button type="button" class="flex items-center px-4 py-3 bg-bg-primary rounded-lg border border-indigo-600 hover:border-indigo-700 transition-colors duration-200">
                            <span x-text="category.name" class="text-text-secondary font-medium"></span>
                            <span class="ml-auto text-sm text-gray-500">ID: <span x-text="category.id" class="font-mono"></span></span>
                        </button>
                    </template>
                </div>

                <div class="flex-1">
                    test
                </div>
            </x-sb.common.wrappers.cp-default>
        </div>
    </div>

    <script>
        function categoryTreeManager() {
            return {
                activeCategory: null,
                activeCategoryName: '',
                rootCategories: @json($rootCategories),
                childCategories: [],
                loading: false,

                async loadChildren(categoryId) {
                    if (categoryId === this.activeCategory) return;
                    const chosenRoot = this.rootCategories.find((item) => item.id === categoryId)

                    this.loading = true;

                    this.activeCategory = chosenRoot.id;
                    this.activeCategoryName = chosenRoot.name;

                    const ajax = useAjax();
                    await ajax.get('{{ route('api.cp.content.modules.catalog.categories.childCategories') }}', {category: chosenRoot.id})
                    this.loading = false;

                    this.childCategories = ajax.state.data.data.categories

                    console.log(this.childCategories)
                },

                toggleChildren(category) {
                    return
                }
            }
        }
    </script>
@endsection
