<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, Link } from "@inertiajs/vue3";
import { reactive } from "vue";
const { page, pages } = defineProps({
    page: Object,
    pages: Array,
});

const form = reactive({ ...page });

const submit = () => {
    router.put(route("pages.update", page.id), form);
};
</script>

<template>
    <Head title="Edit Page" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Page
            </h2>
            <Link
                :href="route('pages.index')"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 px-2 py-1"
                >Back</Link
            >
        </template>

        <div
            class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden"
        >
            <div
                class="text-2xl py-4 px-6 bg-gray-900 text-white text-center font-bold uppercase"
            >
                Edit Page
            </div>
            <form @submit.prevent="submit" class="py-4 px-6" action="">
                <div class="mb-4">
                    <label
                        class="block text-gray-700 font-bold mb-2"
                        for="parent_page"
                    >
                        Parent Page
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="parent_page"
                        v-model="form.parent_id"
                    >
                        <option value="">None</option>
                        <option
                            v-for="page in pages"
                            :value="page.id"
                            :key="page.id"
                        >
                            {{ page.title }}
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-700 font-bold mb-2"
                        for="Slug"
                    >
                        Slug
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Slug"
                        type="text"
                        placeholder="Enter slug"
                        v-model="form.slug"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-700 font-bold mb-2"
                        for="Title"
                    >
                        Title
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Title"
                        type="text"
                        placeholder="Enter title"
                        v-model="form.title"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-700 font-bold mb-2"
                        for="Content"
                    >
                        Content
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Content"
                        rows="4"
                        v-model="form.content"
                        placeholder="Enter content"
                    ></textarea>
                </div>

                <div class="flex items-center justify-center mb-4">
                    <button
                        class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Update
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
