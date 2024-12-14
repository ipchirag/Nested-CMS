<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

defineProps({
    pages: Array,
});

const generatePath = (page, child = null) => {
    if (!child) {
        return page.slug;
    }
    return page.slug + "/" + child.slug;
};
</script>

<template>
    <Head title="All Pages" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pages
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link
                            :href="route('pages.create')"
                            :active="route().current('pages.create')"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 px-2 py-1"
                            >Create</Link
                        >
                        <h1 v-if="pages.length > 0">Pages</h1>
                        <ul v-if="pages.length > 0">
                            <Link
                                v-for="page in pages"
                                :href="`/page/${generatePath(page)}`"
                                :key="page.id"
                                class="underline"
                            >
                                {{ page.title }}
                                <Link
                                    :href="`/page/${page.id}/edit`"
                                    class="ml-4 text-blue-500"
                                    >Edit</Link
                                >

                                <Link
                                    :href="`/page/${page.id}`"
                                    method="DELETE"
                                    class="ml-4 text-red-500"
                                    >Delete</Link
                                >
                                <ul v-if="page.children.length">
                                    <Link
                                        v-for="child in page.children"
                                        :key="child.id"
                                        :href="`/page/${generatePath(
                                            page,
                                            child
                                        )}`"
                                        class="underline"
                                    >
                                        {{ child.title }}
                                        <Link
                                            :href="`/page/${child.id}/edit`"
                                            class="ml-4 text-blue-500"
                                            >Edit</Link
                                        >

                                        <Link
                                            :href="`/page/${child.id}`"
                                            method="DELETE"
                                            class="ml-4 text-red-500"
                                            >Delete</Link
                                        >
                                    </Link>
                                </ul>
                            </Link>
                        </ul>
                        <ul v-else>
                            Please create your first page
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
