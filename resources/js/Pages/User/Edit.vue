<script setup>
import {trans} from "@/utils.js";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import SelectInput from "@/Components/Forms/SelectInput.vue";
import MultiSelect from "@/Components/Forms/MultiSelect.vue";

const props = defineProps({
    user: Object,
    contact_channel: Array,
    roles:Array
})

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    contact_channel: props.user.contact_channel,
    contact_number: props.user.contact_number,
    roles: props.user.roles
});

const submit = () => {
    form.post(route('users.update', props.user.id));
}

</script>
<template>
    <Head :title="trans('User')"/>

    <BreadcrumbDefault :pageTitle="trans('User')"/>

    <Link :href="route('users.index')">
        <PrimaryButton>{{ trans('Back') }}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Update User')" class="mt-4 border-warning">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4.5">
                <TextInput
                    :label="trans('Name')"
                    type="text"
                    :placeholder="trans('Enter Name')"
                    :required="true"
                    v-model="form.name"
                    :error="form.errors.name"
                />

                <TextInput
                    :label="trans('Email')"
                    type="text"
                    :placeholder="trans('Enter Email')"
                    :required="true"
                    v-model="form.email"
                    :error="form.errors.email"
                    :disable="true"
                    :readonly="true"
                />

                <SelectInput
                    :label="trans('Contact Channel')"
                    :required="true"
                    :error="form.errors.type"
                    v-model="form.contact_channel"
                >
                    <option value="" selected disabled>{{ trans('Select type') }}</option>
                    <option
                        v-for="(contact_channel, index) in contact_channel"
                        :key="index"
                        :value="contact_channel.value"
                    >{{ contact_channel.name }}
                    </option>
                </SelectInput>

                <TextInput
                    v-show="form.contact_channel !== 'email'"
                    :label="trans('Contact Number')"
                    type="text"
                    :placeholder="trans('Enter Contact Number.')"
                    v-model="form.contact_number"
                    :error="form.errors.contact_number"
                />

                <MultiSelect
                    :label="trans('Roles')"
                    v-model="form.roles"
                    :options="props.roles"
                    :error="form.errors.roles"
                    :placeholder="trans('Please select roles')"
                />
            </div>

            <div class="flex justify-end mt-4.5">
                <PrimaryButton>{{ trans('Update') }}</PrimaryButton>
            </div>
        </form>
    </DefaultCard>

</template>
