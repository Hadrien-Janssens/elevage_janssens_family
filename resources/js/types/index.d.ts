import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}
export interface Images {
    id: number;
    image_path: string;
    created_at: string;
    updated_at: string;
}

export interface BodyColor {
    id: number;
    name: string;
}

export interface Cat {
    id: number;
    name: string;
    birthday: string | null;
    description: string | null;
    gender: string | null;
    body_color: BodyColor;
    images: Images[];
}

export interface Litter {
    id: number;
    name: string;
    mother: Cat;
    father: Cat;
    images: Images[];
    birth_date: string | null;
}

export interface Kitten {
    id: number;
    name: string;
    gender: string | null;
    description: string | null;
    vaccination: boolean;
    sterilization: boolean;
    published_at: string | null;
    chip: boolean;
    price: string | null;
    images: Images[];
    litter: Litter;
    body_color_id: number | null;
    is_booked: boolean;
    is_adopted: boolean;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
