import { Cat, Kitten, Litter } from '@/types';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function capitalizeFirstLetter(name: string) {
    if (!name) return '';
    return name.charAt(0).toUpperCase() + name.slice(1);
}

export function getContentByTitle(title: string, contents: any[]) {
    const content = contents?.find((c) => c.title === title)?.content;
    return content?.replace(/\n/g, '<br>');
}

//iskitten
export function isKitten(obj: Cat | Kitten): obj is Kitten {
    console.log('obj', obj);

    return 'litter' in obj;
}
//isLitter
export function isLitter(obj: object): obj is Litter {
    return 'father_id' in obj;
}
