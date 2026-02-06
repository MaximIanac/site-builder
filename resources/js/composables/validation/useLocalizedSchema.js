import { z } from 'zod'
import useConfig from "../useConfig";

export default function useLocalizedSchema() {
    const localizeSchema = (required = false, min = 0) => {
        const { APP_LOCALES } = useConfig()

        let stringSchema = z.string()

        if (!required) stringSchema = stringSchema.optional()
        if (min > 0) stringSchema = stringSchema.min(min)

        const shape = Object.fromEntries(
            APP_LOCALES.map(locale => {
                return [locale, stringSchema]
            })
        )

        return z.object(shape).default(
            Object.fromEntries(APP_LOCALES.map(i => [i, undefined]))
        )
    }

    const ensureObject = value => {
        if (Array.isArray(value) && value.length === 0) return {};
        if (value == null) return {};

        return value;
    }

    return {
        localizeSchema,
        ensureObject
    }
}
