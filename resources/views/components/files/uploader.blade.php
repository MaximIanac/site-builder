@props([
    'name' => 'example',
    'value' => null,
    'accept' => '.svg,.png,.jpg,.jpeg,.gif',
    'hint' => 'SVG, PNG, JPG, or GIF (Max 800x400px)'
])

<div
    x-data="fileUpload()"
    x-init="preview = '{{ $value ? asset($value) : '' }}'"
    {{ $attributes }}
>
    <p class="text-xs text-gray-500 dark:text-gray-400">
        {{ $hint }}
    </p>

    <div>
        <span x-show="!file">Drag and drop your file here</span>
    </div>

    <p x-show="file" class="text-sm text-gray-700 dark:text-gray-300">
        Selected: <span x-text="file?.name"></span>
    </p>

    <div
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dropFile($event)"
        class="relative w-full h-32 border-2 border-dashed rounded-lg p-6 transition-colors duration-200 group"
        :class="{ 'border-blue-500 bg-blue-50 dark:bg-blue-900/20': dragging, 'border-gray-300 dark:border-gray-700': !dragging, 'border-none': preview }"
        :style="preview && { 'background-image': `url(${preview})`, 'background-size': 'cover', 'background-position': 'center', 'background-repeat': 'no-repeat' }"
    >
        <input
            type="file"
            name="{{ $name }}"
            @change="changeFile($event)"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
            accept="{{ $accept }}"
            x-ref="fileInput"
        />

        <div @click="$refs.fileInput.click()" class="h-full flex justify-center items-center cursor-pointer">
            <div class="w-10 p-2 bg-bg-secondary rounded-full group-hover:scale-75 duration-75">
                <svg
                    class="mx-auto h-6 w-6 text-text-secondary"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 16V8m0 0l-4 4m4-4l4 4m6-8v12m0 0l-4-4m4 4l4-4"
                    />
                </svg>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function fileUpload() {
                return {
                    dragging: false,
                    file: null,
                    preview: null,
                    dropFile(event) {
                        this.dragging = false;
                        this.file = event.dataTransfer.files[0];
                        this.loadPreview(this.file);
                    },
                    changeFile(event) {
                        this.file = event.target.files[0];
                        this.loadPreview(this.file);
                    },
                    loadPreview(file) {
                        if (file && file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.preview = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        } else {
                            this.preview = null;
                        }
                    },
                }
            }
        </script>
    @endpush
</div>
