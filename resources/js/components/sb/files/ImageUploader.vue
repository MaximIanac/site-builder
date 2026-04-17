<script setup>
import {computed, onBeforeUnmount, onMounted, ref, watch} from 'vue'
import {Button} from "@/components/ui/button/index.js";
import { Image, Eye, Star, Trash2, X, ArrowBigLeft, ArrowBigRight, Plus, ArchiveRestore } from 'lucide-vue-next';
import {ActionEnum} from "@/composables/services/normalizers/ActionEnum.js";
import useMediaNormalizer from "@/composables/services/normalizers/useMediaNormalizer.js";

const props = defineProps({
    id: {
        type: String,
    },
    isMultiple: {
        type: Boolean,
        default: false,
    },
    modelValue: {
        type: [Object, Array],
        default: () => {},
        required: true,
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
})

const emit = defineEmits(['update:modelValue'])

const files = ref([])
const fileInput = ref(null)
const isDragging = ref(false)
const viewingIndex = ref(null)
const existingMedia = ref([])
const newFiles = ref([])

onMounted(() => {
    initializeFiles()
})

const initializeFiles = () => {
    const media = props.modelValue

    if (!media || (typeof media === 'object' && Object.keys(media).length === 0)) {
        files.value = []
        existingMedia.value = []
        newFiles.value = []
        return;
    }

    if (!media?.uuid && media?.file) {
        addFiles([media.file])
        return;
    }

    existingMedia.value = media?.id ? [media] : []

    files.value = [...existingMedia.value]
}

watch(() => props.modelValue, (newFile) => {
    if (Object.keys(newFile).length === 0 && files.value.length > 0) {
        removeFile(0)
        return;
    }

    if (
        files.value.filter(item => item.action === ActionEnum.DELETED).length > 0
        && newFile.action === ActionEnum.EXISTING
    ) {
        restoreFile(0)
        return;
    }

    if (Object.keys(newFile).length === 0) {
        return;
    }

    files.value[0] = newFile;
})

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

        const fileObject = useMediaNormalizer().createMedia(file);

        files.value.push(fileObject)
        newFiles.value.push(fileObject)
        emitUpdate()
    })
}

const removeFile = (id) => {
    const fileToRemove = files.value.find(f => f.id === id)

    if (fileToRemove.isExisting) {
        fileToRemove.action = ActionEnum.DELETED
        return;
    } else {
        files.value.splice(index, 1)
        newFiles.value = newFiles.value.filter(f => f.id !== fileToRemove.id)

        if (fileToRemove.preview && fileToRemove.preview.startsWith('blob:')) {
            URL.revokeObjectURL(fileToRemove.preview)
        }
    }

    emitUpdate()
}

const restoreFile = (id) => {
    const file = files.value.find(f => f.id === id)

    if (!file.isExisting) return;

    file.action = file.isExisting
        ? ActionEnum.EXISTING
        : ActionEnum.NEW

    emitUpdate()
}

const sortFiles = () => {
    files.value.sort((a, b) => {
        const aDeleted = a.action === ActionEnum.DELETED
        const bDeleted = b.action === ActionEnum.DELETED

        if (aDeleted && bDeleted) return 0
        if (aDeleted) return 1
        if (bDeleted) return -1

        return (a.originalIndex ?? 0) - (b.originalIndex ?? 0)
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

const viewImage = (index) => {
    viewingIndex.value = index
}

const closeViewer = () => {
    viewingIndex.value = null
}

const emitUpdate = () => {
    sortFiles();

    emit('update:modelValue', files.value[0] ?? {})
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
            :id="id"
            ref="fileInput"
            type="file"
            :accept="acceptedTypes"
            @change="handleFileSelect"
            class="hidden"
        />

        <div v-if="isMultiple" class="flex justify-between">
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
                </div>
            </div>
        </div>

        <!-- GALLERY DnD -->
        <div class="relative">
            <div
                v-if="!files.filter(i => i.action !== ActionEnum.DELETED).length"
                @click="triggerFileInput"
                @dragover.prevent="handleDragOver"
                @dragleave.prevent="handleDragLeave"
                @drop.prevent="handleDrop"
                :class="[
                    'border border-dashed rounded-lg p-4 text-center cursor-pointer transition-colors z-0',
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

            <!-- EXISTED FILE TO DELETE PREVIEW -->
            <div class="absolute right-1 top-1 z-10 pointer-events-auto">
                <div
                    v-for="(file) in files.filter(i => i.action === ActionEnum.DELETED)"
                    :key="file.id"
                    @click.stop="restoreFile(file.id)"
                    class="group relative overflow-hidden rounded-lg border bg-card cursor-pointer"
                >
                    <img
                        :src="file.preview"
                        :alt="file.name"
                        class="w-full object-cover transition-transform opacity-50 grayscale blur-[1px] h-20"
                    />

                    <div
                        v-if="file.action === ActionEnum.DELETED"
                        class="absolute inset-0 pointer-events-none"
                    >
                        <div
                            class="absolute inset-0 opacity-[0.03]"
                            style="background: repeating-linear-gradient(45deg, #9ca3af, #9ca3af 1px, transparent 1px, transparent 10px);"
                        ></div>

                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/40 flex items-center justify-center">
                            <Button
                                type="button"
                                class="rounded-full !px-2"
                                variant="secondary"
                            >
                                <ArchiveRestore class="size-[20px]" />
                            </Button>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-2">
                        <p class="text-xs text-gray-300">{{ formatFileSize(file.size) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- GALLERY PHOTO GRID -->
        <div v-if="files.length > 0" class="space-y-4">
            <div class="flex flex-wrap gap-4 justify-center">
                <div
                    v-for="(file, index) in files.filter(i => i.action !== ActionEnum.DELETED)"
                    :key="file.id"
                    class="group relative overflow-hidden rounded-lg border bg-card"
                >
                    <img
                        :src="file.preview"
                        :alt="file.name"
                        class="w-full object-cover transition-transform group-hover:scale-105 h-36"
                    />

                    <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity group-hover:opacity-100">
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
                                @click.stop="removeFile(file.id)"
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
                    :class="{'grayscale blur-[1px] cursor-not-allowed' : files[viewingIndex].action === ActionEnum.DELETED}"
                />

                <div v-if="files[viewingIndex].action === ActionEnum.DELETED" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-[-45deg]">
                    <span class="text-7xl font-mono font-bold tracking-[.8em] text-neutral-500/50 select-none border-4 border-neutral-500/50 p-8 rounded-lg cursor-not-allowed">
                        REMOVED
                    </span>
                </div>

                <div v-if="isMultiple" class="absolute bottom-10 left-1/2 flex -translate-x-1/2 space-x-2">
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
