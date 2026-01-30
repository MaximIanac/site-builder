import { z } from 'zod'
import useConfig from "../useConfig";

export const useLocalizedSchema = (required = false, min = 0) => {
    const { APP_LOCALES } = useConfig()

    let stringSchema = z.string()

    if (required) stringSchema = stringSchema.min(1)
    else stringSchema.nullable()

    if (min > 0) stringSchema = stringSchema.min(min)

    const shape = Object.fromEntries(
        APP_LOCALES.map(locale => {
            return [locale, stringSchema]
        })
    )

    return z.object(shape)
}
