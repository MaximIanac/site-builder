<script setup>
import {computed, onBeforeUnmount, onMounted, ref, watch} from 'vue'
import {Button} from "@/components/ui/button/index.js";
import {Badge} from "@/components/ui/badge/index.js";
import { Image, Eye, Star, Trash2, X, ArrowBigLeft, ArrowBigRight, Plus, ArchiveRestore } from 'lucide-vue-next';
import {getErrorMessages} from "@/lib/utils.js";
import {FieldError} from "@/components/ui/field/index.js";

const props = defineProps({
    modelValue: {
        type: Object,
        default: () => [],
        required: true,
    },
    errors: {
        type: Array,
    },
    maxFiles: {
        type: Number,
        default: 10
    },
    maxFileSize: {
        type: Number,
        default: 25 * 1024 * 1024 // 25MB
    },
    acceptedTypes: {
        type: String,
        default: 'image/jpeg,image/png,image/webp'
    },
    helpText: {
        type: String,
        default: 'First image will be the main'
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
const existingMedia = ref([])
const newFiles = ref([])

const errors = computed(() => props.errors)

onMounted(() => {
    initializeFiles()
})

const initializeFiles = () => {
    if (!props.modelValue || props.modelValue.length === 0) {
        files.value = []
        existingMedia.value = []
        newFiles.value = []

        return;
    }

    existingMedia.value = props.modelValue.map(
        media => ({
            ...media,
            isExisting: true,
            id: media.id,
            file: null,
            name: media.file_name || media.name,
            size: media.size,
            type: media.mime_type,
            preview: media.original_url,
            lastModified: null,
            originalData: {
                id: media.id,
                uuid: media.uuid,
                file_name: media.file_name,
                collection_name: media.collection_name
            }
        })
    )

    files.value = [...existingMedia.value]
}

// watch(() => props.modelValue, (newValue) => {
//     console.log(newValue)
//
// }, { immediate: true })

const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes'
    const k = 1024
    const sizes = ['Bytes', 'KB', 'MB', 'GB']
    const i = Math.floor(Math.log(bytes) / Math.log(k))
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const triggerFileInput = () => {
    fileInput.value?.click()
}

const handleFileSelect = (event) => {
    const selectedFiles = Array.from(event.target.files)
    addFiles(selectedFiles)
    event.target.value = ''
}

const addFiles = (fileList) => {
    const remainingSlots = props.maxFiles - files.value.length
    const filesToAdd = fileList.slice(0, remainingSlots)

    filesToAdd.forEach(file => {
        if (file.size > props.maxFileSize) {
            alert(`File ${file.name} exceeds maximum size ${formatFileSize(props.maxFileSize)}`)
            return
        }

        // const reader = new FileReader()
        // reader.onload = (e) => {
            const fileObject = {
                id: Date.now() + Math.random(),
                file: file,
                name: file.name,
                size: file.size,
                type: file.type,
                preview: URL.createObjectURL(file),
                lastModified: file.lastModified,
                isExisting: false,
            }
        // }

        files.value.push(fileObject)
        newFiles.value.push(fileObject)
        emitUpdate()
        // reader.readAsDataURL(file)
    })
}

const removeFile = (index) => {
    const fileToRemove = files.value[index]

    if (fileToRemove.isExisting) {
        fileToRemove._destroy = true
        fileToRemove.markedForDeletion = true
    } else {
        files.value.splice(index, 1)
        newFiles.value = newFiles.value.filter(f => f.id !== fileToRemove.id)

        if (fileToRemove.preview && fileToRemove.preview.startsWith('blob:')) {
            URL.revokeObjectURL(fileToRemove.preview)
        }
    }

    emitUpdate()
}

const restoreFile = (index) => {
    const file = files.value[index]
    if (!file.isExisting || !file.markedForDeletion) return;

    file._destroy = false
    file.markedForDeletion = false

    emitUpdate()
}

const clearAll = () => {
    // files.value.forEach(file => {
    //     URL.revokeObjectURL(file.preview)
    // })
    // files.value = []
    // emitUpdate()
}

const sortFiles = () => {
    files.value.sort((a, b) => {
        if (a.markedForDeletion && b.markedForDeletion) return 0
        if (a.markedForDeletion) return 1
        if (b.markedForDeletion) return -1

        return a.originalIndex - b.originalIndex
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

const makePrimary = (index) => {
    const file = files.value.splice(index, 1)[0]
    files.value.unshift(file)
    emitUpdate()
}

const viewImage = (index) => {
    viewingIndex.value = index
}

const closeViewer = () => {
    viewingIndex.value = null
}

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

const emitUpdate = () => {
    sortFiles();

    emit('update:modelValue', files.value)
}

onBeforeUnmount(() => {
    files.value.forEach(file => {
        URL.revokeObjectURL(file.preview)
    })
})
</script>

<template>
    <div class="space-y-2">
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
                <label class="text-base font-semibold leading-none">
                    Gallery
                </label>
                <p v-if="helpText" class="text-sm text-muted-foreground">{{ helpText }}</p>
            </div>

            <div class="flex items-end gap-8">
                <span class="text-xs text-muted-foreground">
                  Uploaded: {{ files.length }}{{ maxFiles ? ` / ${maxFiles}` : '' }}
                </span>

                <div class="flex items-center gap-2">
                    <Button
                        type="button"
                        variant="outline"
                        v-if="!files.length || files.length < maxFiles"
                        @click.stop="triggerFileInput"

                    >
                        <Plus /> add
                    </Button>
<!--                    <Button-->
<!--                        type="button"-->
<!--                        variant="secondary"-->
<!--                        @click="clearAll"-->
<!--                        v-if="files.length"-->
<!--                    >-->
<!--                        Clear All-->
<!--                    </Button>-->
                </div>
            </div>
        </div>

        <FieldError :errors="errors.map(i => ({message: i}))" />

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
                    <Image class="size-8" />
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
                    <Badge v-if="index === 0 && !file.markedForDeletion" class="absolute left-2 top-2 z-10">Main</Badge>

                    <img
                        :src="file.preview"
                        :alt="file.name"
                        class="h-40 w-full object-cover transition-transform"
                        :class="[
                            file.markedForDeletion
                                ? 'opacity-50 grayscale blur-[1px] cursor-not-allowed'
                                : 'group-hover:scale-105'
                        ]"
                    />

                    <div
                        v-if="file.markedForDeletion"
                        class="absolute inset-0 pointer-events-none"
                    >
                        <div
                            class="absolute inset-0 opacity-[0.03]"
                            style="background: repeating-linear-gradient(45deg, #9ca3af, #9ca3af 1px, transparent 1px, transparent 10px);"
                        ></div>

                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/40 flex items-center justify-center pointer-events-auto">
                            <Button
                                @click.stop="restoreFile(index)"
                                type="button"
                                class="rounded-full !px-2"
                                variant="secondary"
                            >
                                <ArchiveRestore class="size-5" />
                            </Button>
                        </div>
                    </div>

                    <div
                        v-if="!file.markedForDeletion"
                        @dragstart="handleDragStart(index)"
                        @dragover.prevent
                        @drop.prevent="handleDropReorder(index)"
                        draggable="true"
                        class="absolute inset-0 bg-black/40 opacity-0 transition-opacity group-hover:opacity-100 cursor-move"
                    >
                        <div class="flex h-full items-center justify-center space-x-2">
                            <Button
                                @click.stop="viewImage(index)"
                                type="button"
                                class="rounded-full !px-2"
                                variant="outline"
                            >
                                <Eye class="size-5"/>
                            </Button>

                            <Button
                                v-if="index !== 0"
                                @click.stop="makePrimary(index)"
                                type="button"
                                class="rounded-full !px-2"
                                variant="outline"
                                title="Make main"
                            >
                                <Star class="size-5" />
                            </Button>

                            <Button
                                @click.stop="removeFile(index)"
                                type="button"
                                class="rounded-full !px-2"
                                variant="destructive"
                            >
                                <Trash2 class="size-5" />
                            </Button>
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
            <div @click.stop>
                <Button
                    @click="closeViewer"
                    type="button"
                    variant="secondary"
                    class="absolute right-25 top-15 rounded-full !px-2"
                >
                    <X class="size-6"/>
                </Button>
                <img
                    :src="files[viewingIndex].preview"
                    :alt="files[viewingIndex].name"
                    class="max-h-[80vh] max-w-[80vw] object-contain"
                    :class="{'grayscale blur-[1px] cursor-not-allowed' : files[viewingIndex].markedForDeletion}"
                />

                <div v-if="files[viewingIndex].markedForDeletion" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-[-45deg]">
                    <span class="text-7xl font-mono font-bold tracking-[.8em] text-neutral-500/50 select-none border-4 border-neutral-500/50 p-8 rounded-lg cursor-not-allowed">
                        REMOVED
                    </span>
                </div>

                <div class="absolute bottom-10 left-1/2 flex -translate-x-1/2 space-x-2">
                    <Button
                        @click.stop="viewingIndex--"
                        :disabled="viewingIndex < 1"
                        type="button"
                        variant="secondary"
                        class="rounded-full !px-2"
                    >
                        <ArrowBigLeft class="size-6"/>
                    </Button>
                    <Button
                        @click.stop="viewingIndex++"
                        :disabled="viewingIndex === files.length - 1"
                        type="button"
                        variant="secondary"
                        class="rounded-full !px-2"
                    >
                        <ArrowBigRight class="size-6"/>
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>
