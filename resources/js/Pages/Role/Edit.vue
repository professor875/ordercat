<script setup>
import {trans} from "@/utils.js";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import SelectInput from "@/Components/Forms/SelectInput.vue";

const props = defineProps({
    role: Object,
    permissions: Array
})

const form = useForm({
    _method: 'PUT',
    name: props.role.name,
    permissions: props.role.permissions_name_array,
});

const submit = () => {
    form.post(route('roles.update', props.role.id));
}

</script>
<template>
    <Head :title="trans('Role')"/>

    <BreadcrumbDefault :pageTitle="trans('Role')"/>

    <Link :href="route('roles.index')">
        <PrimaryButton>{{ trans('Back') }}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Update Role')" class="mt-4 border-warning">
        <form @submit.prevent="submit">
            <div class="flex flex-col gap-y-4.5">
                <TextInput
                    :label="trans('Name')"
                    type="text"
                    :placeholder="trans('Enter Name')"
                    :required="true"
                    v-model="form.name"
                    :error="form.errors.name"
                />

                <div class="col-span-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-x-6">
                    <label v-for="(permission, index) in  permissions" :key="index" class="flex gap-x-2 cursor-pointer">
                        <input :value="permission.name" v-model="form.permissions" type="checkbox">
                        <span>{{permission.display_name}}</span>
                    </label>
                </div>

                <p>{{form.errors.permissions}}</p>
            </div>

            <div class="flex justify-end mt-4.5">
                <PrimaryButton>{{ trans('Update') }}</PrimaryButton>
            </div>
        </form>
    </DefaultCard>

</template>
