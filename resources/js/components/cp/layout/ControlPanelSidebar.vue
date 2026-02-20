<script setup lang="ts">
import NavFooter from '@/components/cp/layout/NavFooter.vue';
import NavMain from '@/components/cp/layout/NavMain.vue';
import NavUser from '@/components/cp/layout/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, BookText, GalleryVerticalEnd } from 'lucide-vue-next';
import ControlPanelLogo from './ControlPanelLogo.vue';
import ModeToggle from "@/components/sb/ModeToggle.vue";

const modulesNavItems = [
    {
        title: 'Catalog',
        href: '/cp/modules/catalog',
        icon: BookText ,
    },
];

const contentNavItems = [
    {
        title: 'Pages',
        href: '/cp/pages',
        icon: GalleryVerticalEnd,
    },
];

const footerNavItems = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link href="">
                            <ControlPanelLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain header="Content" :items="contentNavItems" />
            <NavMain header="Modules" :items="modulesNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <ModeToggle />
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
