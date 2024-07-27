<script setup>
import {trans} from "@/utils.js";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import MultiSelect from "@/Components/Forms/MultiSelect.vue";

defineProps({
    days: Array,
    types: Array,
})

const form = useForm({
    _method: 'POST',
    title: '',
    description: '',
    days: [],
    types: [],
});

const submit = () => {
    form.post(route('items.store'));
}
</script>

<template>
    <Head :title="trans('Items')"/>

    <BreadcrumbDefault :pageTitle="trans('Items')"/>

    <Link :href="route('items.index')">
        <PrimaryButton>{{ trans('Back') }}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Create Item')" class="mt-4 border-success">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4.5">
                <TextInput
                    :label="trans('Title')"
                    type="text"
                    :placeholder="trans('Enter Title')"
                    :required="true"
                    v-model="form.title"
                    :error="form.errors.title"
                />

                <TextInput
                    :label="trans('Description')"
                    type="text"
                    :placeholder="trans('Enter Description')"
                    :required="true"
                    v-model="form.description"
                    :error="form.errors.description"
                />

                <MultiSelect
                    :label="trans('Days')"
                    v-model="form.days"
                    :options="days"
                    :placeholder="trans('Please select days')"
                    :customLabel="trans"
                />
                <MultiSelect
                    :label="trans('Types')"
                    v-model="form.types"
                    :options="types"
                    :placeholder="trans('Please select types')"
                    :customLabel="trans"
                />
            </div>

            <div class="flex justify-end mt-4.5">
                <PrimaryButton>{{ trans('Create') }}</PrimaryButton>
            </div>
        </form>
    </DefaultCard>

</template>
