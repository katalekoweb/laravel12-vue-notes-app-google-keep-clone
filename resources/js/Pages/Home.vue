<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    new_note: {
        type: Object,
        default: () => ({})
    },
    featured_notes: {
        type: Object,
        default: () => ({})
    },
    all_notes: {
        type: Object,
        default: () => ({})
    }
})

const form = useForm({
    id: null,
    title: "",
    content: "",
    featured: 0,
    order: null,
    bg_color: props.new_note.bg_color
})

const openForm = ref(false)

const save = () => {
    if (form.id) {
        form.put(route('notes.update', form.id), {
            onSuccess: () => {
                resetForm()
            }
        })
    } else {
        form.post(route('notes.store'), {
            onSuccess: () => {
                resetForm()
            }
        })
    }
}

const openEditModal = (note) => {
    form.id = note.id
    form.title = note.title
    form.content = note.content
    form.bg_color = note.bg_color
    form.featured = note.featured
    openForm.value = true
}

const deleteNote = (id) => {
    const deleteForm = useForm({ id: id })
    if (confirm("Sure?")) {
        deleteForm.delete(route('notes.destroy', id), {
            onSuccess: () => {
                alert("Note deleted")
            }
        })
    }
}

const resetForm = () => {
    form.id = null
    form.title = ""
    form.content = ""
    form.bg_color = "#fff"
    form.featured = 0
    openForm.value = false
}

</script>

<template>

    <Head title="Home" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Home
                </h2>
                <SecondaryButton @click="openForm = true">New</SecondaryButton>
            </div>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-4">
                <div v-if="openForm"
                    class="flex items-center justify-center bg-yellow-400 bg-opacity-80 fixed top-0 left-0 right-0 bottom-0 z-20 p-10">
                    <div class="overflow-hidden w-full max-w-7xl bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                        :style="form.bg_color ? { backgroundColor: form.bg_color } : {}">
                        <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center justify-center">
                            <div class=" space-y-3 w-full max-w-4xl ">
                                <div class="flex items-center justify-end">
                                    <button class="cursor-pointer" @click="resetForm()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div>
                                    <InputLabel value="Title" />
                                    <TextInput id="title" placehoder="Title..." type="text" class="mt-1 block w-full"
                                        v-model="form.title" autocomplete="title" />
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>

                                <div>
                                    <InputLabel value="Content" />
                                    <textarea id="content" placehoder="Content..." class="mt-1 block w-full"
                                        v-model="form.content"></textarea>
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>

                                <div class="flex items-center justify-between">
                                    <button @click="form.featured = form.featured == 1 ? 0 : 1"
                                        class=" cursor-pointer border border-gray-100 p-2 rounded-md px-4"
                                        :class="{ 'bg-lime-400': form.featured }">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                                        </svg>
                                    </button>

                                    <label for="bg_color">
                                        <input type="color" class="hidden" id="bg_color" name="bg_color"
                                            v-model="form.bg_color" />
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
                                        </svg>

                                    </label>
                                    <SecondaryButton @click="save()">Save</SecondaryButton>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md p-5 rounded-md">
                    <div class="text-lg text-gray-600 py-2 w-full underline">Featured notes</div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 p-2" v-if="featured_notes.length == 0">
                            <div class="text-md italic">There is not featured notes</div>
                        </div>
                        <div class="border border-gray-200 p-2 cursor-pointer rounded-md relative pt-12"
                            v-for="note in featured_notes" :key="note.id"
                            :style="note.bg_color ? { backgroundColor: note.bg_color } : {}"
                            @click="openEditModal(note)">
                            <div class="text-lg italic font-bold">{{ note.title }}</div>
                            <div class="text-md">{{ note.content }}</div>

                            <div class="absolute z-10 top-3 right-3">
                                <div class="flex items-center  flex space-x-2">
                                    <SecondaryButton @click="openEditModal(note)">Show</SecondaryButton>
                                    <SecondaryButton @click="deleteNote(note?.id)">X</SecondaryButton>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md p-5 rounded-md">
                    <div class="text-lg text-gray-600 py-2 w-full underline">All notes</div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 p-2" v-if="all_notes.length == 0">
                            <div class="text-md italic">There is not notes</div>
                        </div>
                        <div class="border border-gray-200 p-2 cursor-pointer rounded-md relative pt-12"
                            v-for="note in all_notes" :key="note.id"
                            :style="note.bg_color ? { backgroundColor: note.bg_color } : {}">
                            <div class="text-md italic">{{ note.title }}</div>
                            <div class="text-md">{{ note.content }}</div>

                            <div class="absolute z-10 top-3 right-3 mb-3 bottom-3">
                                <div class="flex items-center  flex space-x-2">
                                    <SecondaryButton @click="openEditModal(note)">Show</SecondaryButton>
                                    <SecondaryButton @click="deleteNote(note?.id)">X</SecondaryButton>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
