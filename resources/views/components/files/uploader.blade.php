@props([
    'name' => '',
    'value' => null,
    'accept' => '.svg,.png,.jpg,.jpeg,.gif',
    'hint' => 'SVG, PNG, JPG, or GIF (Max 800x400px)',
    'multiple' => false,
])

<div
    x-data="fileUpload()"
    x-init="preview = '{{ $value ? asset($value) : '' }}'"
    {{ $attributes }}
>
    <p class="text-xs text-gray-500 dark:text-gray-400">
        {{ $hint }}
    </p>

    <p x-show="file" class="text-sm text-gray-700 dark:text-gray-300">
        Selected: <span x-text="file?.name"></span>
    </p>

    <div
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dropFile($event)"
        class="relative w-full h-[156px] border-2 border-dashed rounded-lg p-6 transition-colors duration-200 group"
        :class="{ 'border-blue-500 bg-blue-50 dark:bg-blue-900/20': dragging, 'border-gray-300 dark:border-gray-600': !dragging, 'border-none': preview }"
        :style="preview && { 'background-image': `url(${preview})`, 'background-size': 'cover', 'background-position': 'center', 'background-repeat': 'no-repeat' }"
    >
        <input
            type="file"
            name="{{ $name }}"
            @change="changeFile($event)"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
            accept="{{ $accept }}"
            x-ref="fileInput"
            {{ $multiple ? 'multiple' : '' }}
        />

        <div class="h-full flex flex-col gap-2 justify-center items-center cursor-pointer">
            <div class="p-2 border-2 border-transparent rounded-full group-hover:border-indigo-600 duration-150 bg-gray-700 w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </div>

            <span x-show="!preview">Drag and drop your file here</span>
            <span x-show="!preview" class="text-sm text-gray-400">or click to browse files</span>
        </div>
    </div>

    @push('scripts')
        <script>
            function fileUpload() {
                return {
                    dragging: false,
                    preview: null,
                    file: null,
                    uploaderFiles: [],
                    multiple: @json($multiple),

                    dropFile(event) {
                        this.dragging = false;

                        this.processFiles(
                            Array.from(event.dataTransfer.files)
                        );
                    },

                    changeFile(event) {
                        this.processFiles(
                            Array.from(event.target.files)
                        );
                    },

                    processFiles(fileList) {
                        const files = Array.from(fileList);
                        if (!files.length) return;

                        if (this.multiple) {
                            this.handleMultipleFiles(files);
                        } else {
                            this.updateFileInput(files);
                            this.handleSingleFile(files[0]);
                        }
                    },

                    updateFileInput(files) {
                        const dataTransfer = new DataTransfer();
                        files.forEach(file => dataTransfer.items.add(file));
                        this.$refs.fileInput.files = dataTransfer.files;
                    },

                    handleMultipleFiles(files) {
                        files.forEach(file => {
                            const reader = new FileReader();
                            reader.onload = ({ target }) => {
                                this.$dispatch('multiple:file-added', {
                                    file,
                                    preview: file.type.startsWith('image/') ? target.result : null,
                                    id: crypto.randomUUID()
                                });
                            };
                            reader.readAsDataURL(file);
                        });
                    },

                    handleSingleFile(file) {
                        if (!file.type.startsWith('image/')) {
                            this.preview = null;
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = ({ target }) => {
                            this.preview = target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        </script>
    @endpush
</div>
