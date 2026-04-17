import { ActionEnum } from "./ActionEnum.js";

export default function useMediaNormalizer() {
    const normalizeMedia = (item) => {
        if (!item) return {}

        return {
            id: String(item.id),
            uuid: item.uuid,

            file: null,

            name: item.file_name,
            collection_name: item.collection_name,
            size: item.size,
            type: item.mime_type,
            preview: item.original_url,

            isExisting: true,
            action: ActionEnum.EXISTING,
        }
    }

    const createMedia = (file) => {
        return {
            id: String(Date.now() + Math.random()),
            uuid: null,

            file: file,

            name: file.name,
            collection_name: null,
            size: file.size,
            type: file.type,
            preview: URL.createObjectURL(file),

            isExisting: false,
            action: ActionEnum.NEW,
        }
    }

    return {
        normalizeMedia, createMedia
    }
}
