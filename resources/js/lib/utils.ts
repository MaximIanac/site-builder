import { InertiaLinkProps } from '@inertiajs/vue3';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function urlIsActive(
    urlToCheck: NonNullable<InertiaLinkProps['href']>,
    currentUrl: string,
) {
    return toUrl(urlToCheck) === currentUrl;
}

export function toUrl(href: NonNullable<InertiaLinkProps['href']>) {
    return typeof href === 'string' ? href : href?.url;
}

export const getErrorMessages = (errors: string[]) => {
    return errors.map(error => ({ message: error }));
};

/**
 * Convert dot path to bracket notation
 * eg: array.0.key => array[0].key
 * @param path
 */
export const toBracketNotation = (path: string) => {
    return path.split('.').map(part => {
        if (/^\d+$/.test(part)) {
            return `[${part}]`;
        }
        return part;
    }).join('.').replace(/\.\[/g, '[');
}
