<script setup>
import {onBeforeUnmount, ref, watch} from 'vue'
import {Button} from "@/components/ui/button/index.js";
import {Badge} from "@/components/ui/badge/index.js";

const props = defineProps({
    modelValue: {
        type: Array,
        default: () => []
    },
    maxFiles: {
        type: Number,
        default: 10
    },
    maxFileSize: {
        type: Number,
        default: 5 * 1024 * 1024 // 5MB
    },
    acceptedTypes: {
        type: String,
        default: 'image/jpeg,image/png,image/webp'
    },
    helpText: {
        type: String,
        default: 'Первое фото будет главным в галерее'
    },
    required: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['update:modelValue'])

const files = ref([])
const fileInput = ref(null)
const isDragging = ref(false)
const viewingIndex = ref(null)
const dragIndex = ref(null)

watch(() => props.modelValue, (newValue) => {
    if (newValue.length === 0) {
        files.value = []
    }
}, { immediate: true })

const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes'
    const k = 1024
    const sizes = ['Bytes', 'KB', 'MB', 'GB']
    const i = Math.floor(Math.log(bytes) / Math.log(k))
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

// Триггер выбора файла
const triggerFileInput = () => {
    fileInput.value?.click()
}

// Обработка выбора файлов
const handleFileSelect = (event) => {
    const selectedFiles = Array.from(event.target.files)
    addFiles(selectedFiles)
    event.target.value = '' // Сброс input
}

// Добавление файлов
const addFiles = (fileList) => {
    const remainingSlots = props.maxFiles - files.value.length
    const filesToAdd = fileList.slice(0, remainingSlots)

    filesToAdd.forEach(file => {
        if (file.size > props.maxFileSize) {
            alert(`Файл ${file.name} превышает максимальный размер ${formatFileSize(props.maxFileSize)}`)
            return
        }

        const reader = new FileReader()
        reader.onload = (e) => {
            files.value.push({
                id: Date.now() + Math.random(),
                file: file,
                name: file.name,
                size: file.size,
                type: file.type,
                preview: e.target.result,
                lastModified: file.lastModified
            })
            emitUpdate()
        }
        reader.readAsDataURL(file)
    })
}

const handleDragOver = () => {
    if (files.value.length < props.maxFiles) {
        isDragging.value = true
    }
}

const handleDragLeave = () => {
    isDragging.value = false
}

const handleDrop = (event) => {
    isDragging.value = false
    const droppedFiles = Array.from(event.dataTransfer.files).filter(file =>
        file.type.startsWith('image/')
    )
    addFiles(droppedFiles)
}

// Удаление файла
const removeFile = (index) => {
    URL.revokeObjectURL(files.value[index].preview)
    files.value.splice(index, 1)
    emitUpdate()
}

// Очистка всех файлов
const clearAll = () => {
    files.value.forEach(file => {
        URL.revokeObjectURL(file.preview)
    })
    files.value = []
    emitUpdate()
}

// Сделать главным
const makePrimary = (index) => {
    const file = files.value.splice(index, 1)[0]
    files.value.unshift(file)
    emitUpdate()
}

// Просмотр изображения
const viewImage = (index) => {
    viewingIndex.value = index
}

const closeViewer = () => {
    viewingIndex.value = null
}

// Drag & Drop для сортировки
const handleDragStart = (index) => {
    dragIndex.value = index
}

const handleDropReorder = (dropIndex) => {
    if (dragIndex.value === null || dragIndex.value === dropIndex) return

    const draggedItem = files.value.splice(dragIndex.value, 1)[0]
    files.value.splice(dropIndex, 0, draggedItem)

    dragIndex.value = null
    emitUpdate()
}

// Эмит обновления
const emitUpdate = () => {
    const fileObjects = files.value.map(f => f.file)
    emit('update:modelValue', fileObjects)
}

// Очистка при размонтировании
onBeforeUnmount(() => {
    files.value.forEach(file => {
        URL.revokeObjectURL(file.preview)
    })
})
</script>

<template>
    <div class="space-y-4">
        <input
            ref="fileInput"
            type="file"
            multiple
            :accept="acceptedTypes"
            @change="handleFileSelect"
            class="hidden"
        />

        <!-- GALLERY HEADER -->
        <div class="flex justify-between">
            <div class="space-y-1.5">
                <label class="text-sm font-medium leading-none">
                    Gallery
                </label>
                <p v-if="helpText" class="text-sm text-muted-foreground">{{ helpText }}</p>
            </div>

            <div class="flex items-end gap-8">
                    <span class="text-xs text-muted-foreground">
                      Uploaded: {{ files.length }}{{ maxFiles ? ` / ${maxFiles}` : '' }}
                    </span>
                <div class="space-x-2">
                    <Button
                        type="button"
                        variant="outline"
                        v-if="!files.length || files.length < maxFiles"
                        @click.stop="triggerFileInput"

                    >
                        + add
                    </Button>
                    <Button
                        type="button"
                        variant="secondary"
                        @click="clearAll"
                        v-if="files.length"
                    >
                        Clear All
                    </Button>
                </div>
            </div>
        </div>

        <!-- GALLERY DnD -->
        <div
            v-if="!files.length"
            @click="triggerFileInput"
            @dragover.prevent="handleDragOver"
            @dragleave.prevent="handleDragLeave"
            @drop.prevent="handleDrop"
            :class="[
                'border border-dashed rounded-lg p-8 text-center cursor-pointer transition-colors',
                isDragging ? 'border-primary bg-primary/5' : 'border-input hover:border-primary hover:bg-accent'
            ]"
        >
            <div class="max-w-xs mx-auto space-y-4">
                <div class="flex justify-center">
                    <svg class="h-12 w-12 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium mb-1">Add photo</p>
                    <p class="text-sm text-muted-foreground">Drag and drope or click to select the images</p>
                    <p class="text-xs text-muted-foreground mt-2">JPG, PNG, WEBP until {{ maxFileSize / 1024 / 1024 }} MB</p>
                </div>
            </div>
        </div>

        <!-- GALLERY PHOTO GRID -->
        <div v-if="files.length > 0" class="space-y-4">
            <div class="flex flex-wrap gap-4">
                <div
                    v-for="(file, index) in files"
                    :key="file.id"
                    class="group relative overflow-hidden rounded-lg border bg-card"
                >
                    <Badge v-if="index === 0" class="absolute left-2 top-2 z-10">Main</Badge>

                    <img
                        :src="file.preview"
                        :alt="file.name"
                        class="h-40 w-auto object-cover transition-transform group-hover:scale-105"
                    />

                    <div
                        @dragstart="handleDragStart(index)"
                        @dragover.prevent
                        @drop.prevent="handleDropReorder(index)"
                        draggable="true"
                        class="absolute inset-0 bg-black/40 opacity-0 transition-opacity group-hover:opacity-100 cursor-move"
                    >
                        <div class="flex h-full items-center justify-center space-x-2">
                            <!-- Посмотреть -->
                            <button
                                @click.stop="viewImage(index)"
                                type="button"
                                class="rounded-full bg-white/20 p-2 text-white hover:bg-white/30"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>

                            <!-- Сделать главным -->
                            <button
                                v-if="index !== 0"
                                @click.stop="makePrimary(index)"
                                type="button"
                                class="rounded-full bg-white/20 p-2 text-white hover:bg-white/30"
                                title="Сделать главным"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>

                            <!-- Удалить -->
                            <button
                                @click.stop="removeFile(index)"
                                type="button"
                                class="rounded-full bg-destructive/80 p-2 text-white hover:bg-destructive"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-2">
                        <p class="truncate text-xs text-white">{{ file.name }}</p>
                        <p class="text-xs text-gray-300">{{ formatFileSize(file.size) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- GALLERY PHOTO PREVIEW -->
        <div
            v-if="viewingIndex !== null"
            @click="closeViewer"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
        >
            <div @click.stop class="relative max-h-[80vh] max-w-[80vw]">
                <button
                    @click="closeViewer"
                    class="absolute -right-15 top-0 rounded-full bg-white/20 p-2 text-white hover:bg-white/30"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <img
                    :src="files[viewingIndex].preview"
                    :alt="files[viewingIndex].name"
                    class="max-h-[80vh] max-w-[80vw] object-contain"
                />
                <div class="absolute -bottom-15 left-1/2 flex -translate-x-1/2 space-x-2">
                    <button
                        v-if="viewingIndex > 0"
                        @click.stop="viewingIndex--"
                        class="rounded-full bg-white/20 p-2 text-white hover:bg-white/30"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button
                        v-if="viewingIndex < files.length - 1"
                        @click.stop="viewingIndex++"
                        class="rounded-full bg-white/20 p-2 text-white hover:bg-white/30"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
