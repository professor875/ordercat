<script setup>
import sidebar from "@/stores/sidebar.js";
import {onClickOutside} from '@vueuse/core'
import {markRaw, onMounted, ref} from 'vue'
import SidebarItem from './SidebarItem.vue'
import {Link} from "@inertiajs/vue3";
import DashboardSvg from "@/assets/svg/DashboardSvg.vue";
import ContactSvg from "@/assets/svg/ContactSvg.vue";
import ItemSvg from "@/assets/svg/ItemSvg.vue";
import UserSvg from "@/assets/svg/UserSvg.vue";
import BuildingSvg from "@/assets/svg/BuildingSvg.vue";
import KitchenSvg from "@/assets/svg/KitchenSvg.vue";
import {hasPermission, trans} from "@/utils.js";
import StageSvg from "@/assets/svg/StageSvg.vue";
import RoleSvg from "@/assets/svg/RoleSvg.vue";

const target = ref(null)

const menuGroups = markRaw([
    {
        name: 'MENU',
        menuItems: [
            {
                icon: DashboardSvg,
                label: trans('Dashboard'),
                route: route('dashboard.index'),
                nameToMatch: 'dashboard,*',
                permissionCheck: true
            },
            {
                icon: KitchenSvg,
                label: trans('Kitchens'),
                route: route('kitchens.index'),
                nameToMatch: 'kitchens.*',
                permissionCheck: hasPermission('kitchen.index')
            },
            {
                icon: BuildingSvg,
                label: trans('Buildings'),
                route: route('buildings.index'),
                nameToMatch: 'buildings.*',
                permissionCheck: hasPermission('building.index')
            },
            {
                icon: ContactSvg,
                label: trans('Contacts'),
                route: route('contacts.index'),
                nameToMatch: 'contacts.*',
                permissionCheck: hasPermission('contact.index')
            },
            {
                icon: ItemSvg,
                label: trans('Items'),
                route: route('items.index'),
                nameToMatch: 'Items.*',
                permissionCheck: hasPermission('item.index')
            },
            {
                icon: UserSvg,
                label: trans('Users'),
                route: route('users.index'),
                nameToMatch: 'users.*',
                permissionCheck: hasPermission('user.index')
            },
            {
                icon: StageSvg,
                label: trans('Stage'),
                route: route('stages.index'),
                nameToMatch: 'stages.*',
                permissionCheck: hasPermission('stage.index')
            },
            {
                icon: RoleSvg,
                label: trans('Role'),
                route: route('roles.index'),
                nameToMatch: 'roles.*',
                permissionCheck: hasPermission('role.index')
            },
            // {
            //     icon: FormSvg,
            //     label: 'Forms',
            //     route: '#',
            //     children: [
            //         {label: 'Create', route: route('kitchens.create'), nameToMatch: 'kitchens.create'},
            //     ]
            // },
        ]
    },
])

const setActiveLabel = () => {
    menuGroups.map(menu => {
        menu.menuItems.map(item => {
            if (item.children) {
                item.children.map(child => {
                    if (route().current(child.nameToMatch)) {
                        sidebar.setActiveLabel(item.label)
                    }
                })
            } else {
                if (route().current(item.nameToMatch)) {
                    sidebar.setActiveLabel(item.label)
                }
            }
        })
    })
}

onMounted(() => {
    setActiveLabel()

    onClickOutside(target, () => {
        if (sidebar.isOpen) {
            sidebar.close()
        }
    })
})
</script>

<template>
    <aside
        class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
        :class="{
      'translate-x-0': sidebar.isOpen,
      '-translate-x-full': !sidebar.isOpen
    }"
        ref="target"
    >
        <!-- SIDEBAR HEADER -->
        <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
            <Link href="/" class="w-full px-12">
                <img src="@/assets/icons/mainLogo.png" alt="Logo"/>
            </Link>

            <button class="block lg:hidden" @click="sidebar.close()">
                <svg
                    class="fill-current"
                    width="20"
                    height="18"
                    viewBox="0 0 20 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                        fill=""
                    />
                </svg>
            </button>
        </div>
        <!-- SIDEBAR HEADER -->

        <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
            <!-- Sidebar Menu -->
            <nav class="mt-5 py-4 px-4 lg:mt-9 lg:px-6">
                <template v-for="menuGroup in menuGroups" :key="menuGroup.name">
                    <div>
                        <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">{{ trans(menuGroup.name) }}</h3>

                        <ul class="mb-6 flex flex-col gap-1.5">
                            <SidebarItem
                                v-for="(menuItem, index) in menuGroup.menuItems"
                                :item="menuItem"
                                :key="index"
                            />
                        </ul>
                    </div>
                </template>
            </nav>
            <!-- Sidebar Menu -->
        </div>
    </aside>
</template>
