<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-text-secondary">Title <span class="text-red-500">*</span></label>
    <x-text-input name="title" class="w-full" value="{{ old('title', $page->title ?? '') }}"  />
    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="slug" class="block text-sm font-medium text-text-secondary">Slug</label>
    <x-text-input name="slug" class="w-full dark:text-gray-500 text-sm font-mono" value="{{ old('slug', $page->slug ?? '') }}" />
    @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>


<div class="mb-4">
    <label for="slug" class="block text-sm font-medium text-text-secondary">Template</label>

    <div x-data="{ selectedTemplate: '{{ old('template', $page->template ?? '') }}', setTemplate(value) { this.selectedTemplate = value; this.$refs.input.value = value; this.$dispatch('close'); } }">
        <div x-show="selectedTemplate" class="my-2 text-sm text-text-primary">
            Selected: <span class="font-bold text-b-primary" x-text="selectedTemplate"></span>
        </div>

        <input type="hidden" name="template" x-ref="input" x-model="selectedTemplate">

        <x-secondary-button
            type="button"
            class="w-full text-center"
            x-on:click="$dispatch('open-modal', 'template-list-modal')"
        >
            Choose
        </x-secondary-button>

        <x-modal name="template-list-modal" maxWidth="2xl">
            <div class="p-4">
                <h5>Templates</h5>

                <hr class="my-4">

                <ul class="mb-4">
                    @foreach ($templates as $template)
                        <li class="font-bold">{{ $template['name'] }}</li>
                        <ul class="pl-4 text-text-primary">
                            @foreach ($template['templates'] as $file)
                                <li>
                                    <button
                                        type="button"
                                        class="text-b-primary hover:underline"
                                        x-on:click="selectedTemplate = '{{ $template['value'] . '.' . $file }}'; $dispatch('close')"
                                    >
                                        - {{ $file }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </ul>

                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    Close
                </x-secondary-button>
            </div>
        </x-modal>
    </div>
</div>
